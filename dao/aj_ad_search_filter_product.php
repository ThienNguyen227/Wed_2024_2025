<?php 
    require_once "pdo.php"; 
    include "global.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 4;
    $offset = ($page - 1) * $limit;

    $filter = $_GET['filter'] ?? '';
    $keyword = $_GET['keyword'] ?? '';
    $keyword = "%$keyword%";

    // Tạo mảng tham số và điều kiện WHERE
    $where = "WHERE name LIKE ?";
    $params = [$keyword];

    // Ánh xạ filter sang category_id nếu có
    $category_map = ['coffee' => 1, 'tea' => 2, 'cake' => 3, 'ame' => 4];
    if (array_key_exists($filter, $category_map)) {
        $where .= " AND product_category_id = ?";
        $params[] = $category_map[$filter];
    }

    // Điều kiện sắp xếp
    $order = "ORDER BY id DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY id ASC";
    }

    // Tạo câu truy vấn
    $sql = "SELECT * FROM product $where AND product_category_id IN (1,2,3,4) $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM product $where";

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
                                    <td class="text-center">' . number_format($price) . '</td>
                                    <td class="text-center">
                                        <a href="index.php?pg=product_update&id=' . $id . '" class="btn btn-success">
                                            <i class="bi bi-pencil-square me-1"></i> Chỉnh Sửa
                                        </a>
                                        <a href="index.php?pg=handle_subtraction_product&id=' . $id . '" class="btn btn-danger">
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
        'list_product' => $html_list_product,
        'pagination' => $html_pagination
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>
