<?php 
    require_once "pdo.php"; 
    include "global.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 3;
    $offset = ($page - 1) * $limit;

    $filter = $_GET['filter'] ?? '';
    $keyword = $_GET['keyword'] ?? '';
    $keyword = "%$keyword%";

    // Tạo mảng tham số và điều kiện WHERE
    $where = "WHERE name LIKE ?";
    $params = [$keyword];


    // Điều kiện sắp xếp
    $order = "ORDER BY id DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY id ASC";
    }

    // Tạo câu truy vấn
    $sql = "SELECT * FROM product $where AND product_category_id = 5 $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM product $where AND product_category_id = 5";

    // Lấy tổng số sản phẩm
    $total_products = (int)pdo_query_value($sql_count, ...$params);
    $total_pages = ceil($total_products / $limit);

    // Lấy danh sách sản phẩm
    $list_product = pdo_query($sql, ...$params);

    // Tạo HTML danh sách sản phẩm
    $html_list_product = '';
    $i = $offset + 1;
    foreach ($list_product as $ls_pro) {
        extract($ls_pro);
        if($product_status==0){
            $tb_status = '<span class="badge bg-success">Đang bán</span>'; 
            $hidden_button_1 = "d-none";
            $hidden_button_2 = "";
        } elseif($product_status==1){
            $tb_status = '<span class="badge bg-secondary">Ngừng bán</span>'; 
            $hidden_button_1 = "";
            $hidden_button_2 = "d-none";
        }

        if($bestseller==0){
            $tb_bestseller = '<span class="badge bg-info text-dark">Bình thường</span>'; 
            $hidden_button_3 = "d-none";
            $hidden_button_4 = "";
        } elseif($bestseller==1){
            $tb_bestseller = '<span class="badge bg-warning text-dark">Bán chạy</span>'; 
            $hidden_button_3 = "";
            $hidden_button_4 = "d-none";
        }
        $html_list_product .= '<tr>
                                    <td class="text-center">' . $i . '</td>
                                    <td>' . htmlspecialchars($name) . '</td>
                                    <td class="text-center">
                                        <img
                                            src="' . IMG_PATH_ADMIN_PRODUCT . $img . '"
                                            alt="Hình sản phẩm"
                                            class="img-thumbnail"
                                            style="width: 60px; height: 60px; object-fit: cover"
                                        />
                                    </td>
                                    <td class="text-center">'.$product_quantity.'</td>
                                    <td class="text-center">' . number_format($price) . '</td>
                                    <td class="text-center">' . $tb_status . '</td>
                                    <td class="text-center">' . $tb_bestseller . '</td>
                                    <td class="text-center">
                                        <a href="index.php?pg=product_packed_update&id=' . $id . '" class="btn btn_200_105_55">
                                            <i class="bi bi-pencil-square me-1"></i> Chỉnh Sửa
                                        </a>


                                        <a href="index.php?pg=handle_hidden_packed_product&id=' . htmlspecialchars($id) . '" class="btn btn-secondary '.$hidden_button_2.'">
                                            <i class="bi bi-eye-slash me-1"></i> Ẩn
                                        </a>
                                    
                                    
                                        <a href="index.php?pg=handle_show_packed_product&id=' . htmlspecialchars($id) . '" class="btn btn-success '.$hidden_button_1.'">
                                            <i class="bi bi-eye me-1"></i> Hiện
                                        </a>
                                    
                                    
                                        <a href="index.php?pg=handle_bestseller_packed_product&id=' . htmlspecialchars($id) . '" class="btn btn-warning text-white '.$hidden_button_4.'">
                                            <i class="bi bi-hand-thumbs-up-fill me-1"></i>Thêm Bestseller
                                        </a>
                                    
                                    
                                        <a href="index.php?pg=handle_cancel_bestseller_packed_product&id=' . htmlspecialchars($id) . '" class="btn btn-info text-white '.$hidden_button_3.'">
                                            <i class="bi bi-hand-thumbs-up-fill me-1"></i> Gỡ Bestseller
                                        </a>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal_'. $id.'">
                                            <i class="bi bi-trash me-1"></i> Xóa
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal xóa sản phẩm-->
                                <div class="modal fade" id="exampleModal_'. $id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel"><i class="bi bi-exclamation-diamond"></i> Xác nhận xóa sản phẩm</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa sản phẩm <strong>'. htmlspecialchars($name) .'</strong> không?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Hủy</button>
                                                <a href="index.php?pg=handle_subtraction_packed_product&id=' . $id . '" class="btn btn-danger">
                                                    <i class="bi bi-trash me-1"></i> Xóa
                                                </a>
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
        'list_product' => $html_list_product,
        'pagination' => $html_pagination
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>
