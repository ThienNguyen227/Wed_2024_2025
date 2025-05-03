<?php 
    session_start();
    ob_start();

    // Nhúng kết nối
    include "../dao/global.php";
    include "../dao/pdo.php";
    include "../dao/product.php";
    include "../dao/categories.php";
    include "../dao/user.php";



    include "view/header.php"; 


    if (isset($_GET['pg']))
    {
        $pg = $_GET['pg'];
        switch ($pg) 
        {
            // Trang danh sách sản phẩm 
            case 'product_list':
                include "view/product_list.php"; 
                break;
            // Trang thêm sản phẩm
            case 'product_add':
            
                $product_categories = categories_all();

                include "view/product_add.php"; 
                break;
            // Trang cập nhật sản phẩm
            case 'product_update':
                $product_categories = categories_all();
                if(isset($_GET["id"]) && $_GET["id"]>0)
                {
                    $id_pro = $_GET["id"];
                    
                    $product_by_id = get_product_by_id($id_pro);

                    include "view/product_update.php"; 
                } 
                break;
            // Trang quản lí đơn hàng
            case 'product_order';

                $all_list_order = get_all_list_orders();
                
                include "view/product_order.php"; 
                break;

            
            // Trang quản lí khách hành
            case 'management_user';

                $all_list_user = get_all_list_user();
                

                include "view/management_user.php"; 
                break;
            // 1. Chức năng xử lý thêm sản phẩm
            case 'handle_addition_product': 
                if(isset($_POST["add_product"])){
                    $img = $_FILES["image"]["name"];
                    $name = $_POST["name"];
                    $categories = $_POST["category_id"];
                    $price = $_POST["price"];
                    $description = $_POST["description"];
                    
                    add_product($img, $name, $categories, $price, $description);

                    // Upload hình ảnh vào file
                    $target_file = IMG_PATH_ADMIN_PRODUCT.$img;
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                    $_SESSION['tb_success_addition'] = "Thêm sản phẩm thành công !!!";

                    header('location: index.php?pg=product_list');

                } else {
                    include "view/product_add.php"; 
                }
                break;

            // 2. Chức năng xử lý xóa sản phẩm
            case 'handle_subtraction_product': 

                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];
                
                    try 
                    {
                        delete_product($id_pro);
                        // Xóa trong thư mục
                        $img = IMG_PATH_ADMIN_PRODUCT.get_img_by_id($id_pro);
                        if(is_file($img)){
                            unlink($img);
                        }
                        $_SESSION['tb_success_delete'] = "Xóa sản phẩm thành công !!!";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_invalid_delete'] = "Sản phẩm đã được đặt hàng không được quyền xóa!!!";
                    }
                    
                    
                    header('location: index.php?pg=product_list');
                }
                break;

            // 3. Chức năng xử lí chỉnh sửa sản phẩm
            case 'handle_edition_product';
                if(isset($_POST["update_product"])){
                    $id_pro = $_POST["id"];
                    $name = $_POST['name'];
                    $category_id = $_POST['category_id'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];

                    $img = $_FILES['image']['name'];

                    // Khách hàng chỉ muốn update những thông tin khác của sản phẩm mà không update hình ảnh
                    if($img!=''){
                        $target_file = IMG_PATH_ADMIN_PRODUCT.$img;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }else {
                        $img = ''; 
                    }

                    update_product($name, $category_id, $price,  $description, $id_pro);
                    $_SESSION['tb_success_edition'] = "Chỉnh sửa sản phẩm thành công!";

                    header('location: index.php?pg=product_list');


                }
                break;

            // 4. Chức năng xử lí điều chỉnh trạng thái thanh toán, trạng thái đơn hàng
            case 'handle_adjustment_status':
                if(isset($_POST["adjust_status"])){
                    $bill_id = $_POST["bill_id"];

                    $payment_status = $_POST["payment_status"];

                    $status = $_POST["order_status"];

                    adjust_status($payment_status, $status, $bill_id);

                    $_SESSION['tb_success_adjustment'] = "Điều chỉnh trạng thái thành công!";

                    header('location: index.php?pg=product_order');

                }

                break;









            // Mặc định quay về trang home
            default:
                include "view/home.php"; 
                break;
        }
    }else{
        include "view/home.php"; 
    }

    include "view/footer.php"; 

    ob_end_flush();
?>