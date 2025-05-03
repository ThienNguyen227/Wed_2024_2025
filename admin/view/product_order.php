<?php 
    $html_all_list_order= '';
    $i=1;
    foreach ($all_list_order as $alo) 
    {
        extract($alo);

        $html_detail_product_order = '';
        $bill_detail = get_detail_bill_by_bill_id($bill_id);
        foreach ($bill_detail as $bd) {
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
            $pay_status = "Chưa thanh toán";
        }else{
            $pay_status = "Đã thanh toán";
        }

        // Trạng thái đơn hàng
        if($status == 0){
            $order_status = "Chờ xác nhận";
        } elseif($status == 1){
            $order_status = "Đã xác nhận";
        }elseif($status == 2){
            $order_status = "Đang giao";
        }elseif($status == 3){
            $order_status = "Đã giao";
        }elseif($status == 4){
            $order_status = "Đã hủy";
        }elseif($status == 5){
            $order_status = "Đã hoàn trả";
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

                                        <button type="button" class="btn btn-success  w-100" data-bs-toggle="modal" data-bs-target="#adjust_status_'.$bill_id.'">
                                            <i class="bi bi-pencil-square"></i> Trạng thái 
                                        </button>
                                    </td>
                                </tr>

                            <!-- 1. Modal xem chi tiết hóa đơn -->
                            <div class="modal fade" id="bill_detail_'.$bill_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết hóa đơn #'.$bill_id.'</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <h5>Thông tin người nhận</h5>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item border-0"><strong>Tên người nhận:</strong> '.$receiver_name.'</li>

                                                <li class="list-group-item border-0"><strong>Số điện thoại:</strong> '.$receiver_phone.'</li>

                                                <li class="list-group-item border-0"><strong>Email:</strong> '.$receiver_email.'</li>

                                                <li class="list-group-item border-0"><strong>Địa chỉ nhận hàng:</strong> '.$receiver_address.'</li>

                                                <li class="list-group-item border-0"><strong>Thời gian đặt hàng:</strong> '.$formatted_date.'</li>
                                            </ul>

                                            <h5>Thông tin sản phẩm</h5>
                                            '.$html_detail_product_order.'
                                            
                                            <h5>Thông tin giao dịch</h5>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item border-0"><strong>Phương thức thanh toán:</strong> '.$payment_method.'</li>

                                                <li class="list-group-item border-0"><strong>Trạng thái thanh toán:</strong> '.$pay_status.'</li>

                                                <li class="list-group-item border-0"><strong>Trạng thái đơn hàng:</strong> '.$order_status.'</li>

                                                <li class="list-group-item border-0"><strong>Mã giảm giá:</strong> '.$discount_code.''.$percent_discount.'</li>

                                                <li class="list-group-item border-0"><strong>Tổng thanh toán:</strong> '.$total_price.'</li>
                                            </ul>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Xuất hóa đơn</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 2. Modal điều chỉnh trạng thái -->
                            <div class="modal fade" id="adjust_status_'.$bill_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="index.php?pg=handle_adjustment_status" method="post">
                                    <div class="modal-dialog modal-dialog-centered">
                                    
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật trạng thái đơn hàng #'.$bill_id.'</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <!-- 1. Trạng thái thanh toán -->
                                                <li class="mb-4" style="list-style-type: none;">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <strong>Trạng thái thanh toán:</strong>
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault1" type="radio" name="payment_status" value="0" '.($payment_status == 0 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault1">
                                                                    Chưa thanh toán
                                                                </label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault2" type="radio" name="payment_status" value="1" '.($payment_status == 1 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault2">
                                                                    Đã thanh toán
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <hr>

                                                <!-- 2. Trạng thái đơn hàng -->
                                                <li class="mb-4" style="list-style-type: none;">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <strong>Trạng thái đơn hàng:</strong>
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault3" type="radio" name="order_status" value="0" '.($status == 0 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault3">
                                                                    Chờ xác nhận
                                                                </label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault4" type="radio" name="order_status" value="1" '.($status == 1 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault4">
                                                                    Đã xác nhận
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault5" type="radio" name="order_status" value="2" '.($status == 2 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault5">
                                                                    Đang giao
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault6" type="radio" name="order_status" value="3" '.($status == 3 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault6">
                                                                    Đã giao
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault7" type="radio" name="order_status" value="4" '.($status == 4 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault7">
                                                                    Đã hủy
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" id="radioDefault8" type="radio" name="order_status" value="5" '.($status == 5 ? 'checked' : '').'>
                                                                <label class="form-check-label" for="radioDefault8">
                                                                    Đã hoàn trả
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>



                                            </div>



                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <input type="hidden" name="bill_id" value="'.$bill_id.'">
                                                <button type="submit" name="adjust_status" class="btn btn-primary">Lưu thay đổi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            ';
        $i++;
    }







?>








<body>
    
    <div class="sidebar">
        <h4>Admin</h4>
        <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
        <a href="index.php?pg=product_list"><i class="bi bi-box-seam"></i>Sản phẩm</a>
        <a href="index.php?pg=product_order" class="active_slide_bar"><i class="bi bi-cart"></i>Đơn hàng</a>
        <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
        <a href="#"><i class="bi bi-bar-chart"></i>Thống kê</a>
        <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
    </div>

    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <span class="navbar-brand fw-bold text-dark">Quản lý đơn hàng</span>
        <div class="ms-auto">
          <span class="me-3">Xin chào, Admin</span>
          <i class="bi bi-person-circle fs-4"></i>
        </div>
      </div>
    </nav>
    

    <div class="main">

        <!-- <h2 class="fw-bold mb-4">Bảng điều khiển</h2>
        <div class="row dashboard-cards">
            <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                <div class="card-icon"><i class="bi bi-box-seam"></i></div>
                <h5 class="card-title">Sản phẩm</h5>
                <p class="card-text">120 sản phẩm</p>
                </div>
            </div>
            </div>
            <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                <div class="card-icon"><i class="bi bi-cart-check"></i></div>
                <h5 class="card-title">Đơn hàng</h5>
                <p class="card-text">25 đơn hôm nay</p>
                </div>
            </div>
            </div>
            <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                <div class="card-icon"><i class="bi bi-people-fill"></i></div>
                <h5 class="card-title">Người dùng</h5>
                <p class="card-text">10 người mới</p>
                </div>
            </div>
            </div>
        </div> -->

        <!-- Thông báo điều chỉnh trạng thái thành công -->
        <?php
            if (isset($_SESSION['tb_success_adjustment']) && $_SESSION['tb_success_adjustment'] != "") {
              echo '<div class="text-success mb-3 fw-bold"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_adjustment'] . '</div>';
              unset($_SESSION['tb_success_adjustment']);
            }
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
                <thead class="table-warning text-center align-middle">
                    <tr>
                        <th scope="col"><i class="bi bi-list-ol me-1"></i>STT</th>
                        <th scope="col"><i class="bi bi-receipt me-1"></i>Mã đơn hàng</th>
                        <th scope="col"><i class="bi bi-person-badge me-1"></i>Mã khách hàng</th>
                        <th scope="col"><i class="bi bi-person me-1"></i>Tên người nhận</th>
                        <th scope="col"><i class="bi bi-telephone me-1"></i>Số điện thoại người nhận</th>
                        <th scope="col"><i class="bi bi-credit-card me-1"></i>Phương thức thanh toán</th>
                        <th scope="col"><i class="bi bi-cash-coin me-1"></i>Trạng thái thanh toán</th>
                        <th scope="col"><i class="bi bi-truck me-1"></i>Trạng thái đơn hàng</th>
                        <th scope="col"><i class="bi bi-calendar-check me-1"></i>Thời gian đặt hàng</th>
                        <th scope="col"><i class="bi bi-gear me-1"></i>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$html_all_list_order;?>
                </tbody>
            </table>
        </div>
        

        
    </div>