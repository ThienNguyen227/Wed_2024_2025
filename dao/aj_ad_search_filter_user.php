<?php
    require_once "pdo.php"; 

    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';  // Lọc theo filter
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : ''; // Tìm kiếm theo keyword

    
    $sql = "SELECT * FROM user WHERE name LIKE ? OR phone LIKE ? OR email LIKE ? OR address LIKE ?";
    $keyword = "%$keyword%";

    if ($filter == 'name_asc') {
        $sql .= " ORDER BY name ASC";
    } elseif ($filter == 'name_desc') {
        $sql .= " ORDER BY name DESC";
    } elseif ($filter == 'newest') {
        $sql .= " ORDER BY created_at DESC";
    } elseif ($filter == 'oldest') {
        $sql .= " ORDER BY created_at ASC";
    }

    
    $users = pdo_query($sql, $keyword, $keyword, $keyword, $keyword);


    $html = '';
    $i = 1;
    foreach ($users as $user) {
        $formatted_date = date('H:i:s - d/m/Y', strtotime($user['created_at']));
        $html .= '<tr class="text-center align-middle">
                    <td>'.$i.'</td>
                    <td>'.$user['id'].'</td>
                    <td>'.$user['name'].'</td>
                    <td>'.$user['phone'].'</td>
                    <td>'.$user['email'].'</td>
                    <td>'.$user['address'].'</td>
                    <td>'.$formatted_date.'</td>
                </tr>';
        $i++;
    }

    echo $html;
?>
