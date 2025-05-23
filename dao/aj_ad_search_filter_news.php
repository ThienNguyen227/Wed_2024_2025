<?php
    require_once "pdo.php";
    include "global.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 4;
    $offset = ($page - 1) * $limit;

    $filter = $_GET['filter'] ?? '';
    $keyword = $_GET['keyword'] ?? '';

    $where = "WHERE content LIKE ? OR title LIKE ?";
    $params = ["%$keyword%", "%$keyword%"];

    // Cập nhật category_map để bao gồm tất cả các type
    $category_map = [
        'coffeeholic' => 1,
        'teaholic' => 2,
        'sales' => 3,
        'bannerhome' => 4,
        'adtypeproduct' => 5,
        'signature' => 6,
        'signature_by_t' => 7,
        'company_info' => 8,
        'contact_info' => 9
    ];
    if (array_key_exists($filter, $category_map)) {
        $where .= " AND type = ?";
        $params[] = $category_map[$filter];
    }

    $order = "ORDER BY id DESC";
    if ($filter == 'oldest') {
        $order = "ORDER BY id ASC";
    }

    $sql = "SELECT * FROM news $where $order LIMIT $limit OFFSET $offset";
    $sql_count = "SELECT COUNT(*) FROM news $where";

    $total_news = (int)pdo_query_value($sql_count, ...$params);
    $total_pages = ceil($total_news / $limit);

    $list_news = pdo_query($sql, ...$params);

    $html_list_news = '';
    $i = $offset + 1;
    foreach ($list_news as $ls_news) {
        extract($ls_news);
        $html_list_news .= '<tr>
                                <td>' . $i . '</td>
                                <td>' . htmlspecialchars($title) . '</td>
                                <td class="text-start">' . htmlspecialchars($content) . '</td>
                                <td><img src="' . IMG_PATH_ADMIN_NEWS . htmlspecialchars($image) . '" alt="Hình ảnh tin tức" width="100"></td>
                                <td>' . htmlspecialchars($created_at) . '</td>
                                <td>
                                    <a href="index.php?pg=management_news_update&news_id=' . $id . '" class="btn btn-success">
                                        <i class="bi bi-pencil-square"></i> Chỉnh sửa
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal_' . $id . '">
                                        <i class="bi bi-trash me-1"></i> Xóa
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal_' . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel"><i class="bi bi-exclamation-diamond"></i> Xác nhận xóa tin tức</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa tin tức này không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Hủy</button>
                                            <a href="index.php?pg=handle_subtraction_news&news_id=' . $id . '" class="btn btn-danger">
                                                <i class="bi bi-trash"></i> Xóa
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
        $html_pagination .= '<button onclick="loadProductsWithSearch(' . $i . ', \'' . $escaped_filter . '\', \'' . $escaped_keyword . '\')" class="' . $active_class . '">' . $i . ' ' . $icon . '</button> ';
    }

    $response = [
        'list_product' => $html_list_news,
        'pagination' => $html_pagination
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
?>