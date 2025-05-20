
<?php 
    require_once "pdo.php"; 
    include "global.php";
    include "product.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 3;
    $offset = ($page - 1) * $limit;

    $filter = $_GET['filter'] ?? '';
    $keyword = $_GET['keyword'] ?? '';
    $keyword = "%$keyword%";

    // Tạo mảng tham số và điều kiện WHERE
    $where = "WHERE bill_id LIKE ? OR user_id LIKE ? OR receiver_name LIKE ? OR receiver_phone LIKE ?";
    $params = [$keyword, $keyword, $keyword, $keyword];

    // Điều kiện sắp xếp
    $order = "ORDER BY bill_id DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY bill_id ASC";
    }

    // Tạo câu truy vấn
    $sql = "SELECT * FROM bill $where $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM bill $where";

    // Lấy tổng số sản phẩm
    $total_bills = (int)pdo_query_value($sql_count, ...$params);
    $total_pages = ceil($total_bills / $limit);

    // Lấy danh sách sản phẩm
    $list_bills = pdo_query($sql, ...$params);
    $html_all_list_order= '';
    $i=$offset+1;
    foreach ($list_bills as $alo) 
    {
        extract($alo);

        $html_detail_product_order = '';
        $bill_detail = get_detail_bill_by_bill_id($bill_id);
        foreach ($bill_detail as $bd) 
        {
            extract($bd);
            $html_detail_product_order .=   '<li class="d-flex align-items-center mb-3">
                                                <img src="'.IMG_PATH_ADMIN_PRODUCT.$img.'" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-right: 12px;">
                                                <div>
                                                    <strong>'.$name.'</strong> x'.$quantity.' <br>
                                                    <span class="text-muted">Đơn giá: '.$price.' VND</span>
                                                </div>
                                            </li>';
        }
        
        // Lấy phần trăm giảm giá
        if($discount_code != ''){
            $percent = get_voucher($discount_code);
            extract($percent);
            $percent_discount = " (Giảm " . $percent['discount_percent'] . "%)";
        }else {
            $percent_discount = "Không áp dụng"; 
        }
                 
        // Trạng thái thanh toán
        if($payment_status == 0){
            $pay_status = '<span class="badge bg-danger">Chưa thanh toán</span>';
        }else{
            $pay_status = '<span class="badge bg-success">Đã thanh toán</span>';
        }

        // Trạng thái đơn hàng
        if($status == 0){
            $order_status = '<span class="badge bg-warning">Chờ xác nhận</span>';
        } elseif($status == 1){
            $order_status = '<span class="badge bg-primary">Đã xác nhận</span>';
        }elseif($status == 2){
            $order_status = '<span class="badge bg-secondary">Đang giao</span>';
        }elseif($status == 3){
            $order_status = '<span class="badge bg-success">Đã giao</span>';
        }elseif($status == 4){
            $order_status = '<span class="badge bg-danger">Đã hủy</span>';
        }elseif($status == 5){
            $order_status = '<span class="badge bg-dark">Đã hoàn trả/span>';
        }

        // format ngày giờ
        $formatted_date = date('H:i:s d/m/Y', strtotime($created_at));

        $html_all_list_order.=' <tr class="text-center align-middle">
                                    <td>'.$i.'</td>
                                    <td>'.$bill_id.'</td>
                                    <td>'.$user_id.'</td>
                                    <td>'.$receiver_name.'</td>
                                    <td>'.$receiver_phone.'</td>
                                    <td>'.$payment_method.'</td>
                                    <td>'.$pay_status.'</td>
                                    <td>'.$order_status.'</td>
                                    <td>'.$formatted_date.'</td>
                                    <td>
                                        <button type="button" class="btn btn-primary w-100 mb-1" data-bs-toggle="modal" data-bs-target="#bill_detail_'.$bill_id.'">
                                            <i class="bi bi-eye"></i> Xem chi tiết
                                        </button>

                                        <a href="index.php?pg=product_order_adjust_status&bill_id=' . $bill_id . '" class="btn btn-success w-100">
                                            <i class="bi bi-pencil-square"></i> Trạng thái
                                        </a>
                                    </td>
                                </tr>

                            <!-- Modal xem chi tiết hóa đơn -->
                            <div class="modal fade" id="bill_detail_'.$bill_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                
                                    <div class="modal-content rounded-3">

                                        <div class="modal-header bg_200_105_5">
                                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Chi tiết hóa đơn #'.$bill_id.'</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <h5 class="text_200_105_5 fw-bold"><i class="bi bi-person-vcard me-2"></i>Thông tin người nhận</h5>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item border-0"><i class="bi bi-person me-2"></i><strong>Tên người nhận:</strong> '.$receiver_name.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-telephone me-2"></i><strong>Số điện thoại:</strong> '.$receiver_phone.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-envelope me-2"></i><strong>Email:</strong> '.$receiver_email.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-geo-alt me-2"></i><strong>Địa chỉ nhận hàng:</strong> '.$receiver_address.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-calendar-check me-2"></i><strong>Thời gian đặt hàng:</strong> '.$formatted_date.'</li>
                                            </ul>

                                            <h5 class="text_200_105_5 fw-bold"><i class="bi bi-box-seam me-2"></i>Thông tin sản phẩm</h5>
                                            '.$html_detail_product_order.'

                                            <h5 class="text_200_105_5 fw-bold"><i class="bi bi-credit-card me-2"></i>Thông tin giao dịch</h5>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item border-0"><i class="bi bi-wallet2 me-2"></i><strong>Phương thức thanh toán:</strong> '.$payment_method.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-check2-circle me-2"></i><strong>Trạng thái thanh toán:</strong> '.$pay_status.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-truck me-2"></i><strong>Trạng thái đơn hàng:</strong> '.$order_status.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-ticket-perforated me-2"></i><strong>Mã giảm giá:</strong> '.$discount_code.''.$percent_discount.'</li>

                                                <li class="list-group-item border-0"><i class="bi bi-cash-coin me-2"></i><strong>Tổng thanh toán:</strong> '.number_format($total_price).'</li>
                                            </ul>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn_200_105_5" onclick="exportBill('.$bill_id.')">Xuất hóa đơn</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        $i++;
    }




    $escaped_filter = htmlspecialchars($filter, ENT_QUOTES);
    $escaped_keyword = htmlspecialchars($keyword, ENT_QUOTES);

    $html_pagination = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? 'active_button' : '';
        $icon = ($i == $page) ? '<i class="bi bi-caret-up-fill"></i>' : '';
        $html_pagination .= '<button onclick="loadProductsWithSearch(' . $i . ', \'' . $escaped_filter . '\', \'' . $escaped_keyword . '\')" class="' . $active_class . '">
                                ' . $i . ' ' . $icon . '
                            </button> ';
    }

    $response = [
        'list_product' => $html_all_list_order,
        'pagination' => $html_pagination
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>