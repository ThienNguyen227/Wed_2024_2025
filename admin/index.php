<?php 
    session_start();
    ob_start();

    // Nhúng kết nối
    include "../dao/global.php";
    include "../dao/pdo.php";
    include "../dao/product.php";
    include "../dao/categories.php";
    include "../dao/user.php";
    include "../dao/statistics.php";



    include "view/header.php"; 


    if (isset($_GET['pg']))
    {
        $pg = $_GET['pg'];
        switch ($pg) 
        {
            // Trang thêm giảm giá
            case 'discount_add':
                include "view/discount_add.php";
                break;
            // Trang list giảm giá
            case 'discount_list':
                include "view/discount_list.php";
                break;
            // Trang cập nhật giảm giá
            case 'discount_update':
                if(isset($_GET["discount_id"]) && $_GET["discount_id"]>0)
                {
                    $discount_id = $_GET["discount_id"];
                    $info_discount = get_discount_by_discount_id($discount_id);
                    include "view/discount_update.php";
                }
                break;
            // Trang thống kê
            case 'management_statistics':
                $total_products = ad_get_total_products();
                $total_packed_products = ad_get_total_packed_products();
                $total_orders = ad_get_total_orders();
                $total_today_orders = ad_get_total_today_orders();
                $total_customers = ad_get_total_customers();
                $total_today_customers = ad_get_total_today_customers();
                
                $total_revenue = ad_get_total_revenue();
                $total_today_revenue = ad_get_total_today_revenue();
                include "view/management_statistics.php";
                break;
            // Trang thêm tin tức
            case 'management_news_add':
                $news_categories = news_categories();
                include "view/management_news_add.php";
                break;
            // Trang chỉnh sửa tin tức
            case 'management_news_update':
                if(isset($_GET["news_id"]) && $_GET["news_id"]>0)
                {
                    $news_id = $_GET["news_id"];
                    $info_news = get_news_by_news_id($news_id);
                    include "view/management_news_update.php";
                }
                
                break;
            //Trang tin tức
            case 'management_news':
                $news = get_news();
                include "view/management_news.php";
                break;
            // Trang xem đơn hàng của người dùng
            case 'management_user_order':
                if(isset($_GET["user_id"]) && $_GET["user_id"]>0)
                {
                    $user_id = $_GET["user_id"];
                    $info_order = get_order_by_user_id($user_id);
                    include "view/management_user_order.php"; 
                }
                
                break;
            // Trang chỉnh sửa người dùng
            case 'management_user_update':
                if(isset($_GET["user_id"]) && $_GET["user_id"]>0)
                {
                    $user_id = $_GET["user_id"];
                    $info_user = get_user_by_user_id($user_id);
                    include "view/management_user_update.php"; 
                }
                
                break;

            // Trang thêm người dùng
            case 'management_user_add':
                include "view/management_user_add.php";
                break;
            // Trang điều chỉnh trạng thái thanh toán, trạng thái đơn hàng
            case 'product_order_adjust_status':
                if(isset($_GET["bill_id"]) && $_GET["bill_id"]>0)
                {
                    $bill_id = $_GET["bill_id"];
                    $bill = get_bill_by_bill_id($bill_id);
                    include "view/product_order_adjust_status.php"; 
                } 
                 
                break;
            // Trang thêm sản phẩm đóng gói
            case 'product_packed_add':
                $product_categories_packed_product = get_categories_packed_product();
                include "view/product_packed_add.php"; 
                break;
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
            // Trang cập nhật sản phẩm đóng gói
            case 'product_packed_update':
                if(isset($_GET["id"]) && $_GET["id"]>0)
                {
                    $id_pro = $_GET["id"];
                    $product_categories_packed_product = get_categories_packed_product();
                    $product_by_id = get_product_by_id($id_pro);
                    include "view/product_packed_update.php"; 
                } 
                break;
            // Trang sản phẩm đóng gói
            case 'product_list_packed':
                include "view/product_list_packed.php";
                break;
            // Trang quản lí đơn hàng
            case 'product_order':
                include "view/product_order.php"; 
                break;

            // Trang quản lí khách hành
            case 'management_user':

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
            case 'handle_edition_product':

                if(isset($_POST["update_product"])){
                    $id_pro = $_POST["id"];
                    $name = $_POST['name'];
                    $category_id = $_POST['category_id'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];

                    $old_pro = get_product_by_id($id_pro);
                    $old_img_pro =  $old_pro['img'];


                    $img = $_FILES['image']['name'];
                    if($img!=''){
                        $target_file = IMG_PATH_ADMIN_PRODUCT.$img;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }else {
                        $img = $old_img_pro; 
                    }

                    update_product($name, $category_id, $price, $description, $img, $id_pro);
                    $_SESSION['tb_success_edition'] = "Chỉnh sửa sản phẩm thành công!";

                    header('location: index.php?pg=product_list');


                }
                break;

            // 4. Chức năng xử lí chỉnh sửa sản phẩm đóng gói
            case 'handle_edition_packed_product':

                if(isset($_POST["update_packed_product"])){
                    $id_pro = $_POST["id"];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];
                    $product_quantity = $_POST['product_quantity'];


                    $old_pro = get_product_by_id($id_pro);
                    $old_img_pro =  $old_pro['img']; 



                    $img = $_FILES['image']['name'];

                    // Khách hàng chỉ muốn update những thông tin khác của sản phẩm mà không update hình ảnh
                    if($img!=''){
                        $target_file = IMG_PATH_ADMIN_PRODUCT.$img;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }else {
                        $img = $old_img_pro; 
                    }

                    update_packed_product($name, $price,  $description, $product_quantity, $img, $id_pro);
                    $_SESSION['tb_success_edition'] = "Chỉnh sửa sản phẩm thành công!";

                    header('location: index.php?pg=product_list_packed');


                }
                break;

            // 5. Chức năng xử lý thêm sản phẩm đóng gói
            case 'handle_addition_packed_product': 
                if(isset($_POST["add_packed_product"])){
                    $img = $_FILES["image"]["name"];
                    $name = $_POST["name"];
                    $price = $_POST["price"];
                    $product_quantity = $_POST["product_quantity"];
                    $categories = $_POST["category_id"];
                    $description = $_POST["description"];
                    
                    add_packed_product($img, $name, $price, $product_quantity, $categories, $description);

                    // Upload hình ảnh vào file
                    $target_file = IMG_PATH_ADMIN_PRODUCT.$img;
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                    $_SESSION['tb_success_addition'] = "Thêm sản phẩm thành công !!!";

                    header('location: index.php?pg=product_list_packed');

                } else {
                    include "view/product_add.php"; 
                }
                break;
            
            // 6. Chức năng xử lý xóa sản phẩm đóng gói
            case 'handle_subtraction_packed_product': 

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
                    
                    
                    header('location: index.php?pg=product_list_packed');
                }
                break;
            
            // 7. Chức năng xử lí điều chỉnh trạng thái(thanh toán, đơn hàng)
            case 'handle_edition_status_order':
                if(isset($_POST["edit_status_order"])){
                    $bill_id = $_POST["bill_id"];
                    $payment_status = $_POST["payment_status"];
                    $status = $_POST["status"];

                    adjust_status($payment_status, $status, $bill_id);
                    $_SESSION['tb_success_edition'] = "Cập nhật trạng thái của đơn hàng #" . $bill_id . " thành công.";
                    header('location: index.php?pg=product_order');
                }
                break;

            // 8. Chức năng xử lí thêm người dùng
            case 'handle_addition_user':
                if(isset($_POST["add_user"])){
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $address = $_POST["address"];
                    $role = $_POST["role"];

                    // Check Name
                    // \p{L}: a-z A-Z có dấu, \s: space, 
                    if (!preg_match('/^[\p{L}\s]{1,10}$/u', $name)) {
                        $_SESSION['tb_invalid_name'] = "Tên chỉ được chứa chữ cái, khoảng trắng và tối đa 10 ký tự!";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }
                
                    // Check Phone
                    // 1. Check số lượng của số lẫn chữ
                    if (!preg_match('/^\d{10}$/', $phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại không hợp lệ. Số điện thoại phải có đúng 10 chữ số!";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }
                    // 2. Check bắt đầu bằng số 0
                    if (!preg_match('/^0\d{9}$/', $phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0!";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }
                    // 3. Check đúng định dạng số điện thoại Việt Nam
                    if (!preg_match('/^(03[2-9]|05[6|8|9]|07[0|6-9]|08[1-9]|09[0-9])\d{7}$/', $phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại không hợp lệ. Hãy nhập đúng định dạng số di động Việt Nam!";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }
                    // 4. Check phone đã tồn tại hay chưa?
                    if (check_phone_exists_without_id($phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại đã được đăng ký!";
                        header('location: index.php?pg=management_user_add'); 
                        exit();
                    }

                    
                    // Check email
                    // 1. Check phần tên người dùng trước @
                    if (!preg_match('/^[\w\.\-]+/', $email)) {
                        $_SESSION['tb_invalid_email'] = "Tên email không hợp lệ. Chỉ được dùng chữ, số, dấu chấm (.) hoặc gạch ngang (-, _).";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }

                    // 2. Check có chứa ký tự @ không
                    if (strpos($email, '@') === false) {
                        $_SESSION['tb_invalid_email'] = "Email phải chứa ký tự @.";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }

                    // 3. Check có tên miền sau @ không (ví dụ: gmail, yahoo...)
                    $parts = explode('@', $email);
                    if (!isset($parts[1]) || !preg_match('/^[\w\-]+(\.[\w\-]+)*$/', $parts[1])) {
                        $_SESSION['tb_invalid_email'] = "Thiếu hoặc sai tên miền.";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }

                    // 4. Check có đuôi miền (như .com, .vn) không
                    if (!preg_match('/\.[a-zA-Z]{2,}$/', $email)) {
                        $_SESSION['tb_invalid_email'] = "Thiếu đuôi miền (.com, .vn, ...).";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }
                    // 5. Check tồn tại email
                    if (check_email_exists_without_id($email) ) {
                        $_SESSION['tb_invalid_email'] = "Email đã được đăng ký!";
                        header('location: index.php?pg=management_user_add'); 
                        exit();
                    }


                    // Check password 
                    // ít nhất 1 chữ thường, 1 chữ hoa, 1 số, 1 kí tự đặc biệt, it nhất 8 kí tự
                    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                        $_SESSION['tb_invalid_password'] = "Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }

                    if(preg_match('/[àáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựỳýỷỹỵ]/i', $password)){
                        $_SESSION['tb_invalid_password'] = "Mật khẩu không được chứa kí tự Tiếng Việt!";
                        header('location: index.php?pg=management_user_add');
                        exit();
                    }
            
                    // Mã hóa mật khẩu trước khi đưa vào DB
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    ad_add_user($name, $phone, $email, $hashed_password, $address, $role);
                    $_SESSION['tb_success_add_user'] = "Thêm người dùng thành công.";
                    header('location: index.php?pg=management_user');
                    exit();
                }
                break;
            // 9. Chức năng xử lí chỉnh sửa người dùng   
            case 'handle_edition_user':
                if(isset($_POST["edit_user"])){
                    $id = $_POST["id"];
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $address = $_POST["address"];
                    $role = $_POST["role"];

                    // Check Phone
                    // 1. Check số lượng của số lẫn chữ
                    if (!preg_match('/^\d{10}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Số điện thoại phải có đúng 10 chữ số!";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }
                    // 2. Check bắt đầu bằng số 0
                    if (!preg_match('/^0\d{9}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0!";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }
                    // 3. Check đúng định dạng số điện thoại Việt Nam
                    if (!preg_match('/^(03[2-9]|05[6|8|9]|07[0|6-9]|08[1-9]|09[0-9])\d{7}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Hãy nhập đúng định dạng số di động Việt Nam!";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }
                    // 4. Check phone đã tồn tại hay chưa?
                    if (check_phone_exists($phone, $id)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại đã được đăng ký!";
                        header('location: index.php?pg=management_user_update&user_id='.$id); 
                        exit();
                    }

                    // Check email
                    // 1. Check phần tên người dùng trước @
                    if (!preg_match('/^[\w\.\-]+/', $email)) {
                        $_SESSION['tb_email_update'] = "Tên email không hợp lệ. Chỉ được dùng chữ, số, dấu chấm (.) hoặc gạch ngang (-, _).";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }

                    // 2. Check có chứa ký tự @ không
                    if (strpos($email, '@') === false) {
                        $_SESSION['tb_email_update'] = "Email phải chứa ký tự @.";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }

                    // 3. Check có tên miền sau @ không (ví dụ: gmail, yahoo...)
                    $parts = explode('@', $email);
                    if (!isset($parts[1]) || !preg_match('/^[\w\-]+(\.[\w\-]+)*$/', $parts[1])) {
                        $_SESSION['tb_email_update'] = "Thiếu hoặc sai tên miền.";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }

                    // 4. Check có đuôi miền (như .com, .vn) không
                    if (!preg_match('/\.[a-zA-Z]{2,}$/', $email)) {
                        $_SESSION['tb_email_update'] = "Thiếu đuôi miền (.com, .vn, ...).";
                        header('location: index.php?pg=management_user_update&user_id='.$id);
                        exit();
                    }
                    // 5. Check tồn tại email
                    if (check_email_exists($email, $id)) {
                        $_SESSION['tb_email_update'] = "Email đã được đăng ký!";
                        header('location: index.php?pg=management_user_update&user_id='.$id); 
                        exit();
                    }

                    ad_update_user($name, $phone, $email, $address, $role, $id);

                    $_SESSION['tb_update_thanhcong'] = "Cập nhật thông tin người dùng #".$id." thành công.";
                    header("Location: index.php?pg=management_user");
                    exit();

                }
                break;

            // 10. Chức năng xử lý xóa người dùng(ít sử dụng)
            case 'handle_subtraction_user': 

                if(isset($_GET["user_id"]) && $_GET["user_id"]>0){
                    $user_id = $_GET["user_id"];
                
                    try 
                    {
                        ad_delete_user($user_id);
                        $_SESSION['tb_success_delete'] = "Xóa người dùng thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_invalid_delete'] = "Xóa người dùng thất bại.";
                    }
                    
                    
                    header('location: index.php?pg=management_user');
                }
                break;
            // 11. Chức năng xử lý chỉnh sửa tin tức
            case 'handle_edition_news':
                if (isset($_POST["edit_news"])) {
                    $news_id = $_POST["id"];
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                
                    $old_news = get_news_by_news_id($news_id); 
                    $old_image = $old_news['image'];
                
                    $img = $_FILES['image']['name'];
                    if ($img != '') {
                        $target_file = IMG_PATH_ADMIN_NEWS . $img;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    } else {
                        $img = $old_image; // Giữ nguyên ảnh cũ nếu không chọn ảnh mới
                    }
                
                    ad_update_news($title, $content, $img, $news_id);
                    header('location: index.php?pg=management_news');
                }
                
                break;
            
            //  12. Chức năng xử lý xóa tin tức
            case 'handle_subtraction_news':
                if(isset($_GET["news_id"]) && $_GET["news_id"]>0){
                    $news_id = $_GET["news_id"];
                
                    try 
                    {
                        ad_delete_news($news_id);
                        // Xóa trong thư mục
                        $img = IMG_PATH_ADMIN_NEWS.get_img_by_news_id($news_id);
                        if(is_file($img)){
                            unlink($img);
                        }
                        $_SESSION['tb_success_delete'] = "Xóa tin tức thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_invalid_delete'] = "Xóa tin tức thất bại.";
                    }
                    
                    header('location: index.php?pg=management_news');
                }
                break;
            // 13. Chức năng sử lí thêm tin tức
            case 'handle_addition_news':
                if(isset($_POST["add_news"])){
                    $img = $_FILES["image"]["name"];
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    $type = $_POST["type"];

                    ad_add_news($img, $title, $content, $type);

                    // Upload hình ảnh vào file
                    $target_file = IMG_PATH_ADMIN_NEWS.$img;
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                    $_SESSION['tb_success_addition'] = "Thêm tin tức thành công !!!";

                    header('location: index.php?pg=management_news');

                }
                break;
            
            //14. Chức năng thêm mã giảm giá
            case 'handle_addition_discount':
                if(isset($_POST["add_discount"])){
                    $code = $_POST["code"];
                    $discount_percent = $_POST["discount_percent"];
                    $start_date = $_POST["start_date"];
                    $end_date = $_POST["end_date"];

                    ad_add_discount($code, $discount_percent, $start_date, $end_date);

                    $_SESSION['tb_success_addition'] = "Thêm mã giảm giá thành công.";

                    header('location: index.php?pg=discount_list');

                }
                break;
            // 15. Chức chỉnh xử mã giảm giá
            case 'handle_edition_discount':
                if (isset($_POST["edit_discount"])) {
                    $discount_id = $_POST["discount_id"];
                    $code = $_POST["code"];
                    $discount_percent = $_POST["discount_percent"];
                    $start_date = $_POST["start_date"];
                    $end_date = $_POST["end_date"];
                
                    ad_update_discount($code, $discount_percent, $start_date, $end_date, $discount_id);

                    $_SESSION['tb_success_edition'] = "Thêm mã giảm giá thành công.";

                    header('location: index.php?pg=discount_list');
                }
                
                break;
            // 16. Chức năng xóa mã giảm giá
            case 'handle_subtraction_discount':
                if(isset($_GET["discount_id"]) && $_GET["discount_id"]>0){
                    $discount_id = $_GET["discount_id"];
                
                    try 
                    {
                        ad_delete_discount($discount_id);
                        
                        $_SESSION['tb_success_delete'] = "Xóa mã giảm giá thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_invalid_delete'] = "Xóa mã giảm giá thất bại.";
                    }
                    
                    header('location: index.php?pg=discount_list');
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