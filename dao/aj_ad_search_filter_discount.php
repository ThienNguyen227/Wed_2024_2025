<?php 
    require_once "pdo.php"; 
    include "global.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 1;
    $offset = ($page - 1) * $limit;

    $filter = $_GET['filter'] ?? '';
    $keyword = $_GET['keyword'] ?? '';
    $keyword = "%$keyword%";

    // Tạo mảng tham số và điều kiện WHERE
    $where = "WHERE code LIKE ?";
    $params = [$keyword];

    // Ánh xạ filter sang category_id nếu có
    // $category_map = ['coffee' => 1, 'tea' => 2, 'cake' => 3, 'ame' => 4];
    // if (array_key_exists($filter, $category_map)) {
    //     $where .= " AND product_category_id = ?";
    //     $params[] = $category_map[$filter];
    // }

    // Điều kiện sắp xếp
    $order = "ORDER BY created_at DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY created_at ASC";
    }

    // Tạo câu truy vấn
    $sql = "SELECT * FROM total_discounts $where $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM total_discounts $where";

    // Lấy tổng số sản phẩm
    $total_discounts = (int)pdo_query_value($sql_count, ...$params);
    $total_pages = ceil($total_discounts / $limit);

    // Lấy danh sách sản phẩm
    $list_discount = pdo_query($sql, ...$params);

    // Tạo HTML danh sách sản phẩm
    $html_list_discount = '';
    $i = $offset + 1;
    foreach ($list_discount as $ls_ds) {
        extract($ls_ds);

        $start_date_fmt = date('H:i:s d/m/Y', strtotime($start_date));
        $end_date_fmt = date('H:i:s d/m/Y', strtotime($end_date));
        $created_at_fmt = date('H:i:s d/m/Y', strtotime($created_at));
        $update_at_fmt = date('H:i:s d/m/Y', strtotime($update_at));

        $html_list_discount .= ' <tr class="text-center">
                                    <td>' . $i . '</td>
                                    <td>' . htmlspecialchars($code) . '</td>
                                    <td>' .  htmlspecialchars($discount_percent) . '</td>
                                    <td>' .  htmlspecialchars($discount_amount) . '</td>
                                    <td>' .  htmlspecialchars($start_date_fmt) . '</td>
                                    <td>' .  htmlspecialchars($end_date_fmt) . '</td>
                                    <td>' .  htmlspecialchars($created_at_fmt) . '</td>
                                    <td>' .  htmlspecialchars($update_at_fmt) . '</td>
                                    <td>
                                        <a href="index.php?pg=discount_update&discount_id=' . htmlspecialchars($discount_id) . '" class="btn btn-success">
                                            <i class="bi bi-pencil-square me-1"></i> Chỉnh Sửa
                                        </a>
                                        <a href="index.php?pg=handle_subtraction_discount&discount_id=' . htmlspecialchars($discount_id) . '" class="btn btn-danger">
                                            <i class="bi bi-trash me-1"></i> Xóa
                                        </a>
                                    </td>
                                </tr>';
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
        'list_product' => $html_list_discount,
        'pagination' => $html_pagination
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>
