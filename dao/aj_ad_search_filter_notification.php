<?php 
    require_once "pdo.php"; 
    include "global.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 2;
    $offset = ($page - 1) * $limit;

    $filter = $_GET['filter'] ?? '';
    $keyword = $_GET['keyword'] ?? '';
    $keyword = "%$keyword%";

    // Tạo mảng tham số và điều kiện WHERE
    $where = "WHERE notification_title LIKE ?";
    $params = [$keyword];

    // Điều kiện sắp xếp
    $order = "ORDER BY notification_id DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY notification_id ASC";
    }

    // Tạo câu truy vấn
    $sql = "SELECT * FROM total_notifications $where AND user_id IS NULL $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM total_notifications $where AND user_id IS NULL";

    // Lấy tổng số sản phẩm
    $total_notification = (int)pdo_query_value($sql_count, ...$params);
    $total_pages = ceil($total_notification / $limit);

    // Lấy danh sách sản phẩm
    $list_notification = pdo_query($sql, ...$params);

    // Tạo HTML danh sách sản phẩm
    $html_list_notification= '';
    $i = $offset + 1;
    foreach ($list_notification as $ls_no) {
        extract($ls_no);
            $html_list_notification .= '<tr>
                                            <td class="text-center">' . $i . '</td>
                                            <td>' . htmlspecialchars($notification_title) . '</td>
                                            <td class="text-center">' . htmlspecialchars($notification_message) . '</td>
                                            <td class="text-center">' . htmlspecialchars($created_at) . '</td>
                                            <td class="text-center">' . htmlspecialchars($updated_at) . '</td>
                                            <td class="text-center">
                                                <a href="index.php?pg=notification_update&id=' . htmlspecialchars($notification_id) . '" class="btn btn-success">
                                                    <i class="bi bi-pencil-square me-1"></i> Chỉnh Sửa
                                                </a>
                                                <a href="index.php?pg=handle_subtraction_notification&id=' . htmlspecialchars($notification_id) . '" class="btn btn-danger">
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
        'list_product' => $html_list_notification,
        'pagination' => $html_pagination
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>
