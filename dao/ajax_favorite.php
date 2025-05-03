<?php
    session_start();
    require_once "pdo.php"; 
    require_once "product.php";

    header('Content-Type: application/json');

    if (isset($_POST['product_id']) && isset($_SESSION['s_user'])) {
        $user_id = $_SESSION['s_user']['id'];
        $product_id = $_POST['product_id'];

        $favorite = check_favorite($user_id, $product_id);

        if ($favorite) {
            delete_favorite($user_id, $product_id);
            echo json_encode(['status' => 'removed']);
        } else {
            insert_favorite($user_id, $product_id);
            echo json_encode(['status' => 'added']);
        }
    } else {
        echo json_encode(['status' => 'error']);
    }
?>