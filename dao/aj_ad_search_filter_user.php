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
    $where = "WHERE phone LIKE ? OR email LIKE ? OR name LIKE ? OR address LIKE ? OR id LIKE ?";
    $params = [$keyword, $keyword, $keyword, $keyword, $keyword];

    // Điều kiện sắp xếp
    $order = "ORDER BY id DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY id ASC";
    }

    // Tạo câu truy vấn
    $sql = "SELECT * FROM user $where $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM user $where";

    // Lấy tổng số sản phẩm
    $total_users = (int)pdo_query_value($sql_count, ...$params);
    $total_pages = ceil($total_users / $limit);

    // Lấy danh sách sản phẩm
    $list_users = pdo_query($sql, ...$params);

    // Tạo HTML danh sách sản phẩm
    $html_list_user = '';
    $i = $offset + 1;
    foreach ($list_users as $ls_u) {
        extract($ls_u);
        $formatted_date = date('H:i:s - d/m/Y', strtotime($created_at));
        $html_list_user  .= '<tr class="text-center align-middle">
                                    <td>'.$i.'</td>
                                    <td>'.$id.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$phone.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$address.'</td>
                                    <td>'.$formatted_date.'</td>
                                    <td>
                                        <a href="index.php?pg=management_user_update&user_id=' . $id . '" class="btn btn-success ">
                                            <i class="bi bi-pencil-square"></i> Chỉnh sửa
                                        </a>

                                        <a href="index.php?pg=handle_subtraction_user&user_id=' . $id . '" class="btn btn-danger ">
                                            <i class="bi bi-trash me-1"></i> Xóa
                                        </a>

                                        <a href="index.php?pg=management_user_order&user_id=' . $id . '" class="btn btn-warning ">
                                            <i class="bi bi-eye"></i> Xem đơn hàng
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
        'list_product' => $html_list_user,
        'pagination' => $html_pagination
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>
