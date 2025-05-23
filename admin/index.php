<?php 
    session_start();
    ob_start();

    // Nhúng kết nối các file trong thư mục dao
    include "../dao/global.php";
    include "../dao/pdo.php";
    include "../dao/product.php";
    include "../dao/categories.php";
    include "../dao/user.php";
    include "../dao/statistics.php";

    // Phần gửi Otp qua email để xác thực
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    

    // Nếu là trang đăng kí, đăng nhập, quên mật khẩu, otp, đổi mật khẩu thì không include header và footer vào
    $no_header_footer = isset($_GET['pg']) && in_array($_GET['pg'], ['login_admin', 'login_forgot', 'quenmatkhau', 'otp', 'doimatkhau']);

    if (!$no_header_footer) {
        include "view/header.php";
        include "view/slide_bar.php";
    }

    if (isset($_GET['pg']))
    {
        $pg = $_GET['pg'];
        switch ($pg) 
        {
            // Trang đổi mật khẩu admin
            case 'doimatkhau';
                include "view/doimatkhau.php";
                break;
            // Trang quên mật khẩu ADMIN
            case 'otp':
                include "view/otp.php";
                break;
            // Trang quên mật khẩu ADMIN
            case 'login_forgot':
                include "view/login_forgot.php";
                break;

            // Trang cài đặt ADMIN
            case 'setting':
                include "view/setting.php";
                break;

            // Trang đăng nhập ADMIN
            case 'login_admin':
                include "view/login_admin.php";
                break;

            
            // Trang cập nhật thông báo
            case 'notification_update':
                if(isset($_GET["id"]) && $_GET["id"]>0)
                {
                    $id_notification = $_GET["id"];
                    $notification_by_id = get_notification_by_id($id_notification);
                    include "view/notification_update.php";
                } 
                break;
            // Trang thêm thông báo
            case 'notification_add':
                include "view/notification_add.php";
                break;
            // Trang thông báo
            case 'notification_list':
                include "view/notification_list.php";
                break;
            // Trang thêm danh mục giảm giá
            case 'discount_add_categories_apply':
                include "view/discount_add_categories_apply.php";
                break;
            // Trang thêm giảm giá
            case 'discount_add':
                $categories_apply = get_apply_discount_categories();
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

                    // CK file hình ảnh
                    if (!empty($img)) {
                        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                        $file_type = $_FILES["image"]["type"];
                        $file_size = $_FILES["image"]["size"];
                        $max_size = 5 * 1024 * 1024; // Giới hạn 5MB

                        // Kiểm tra định dạng file
                        if (!in_array($file_type, $allowed_types)) {
                            $_SESSION['tb_error'] = "Chỉ chấp nhận file hình ảnh (JPG, PNG, GIF).";
                            header('location: index.php?pg=product_add');
                            exit();
                        }

                        // Kiểm tra kích thước file
                        if ($file_size > $max_size) {
                            $_SESSION['tb_error'] = "Kích thước file không được vượt quá 5MB.";
                            header('location: index.php?pg=product_add');
                            exit();
                        }
                    } else {
                        $_SESSION['tb_error'] = "Vui lòng chọn một file hình ảnh.";
                        header('location: index.php?pg=product_add');
                        exit();
                    }

                    // CK tên chỉ được chứa chữ cái và khoảng trắng
                    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
                        $_SESSION['tb_error'] = "Tên sản phẩm chỉ được chứa chữ cái và khoảng trắng.";
                        header('location: index.php?pg=product_add');
                        exit(); 
                    }
                    
                    // CK giá phải là số dương
                    if (!is_numeric($price) || $price <= 0) {
                        $_SESSION['tb_error'] = "Giá sản phẩm phải là số dương.";
                        header('location: index.php?pg=product_add');
                        exit(); 
                    }

                    add_product($img, $name, $categories, $price, $description);

                    // Upload hình ảnh vào file
                    $target_file = IMG_PATH_ADMIN_PRODUCT.$img;
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                    $_SESSION['tb_success'] = "Thêm sản phẩm <strong>'".$name."'</strong> thành công.";

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
                        $_SESSION['tb_success'] = "Xóa sản phẩm thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_danger'] = "Sản phẩm đã được đặt hàng không được quyền xóa.";
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
                    $_SESSION['tb_success'] = "Chỉnh sửa sản phẩm <strong>'".$name."'</strong> thành công.";

                    header('location: index.php?pg=product_list');


                }
                break;
            // Chức năng xử lí ẩn sản phẩm
            case 'handle_hidden_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_status_hidden($id_pro);

                    $_SESSION['tb_success'] = "Sản phẩm đã được ẩn thành công.";

                    header('location: index.php?pg=product_list');
                }
                break;
            

            // Chức năng xử lí hiện sản phẩm
            case 'handle_show_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_status_show($id_pro);

                    $_SESSION['tb_success'] = "Sản phẩm đã hiện thành công.";

                    header('location: index.php?pg=product_list');
                }
                break;
            // Chức năng thêm bestseller cho sản phẩm
            case 'handle_bestseller_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_bestseller($id_pro);

                    $_SESSION['tb_success'] = "Đã thêm bestseller cho sản phẩm thành công.";

                    header('location: index.php?pg=product_list');
                }
                break;

            // Chức năng gỡ bestseller cho sản phẩm
            case 'handle_cancel_bestseller_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_cancel_bestseller($id_pro);

                    $_SESSION['tb_danger'] = "Đã gỡ bestseller cho sản phẩm thành công.";

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
                    $_SESSION['tb_success'] = "Chỉnh sửa sản phẩm <strong>'".$name."'</strong> thành công.";

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

                    $_SESSION['tb_success'] = "Thêm sản phẩm <strong>'".$name."'</strong> thành công.";

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
                        $_SESSION['tb_success'] = "Xóa sản phẩm thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_danger'] = "Sản phẩm đã được đặt hàng không được quyền xóa sản phẩm!!!";
                    }
                    
                    
                    header('location: index.php?pg=product_list_packed');
                }
                break;
            // Chức năng xử lí ẩn sản phẩm đóng gói
            case 'handle_hidden_packed_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_status_hidden($id_pro);

                    $_SESSION['tb_success'] = "Sản phẩm đóng gói đã được ẩn thành công.";

                    header('location: index.php?pg=product_list_packed');
                }
                break;
            

            // Chức năng xử lí hiện sản phẩm
            case 'handle_show_packed_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_status_show($id_pro);

                    $_SESSION['tb_success'] = "Sản phẩm đóng gói đã hiện thành công.";

                    header('location: index.php?pg=product_list_packed');
                }
                break;
            // Chức năng thêm bestseller cho sản phẩm
            case 'handle_bestseller_packed_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_bestseller($id_pro);

                    $_SESSION['tb_success'] = "Đã thêm bestseller cho sản phẩm đóng gói thành công.";

                    header('location: index.php?pg=product_list_packed');
                }
                break;

            // Chức năng gỡ bestseller cho sản phẩm
            case 'handle_cancel_bestseller_packed_product':
                case 'handle_cancel_bestseller_product':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_pro = $_GET["id"];

                    ad_update_product_cancel_bestseller($id_pro);

                    $_SESSION['tb_danger'] = "Đã gỡ bestseller cho sản phẩm đóng gói thành công.";

                    header('location: index.php?pg=product_list_packed');
                }
                break;
            // 7. Chức năng xử lí điều chỉnh trạng thái(thanh toán, đơn hàng)
            case 'handle_edition_status_order':
                if(isset($_POST["edit_status_order"])){
                    $bill_id = $_POST["bill_id"];
                    $payment_status = $_POST["payment_status"];
                    $status = $_POST["status"];
                    $id_user = $_POST["id_user"];

                    // $bill_detail = get_bill_detail_by_bill_id($bill_id);
                    
                    // $total_price = $bill_detail['total_price'];
                    
                    // $targets = get_target_total_bill();
                    // $selected_target = 0;
                    // foreach ($targets as $target) {
                    //     $threshold = $target['target_total_bill'];

                       
                    //     if ($total_price >= $threshold) {
                           
                    //         if ($selected_target === null || $threshold > $selected_target) {
                    //             $selected_target = $threshold;
                    //         }
                    //     }
                    // }

                    // if ($selected_target !== null) {
                    //     $id_discount_categories = get_id_discount($selected_target);
                    //     $id_discountss = get_id_discount_main($id_discount_categories);
                    //     $id_discount = $id_discountss['discount_id'];
                    //     $code = $id_discountss['code'];
                    //     $percent = $id_discountss['discount_percent'];

                    //     insert_customer_discount($id_discount, $id_user);

                    //     $title = "Thông báo nhận mã giảm giá.";
                    //     $message = "Bạn đã nhận được mã giảm giá $code giảm $percent(%)";

                    //     insert_notification($id_user, $title, $message);
                    // }                     

                    adjust_status($payment_status, $status, $bill_id);



                    $_SESSION['tb_success_edition'] = "Cập nhật trạng thái của đơn hàng <strong>#" . $bill_id . "</strong> thành công.";
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
                    $_SESSION['tb_success'] = "Thêm người dùng <strong>".$name."</strong> thành công.";
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

                    var_dump($id, $name, $phone, $address, $email, $role);
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

                    $_SESSION['tb_success'] = "Cập nhật thông tin người dùng <strong>#".$id."</strong> thành công.";

                    header("Location: index.php?pg=management_user");
                    exit();

                }
                break;

            // 10. Chức năng xử lý xóa người dùng(hiếm sử dụng)
            case 'handle_subtraction_user': 

                if(isset($_GET["user_id"]) && $_GET["user_id"]>0){
                    $user_id = $_GET["user_id"];
                
                    try 
                    {
                        ad_delete_user($user_id);
                        $_SESSION['tb_success'] = "Xóa người dùng thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_danger'] = "Xóa người dùng thất bại.";
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
                        $img = $old_image; 
                    }
                
                    ad_update_news($title, $content, $img, $news_id);
                    $_SESSION['tb_success'] = "Chỉnh sửa tin tức <strong>#".$title."</strong> thành công.";
                    header('location: index.php?pg=management_news');
                }
                
                break;
            
            // 12. Chức năng xử lý xóa tin tức
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

                    $_SESSION['tb_success'] = "Thêm tin tức <strong>".$title."</strong> thành công.";

                    header('location: index.php?pg=management_news');

                }
                break;
            
            // 14. Chức năng thêm mã giảm giá
            case 'handle_addition_discount':
                if(isset($_POST["add_discount"])){
                    $code = $_POST["code"];

                    $discount_percent = $_POST["discount_percent"];

                    $discount_amount = $_POST["discount_amount"];

                    $discount_apply = $_POST["apply_to"];

                    $start_date = $_POST["start_date"];

                    $end_date = $_POST["end_date"];

                    ad_add_discount($code, $discount_percent, $discount_amount, $discount_apply, $start_date, $end_date);

                    $_SESSION['tb_success'] = "Thêm mã giảm giá <strong>".$code."</strong> thành công.";

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

                    $_SESSION['tb_success'] = "Chỉnh sửa mã giảm giá <strong>".$code."</strong> thành công.";

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
                        
                        $_SESSION['tb_success'] = "Xóa mã giảm giá thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_danger'] = "Xóa mã giảm giá thất bại.";
                    }
                    
                    header('location: index.php?pg=discount_list');
                }
                break;
            // 17. Chức năng thêm danh mục khuyến mãi
            case 'handle_addition_categories_apply':
                if(isset($_POST["add_categories_apply"])){
                    $name = $_POST["name"];

                    $target_total_bill = $_POST["target_total_bill"];

                    ad_add_categories_discount_apply($name, $target_total_bill);

                    $_SESSION['tb_success_addition'] = "Thêm danh mục khuyến mãi thành công.";

                    header('location: index.php?pg=discount_add_categories_apply');
                }
                break;
                
                break;
            // 18. Chức năng thêm thông báo
            case 'handle_addition_notification':
                if(isset($_POST["add_notification"])){
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    $id_notification = $_POST["content"];

                    ad_add_notification($title, $content);

                    $_SESSION['tb_success'] = "Thêm thông báo <strong>'".$title."'</strong> thành công.";

                    header('location: index.php?pg=notification_list');

                }
                break;
            
            // 19. Chức năng chỉnh sửa thông báo
            case 'handle_edition_notification':
                if(isset($_POST["update_notification"])){
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    $id_notification = $_POST["id"];

                    ad_update_notification($title, $content, $id_notification);

                    $_SESSION['tb_success'] = "Chỉnh sửa thông báo <strong>'".$title."'</strong> thành công.";

                    header('location: index.php?pg=notification_list');

                }
                break;
            // 20. Chức năng xóa thông báo
            case 'handle_subtraction_notification':
                if(isset($_GET["id"]) && $_GET["id"]>0){
                    $id_notification = $_GET["id"];
        
                    try 
                    {
                        ad_delete_notification($id_notification);
                        
                        $_SESSION['tb_success'] = "Xóa thông báo thành công.";
                    } catch (\Throwable $th) {
                        $_SESSION['tb_danger'] = "Xóa thông báo thất bại.";
                    }
                    
                    header('location: index.php?pg=notification_list');
                }
                break;
            
            // 21. Chức năng đăng nhập admin
             case 'login':
                if (isset($_POST["dangnhap"]) && ($_POST["dangnhap"])) {
                    $phone = $_POST["phone"];
                    $password = $_POST["password"];
                    
                    if(!check_phone_exists_without_id($phone)){
                        $_SESSION['tb_wrong_account'] = "Tài khoản không tồn tại! Vui lòng đăng nhập lại!";
                        header('location: index.php?pg=login_admin');
                        exit();  
                    }

                    // Lấy thông tin người dùng theo phone
                    $user = get_user_by_phone($phone);

                    if (!$user || !password_verify($password, $user['password'])) {
                        $_SESSION['tb_wrong_password'] = "Mật khẩu không chính xác! Vui lòng nhập lại.";
                        header('location: index.php?pg=login_admin');
                        exit();  
                    }
                     
                    $role = get_role_by_phone($phone);
                    if($role == 0){
                        $_SESSION['tb_wrong_account'] = "Tài khoản không tồn tại! Vui lòng đăng nhập lại!";
                        header('location: index.php?pg=login_admin');
                    }elseif($role == 1){
                        $_SESSION['admin_account'] = $user;
                        header('location: index.php?pg=home');
                    }

                    exit();
                }   
                break;
            
            // 22. Chức năng đăng xuất tài khoản admin
            case 'logout':
                if(isset($_SESSION['admin_account']) && count($_SESSION['admin_account']) >0){
                    unset($_SESSION['admin_account']);
                }
                header('location: index.php?pg=login_admin');
                break;
            // 23. Chức năng quên mật khẩu
            case 'forgot':
                if(isset($_POST["quenmatkhau"]) && ($_POST["quenmatkhau"])){
                    $email = $_POST["email"];
                    
                    // Check email
                    // 1. Check phần tên người dùng trước @
                    if (!preg_match('/^[\w\.\-]+/', $email)) {
                        $_SESSION['tb_invalid_email_5'] = "Tên email không hợp lệ. Chỉ được dùng chữ, số, dấu chấm (.) hoặc gạch ngang (-, _).";
                        header('location: index.php?pg=quenmatkhau');
                        exit();
                    }

                    // 2. Check có chứa ký tự @ không
                    if (strpos($email, '@') === false) {
                        $_SESSION['tb_invalid_email_6'] = "Email phải chứa ký tự @.";
                        header('location: index.php?pg=quenmatkhau');
                        exit();
                    }

                    // 3. Check có tên miền sau @ không (ví dụ: gmail, yahoo...)
                    $parts = explode('@', $email);
                    if (!isset($parts[1]) || !preg_match('/^[\w\-]+(\.[\w\-]+)*$/', $parts[1])) {
                        $_SESSION['tb_invalid_email_7'] = "Thiếu hoặc sai tên miền.";
                        header('location: index.php?pg=quenmatkhau');
                        exit();
                    }

                    // 4. Check có đuôi miền (như .com, .vn) không
                    if (!preg_match('/\.[a-zA-Z]{2,}$/', $email)) {
                        $_SESSION['tb_invalid_email_8'] = "Thiếu đuôi miền (.com, .vn, ...).";
                        header('location: index.php?pg=quenmatkhau');
                        exit();
                    }
                    // 5. Check xem email có không?
                    if (!check_email_exists_without_id($email)) {
                        $_SESSION['tb_email_exists_1'] = "Email không tồn tại!";
                        header('location: index.php?pg=quenmatkhau'); 
                        exit();
                    }
                    // 1. Sinh OTP và lưu vào session
                    $otp = rand(100000, 999999); // 6 chữ số
                    $_SESSION['otp'] = $otp;
                    $_SESSION['otp_email'] = $email; // Lưu lại email để xác nhận sau

                    // 2. Gửi OTP qua email
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();                                            
                        $mail->Host       = 'smtp.gmail.com';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'nguyenhoangnhutthien6666@gmail.com';                     
                        $mail->Password   = 'pcbd sutz uaxl zuhh';                               
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
                        $mail->Port       = 465;                                    

                        $mail->setFrom('nguyenhoangnhutthien6666@gmail.com', 'TCOFFEE');
                        $mail->addAddress($email);

                        $mail->isHTML(true);                                
                        $mail->Subject = 'T COFFE OTP';
                        $mail->Body    = 'Mã OTP của bạn là: <b>' . $otp . '</b>. Mã này sẽ hết hạn sau 5 phút.';
                        $mail->AltBody = 'Mã OTP của bạn là: ' . $otp;

                        $mail->send();
                        echo 'Đã gửi OTP';
                    } catch (Exception $e) {
                        echo "Không gửi được mã OTP. Lỗi: {$mail->ErrorInfo}";
                        exit();
                    }
                    header('location: index.php?pg=otp');
                    exit();
                }
                break;

            // 24. Chức năng xác nhận otp
            case 'confirmotp':
                if(isset($_POST["confirm_otp"]) && ($_POST["confirm_otp"])){
                    $otp_input = $_POST['otp'];

                    if (!isset($_SESSION['otp']) || !isset($_SESSION['otp_email'])) {
                        $_SESSION['tb_otp_error'] = "Quá thời gian xác nhận. Vui lòng thử lại!";
                        header('location: index.php?pg=otp');
                        exit();
                    }
            
                    if ($otp_input == $_SESSION['otp']) {
                        
                        header('location: index.php?pg=doimatkhau');
                        exit();
                    } else {
                        $_SESSION['tb_otp_error'] = "Mã OTP không đúng. Vui lòng thử lại!";
                        header('location: index.php?pg=otp');
                        exit();
                    }
                }
                break;
            // 25. Chức năng đổi mật khẩu admin
            case 'resetpassword':
                if (isset($_POST["reset_password"]) && $_POST["reset_password"]) {
                    $password = $_POST['password'];
            
                    // Kiểm tra mật khẩu đủ mạnh chưa
                    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                        $_SESSION['tb_invalid_change_password'] = "Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
                        header('location: index.php?pg=doimatkhau');
                        exit();
                    }
            
                    // Kiểm tra email đã xác minh OTP có tồn tại không
                    if (!isset($_SESSION['otp_email']) || empty($_SESSION['otp_email'])) {
                        $_SESSION['tb_invalid_change_password'] = "Không tìm thấy tài khoản để đổi mật khẩu.";
                        header('location: index.php?pg=doimatkhau');
                        exit();
                    }
            
                    $email = $_SESSION['otp_email'];
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Gọi hàm cập nhật và xử lý kết quả
                    if (update_password_by_email($hashed_password, $email)) {
                        unset($_SESSION['otp']);
                        unset($_SESSION['otp_email']);
                        $_SESSION['tb_success_reset'] = "Đổi mật khẩu thành công. Vui lòng đăng nhập lại.";
                        header('location: index.php?pg=doimatkhau');
                        exit();
                    } else {
                        $_SESSION['tb_invalid_change_password'] = "Đổi mật khẩu thất bại. Vui lòng thử lại.";
                        header('location: index.php?pg=doimatkhau');
                        exit();
                    }
                }
                break;
            
            
            // 26. Chức năng cập nhật thông tin admin
            case 'user_update':
                if (isset($_POST["capnhat"])) {
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $address = $_POST["address"];
                    $id = $_POST["id"];
                    // Check Phone
                    // 1. Check số lượng của số lẫn chữ
                    if (!preg_match('/^\d{10}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Số điện thoại phải có đúng 10 chữ số!";
                        header('location: index.php?pg=setting');
                        exit();
                    }
                    // 2. Check bắt đầu bằng số 0
                    if (!preg_match('/^0\d{9}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0!";
                        header('location: index.php?pg=setting');
                        exit();
                    }
                    // 3. Check đúng định dạng số điện thoại Việt Nam
                    if (!preg_match('/^(03[2-9]|05[6|8|9]|07[0|6-9]|08[1-9]|09[0-9])\d{7}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Hãy nhập đúng định dạng số di động Việt Nam!";
                        header('location: index.php?pg=setting');
                        exit();
                    }
                    // 4. Check phone đã tồn tại hay chưa?
                    if (check_phone_exists($phone, $id)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại đã được đăng ký!";
                        header('location: index.php?pg=setting'); 
                        exit();
                    }

                    // Check email
                    // 1. Check phần tên người dùng trước @
                    if (!preg_match('/^[\w\.\-]+/', $email)) {
                        $_SESSION['tb_email_update'] = "Tên email không hợp lệ. Chỉ được dùng chữ, số, dấu chấm (.) hoặc gạch ngang (-, _).";
                        header('location: index.php?pg=setting');
                        exit();
                    }

                    // 2. Check có chứa ký tự @ không
                    if (strpos($email, '@') === false) {
                        $_SESSION['tb_email_update'] = "Email phải chứa ký tự @.";
                        header('location: index.php?pg=setting');
                        exit();
                    }

                    // 3. Check có tên miền sau @ không (ví dụ: gmail, yahoo...)
                    $parts = explode('@', $email);
                    if (!isset($parts[1]) || !preg_match('/^[\w\-]+(\.[\w\-]+)*$/', $parts[1])) {
                        $_SESSION['tb_email_update'] = "Thiếu hoặc sai tên miền.";
                        header('location: index.php?pg=setting');
                        exit();
                    }

                    // 4. Check có đuôi miền (như .com, .vn) không
                    if (!preg_match('/\.[a-zA-Z]{2,}$/', $email)) {
                        $_SESSION['tb_email_update'] = "Thiếu đuôi miền (.com, .vn, ...).";
                        header('location: index.php?pg=setting');
                        exit();
                    }
                    // 5. Check tồn tại email
                    if (check_email_exists($email, $id)) {
                        $_SESSION['tb_email_update'] = "Email đã được đăng ký!";
                        header('location: index.php?pg=setting'); 
                        exit();
                    }

                    update_user($name, $phone, $email, $address, $id);

                    // Cập nhật lại $_SESSION['s_user'] nếu cần
                    $_SESSION['admin_account']['name'] = $name;
                    $_SESSION['admin_account']['phone'] = $phone;
                    $_SESSION['admin_account']['email'] = $email;
                    $_SESSION['admin_account']['address'] = $address;

                    $_SESSION['tb_update_thanhcong'] = "Cập Nhật Thông Tin Thành Công!";
                    header("Location: index.php?pg=setting");
                    exit(); 
                }
                break;
            
            
            
            
            
            
            
            
            
    
            // Mặc định quay về trang home
            default:
                include "view/home.php"; 
                break;
        }
    }else{
        if(!isset($_SESSION["admin_account"])){
            header("Location: index.php?pg=login_admin"); 
            exit();
        }
        include "view/home.php"; 
    }

    if (!$no_header_footer) {
        include "view/footer.php";
    }

    ob_end_flush();
?>