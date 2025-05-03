<?php
    session_start();
    ob_start();

    // Nhúng kết nối 
    include "dao/pdo.php";
    include "dao/user.php";
    include "dao/product.php";
    include "dao/categories.php";
    include "dao/comment.php";
    include "dao/global.php";

    // Phần gửi Otp qua email để xác thực
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    
    // Nếu là trang đăng kí, đăng nhập, quên mật khẩu, otp, đổi mật khẩu thì không include header và footer vào
    $no_header_footer = isset($_GET['pg']) && in_array($_GET['pg'], ['dangky', 'dangnhap', 'quenmatkhau', 'otp', 'doimatkhau']);

    if (!$no_header_footer) {
        include "view/header.php";
    }

    // Sản phẩm bestseller
    $list_product_bestseller = get_list_product_bestseller(2); // Cần fix
    // Sản phẩm mới
    $list_product_new = get_list_product_new(4); // Cần fix


    if (!isset($_GET['pg'])) {
        include "view/body.php";
    } 
    else 
    {
        switch ($_GET['pg']) 
        {
            // Trang menu
            case 'menu':
                // Danh mục menu
                $categories = categories_all();
                if(!isset($_GET['product_categories_id'])){
                    $product_categories_id = 0;
                } else {
                    $product_categories_id = $_GET['product_categories_id'];
                }
                // Chức năng tìm kiếm sản phẩm
                if(isset($_POST["timkiem"])){
                    $kyw = $_POST["kyw"];
                }else{
                    $kyw = "";
                }
                $list_product = get_list_product($kyw, $product_categories_id, 36);
                include "view/menu.php";
                break;
            // Trang sản phẩm đóng gói
            case 'spdg':
                $packed_products = get_packed_products(4);
                include "view/spdg.php";
                break;
            //Trang giới thiệu công ty
            case 'gioithieucongty':
                include "view/gioithieucongty.php";
                break;
            // Trang liên hệ
            case 'lienhe':
                include "view/lienhe.php";
                break;
            // Trang tuyển dụng
            case 'tuyendung':
                include "view/tuyendung.php";
                break;
            // Trang khuyến mãi
            case 'khuyenmai':
                include "view/khuyenmai.php";
                break;

            // Trang xem giỏ hàng
            case 'viewshoppingcart':
                if(!isset($_SESSION["s_user"])){
                    header("Location: index.php?pg=dangnhap"); 
                    exit();
                }
                include "view/viewshoppingcart.php";
                break;

            // Trang đăng nhập
            case 'dangnhap':
                include "view/dangnhap.php";
                break;

            // Trang đăng Ký
            case 'dangky':
                include "view/dangky.php";
                break;
            
            // Trang quên mật Khẩu
            case 'quenmatkhau':
                include "view/quenmatkhau.php";
                break;
            // Trang đổi mật Khẩu
            case 'doimatkhau';
                include "view/doimatkhau.php";
                break;

            // Trang Otp
            case 'otp':
                include "view/otp.php";
                break;

            // 1. Chức năng đăng xuất
            case 'logout':
                if(isset($_SESSION['s_user']) && count($_SESSION['s_user']) >0){
                    unset($_SESSION['s_user']);
                }
                header('location: index.php');
                break;
            
            // 2. Chức năng đăng kí tài khoản
            case 'adduser':
                if (isset($_POST["dangky"]) && ($_POST["dangky"])) {
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    // Check Name
                    // \p{L}: a-z A-Z có dấu, \s: space, 
                    if (!preg_match('/^[\p{L}\s]{1,10}$/u', $name)) {
                        $_SESSION['tb_invalid_name'] = "Tên chỉ được chứa chữ cái, khoảng trắng và tối đa 10 ký tự!";
                        header('location: index.php?pg=dangky');
                        exit();
                    }
                
                    // Check Phone
                    // 1. Check số lượng của số lẫn chữ
                    if (!preg_match('/^\d{10}$/', $phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại không hợp lệ. Số điện thoại phải có đúng 10 chữ số!";
                        header('location: index.php?pg=dangky');
                        exit();
                    }
                    // 2. Check bắt đầu bằng số 0
                    if (!preg_match('/^0\d{9}$/', $phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0!";
                        header('location: index.php?pg=dangky');
                        exit();
                    }
                    // 3. Check đúng định dạng số điện thoại Việt Nam
                    if (!preg_match('/^(03[2-9]|05[6|8|9]|07[0|6-9]|08[1-9]|09[0-9])\d{7}$/', $phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại không hợp lệ. Hãy nhập đúng định dạng số di động Việt Nam!";
                        header('location: index.php?pg=dangky');
                        exit();
                    }
                    // 4. Check phone đã tồn tại hay chưa?
                    if (check_phone_exists_without_id($phone)) {
                        $_SESSION['tb_invalid_phone'] = "Số điện thoại đã được đăng ký!";
                        header('location: index.php?pg=dangky'); 
                        exit();
                    }

                    
                    // Check email
                    // 1. Check phần tên người dùng trước @
                    if (!preg_match('/^[\w\.\-]+/', $email)) {
                        $_SESSION['tb_invalid_email'] = "Tên email không hợp lệ. Chỉ được dùng chữ, số, dấu chấm (.) hoặc gạch ngang (-, _).";
                        header('location: index.php?pg=dangky');
                        exit();
                    }

                    // 2. Check có chứa ký tự @ không
                    if (strpos($email, '@') === false) {
                        $_SESSION['tb_invalid_email'] = "Email phải chứa ký tự @.";
                        header('location: index.php?pg=dangky');
                        exit();
                    }

                    // 3. Check có tên miền sau @ không (ví dụ: gmail, yahoo...)
                    $parts = explode('@', $email);
                    if (!isset($parts[1]) || !preg_match('/^[\w\-]+(\.[\w\-]+)*$/', $parts[1])) {
                        $_SESSION['tb_invalid_email'] = "Thiếu hoặc sai tên miền.";
                        header('location: index.php?pg=dangky');
                        exit();
                    }

                    // 4. Check có đuôi miền (như .com, .vn) không
                    if (!preg_match('/\.[a-zA-Z]{2,}$/', $email)) {
                        $_SESSION['tb_invalid_email'] = "Thiếu đuôi miền (.com, .vn, ...).";
                        header('location: index.php?pg=dangky');
                        exit();
                    }
                    // 5. Check tồn tại email
                    if (check_email_exists_without_id($email) ) {
                        $_SESSION['tb_invalid_email'] = "Email đã được đăng ký!";
                        header('location: index.php?pg=dangky'); 
                        exit();
                    }


                    // Check password 
                    // ít nhất 1 chữ thường, 1 chữ hoa, 1 số, 1 kí tự đặc biệt, it nhất 8 kí tự
                    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                        $_SESSION['tb_invalid_password'] = "Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
                        header('location: index.php?pg=dangky');
                        exit();
                    }

                    if(preg_match('/[àáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựỳýỷỹỵ]/i', $password)){
                        $_SESSION['tb_invalid_password'] = "Mật khẩu không được chứa kí tự Tiếng Việt!";
                        header('location: index.php?pg=dangky');
                        exit();
                    }
            
                    // Mã hóa mật khẩu trước khi đưa vào DB
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
                    user_insert($name, $phone, $email, $hashed_password);
                    header('location: index.php?pg=dangnhap');
                    exit();   
                }
                break;
            // 3. Chức năng đăng Nhập
            case 'login':
                if (isset($_POST["dangnhap"]) && ($_POST["dangnhap"])) {
                    $phone = $_POST["phone"];
                    $password = $_POST["password"];
                    
                    if(!check_phone_exists_without_id($phone)){
                        $_SESSION['tb_wrong_account'] = "Tài khoản không tồn tại! Vui lòng đăng ký hoặc đăng nhập lại!";
                        header('location: index.php?pg=dangnhap');
                        exit();  
                    }

                    // Lấy thông tin người dùng theo phone
                    $user = get_user_by_phone($phone);

                    if (!$user || !password_verify($password, $user['password'])) {
                        $_SESSION['tb_wrong_password'] = "Mật khẩu không chính xác! Vui lòng nhập lại.";
                        header('location: index.php?pg=dangnhap');
                        exit();  
                    }
                    
                    $_SESSION['s_user'] = $user;
                    header('location: index.php');
                    exit();
                }   
                break;
            // 4. Chức năng quên mật Khẩu
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
                    // if (!check_email_exists($email)) {
                    //     $_SESSION['tb_email_exists_1'] = "Email không tồn tại!";
                    //     header('location: index.php?pg=quenmatkhau'); 
                    //     exit();
                    // }
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
            // 5. Chức năng xác nhận otp
            case 'confirmotp':
                if(isset($_POST["confirm_otp"]) && ($_POST["confirm_otp"])){
                    $otp_input = $_POST['otp'];

                    if (!isset($_SESSION['otp']) || !isset($_SESSION['otp_email'])) {
                        $_SESSION['tb_otp_error'] = "Quá thời gian xác nhận. Vui lòng thử lại!";
                        header('location: index.php?pg=otp');
                        exit();
                    }
            
                    if ($otp_input == $_SESSION['otp']) {
                        // $_SESSION['otp_verified'] = true; // Có thể dùng để kiểm soát truy cập trang đổi mật khẩu
                        header('location: index.php?pg=doimatkhau');
                        exit();
                    } else {
                        $_SESSION['tb_otp_error'] = "Mã OTP không đúng. Vui lòng thử lại!";
                        header('location: index.php?pg=otp');
                        exit();
                    }
                }
                break;
            
            // 6. Chức năng update password
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
            
            // Trang thông tin cá nhân
            case 'user_account':
                if(isset($_SESSION['s_user']) && count($_SESSION['s_user']) >0 ){
                    include "view/info_user.php";
                } 
                break;
            // 7. Chức năng cập nhật thông tin
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
                        header('location: index.php?pg=user_account');
                        exit();
                    }
                    // 2. Check bắt đầu bằng số 0
                    if (!preg_match('/^0\d{9}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0!";
                        header('location: index.php?pg=user_account');
                        exit();
                    }
                    // 3. Check đúng định dạng số điện thoại Việt Nam
                    if (!preg_match('/^(03[2-9]|05[6|8|9]|07[0|6-9]|08[1-9]|09[0-9])\d{7}$/', $phone)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại không hợp lệ. Hãy nhập đúng định dạng số di động Việt Nam!";
                        header('location: index.php?pg=user_account');
                        exit();
                    }
                    // 4. Check phone đã tồn tại hay chưa?
                    if (check_phone_exists($phone, $id)) {
                        $_SESSION['tb_phone_update'] = "Số điện thoại đã được đăng ký!";
                        header('location: index.php?pg=user_account'); 
                        exit();
                    }

                    // Check email
                    // 1. Check phần tên người dùng trước @
                    if (!preg_match('/^[\w\.\-]+/', $email)) {
                        $_SESSION['tb_email_update'] = "Tên email không hợp lệ. Chỉ được dùng chữ, số, dấu chấm (.) hoặc gạch ngang (-, _).";
                        header('location: index.php?pg=user_account');
                        exit();
                    }

                    // 2. Check có chứa ký tự @ không
                    if (strpos($email, '@') === false) {
                        $_SESSION['tb_email_update'] = "Email phải chứa ký tự @.";
                        header('location: index.php?pg=user_account');
                        exit();
                    }

                    // 3. Check có tên miền sau @ không (ví dụ: gmail, yahoo...)
                    $parts = explode('@', $email);
                    if (!isset($parts[1]) || !preg_match('/^[\w\-]+(\.[\w\-]+)*$/', $parts[1])) {
                        $_SESSION['tb_email_update'] = "Thiếu hoặc sai tên miền.";
                        header('location: index.php?pg=user_account');
                        exit();
                    }

                    // 4. Check có đuôi miền (như .com, .vn) không
                    if (!preg_match('/\.[a-zA-Z]{2,}$/', $email)) {
                        $_SESSION['tb_email_update'] = "Thiếu đuôi miền (.com, .vn, ...).";
                        header('location: index.php?pg=user_account');
                        exit();
                    }
                    // 5. Check tồn tại email
                    if (check_email_exists($email, $id)) {
                        $_SESSION['tb_email_update'] = "Email đã được đăng ký!";
                        header('location: index.php?pg=user_account'); 
                        exit();
                    }

                    update_user($name, $phone, $email, $address, $id);

                    // Cập nhật lại $_SESSION['s_user'] nếu cần
                    $_SESSION['s_user']['name'] = $name;
                    $_SESSION['s_user']['phone'] = $phone;
                    $_SESSION['s_user']['email'] = $email;
                    $_SESSION['s_user']['address'] = $address;

                    $_SESSION['tb_update_thanhcong'] = "Cập Nhật Thông Tin Thành Công!";
                    header("Location: index.php?pg=user_account");
                    exit(); 
                }
                break;
            
            // Trang sản phẩm chi tiết
            case 'product_detail':
                $categories = categories_all();
                if(isset($_GET['id_product']))
                {
                    $id = $_GET['id_product'];
                    $detail_product = get_detail_product_by_id($id);
                    $category_id = $detail_product['product_category_id'];
                    $relative_product = get_list_relative_product($category_id, $id, 4);

                    $comments = get_comment_by_id_product($id);


                    include "view/product_detail.php";
                }
                break;
            
            
            // 8. Chức năng thêm sản phẩm vào giỏ hàng
            case 'addtocart':
                if(!isset($_SESSION["s_user"])){
                    header("Location: index.php?pg=dangnhap"); 
                    exit();
                }

                // Lấy ID người dùng 
                $userId = $_SESSION['s_user']['id'];

                if (isset($_POST["press-add"])) {
                    $name = $_POST["name"];
                    $img = $_POST["img"];
                    $price = $_POST["price"];
                    $soluong = $_POST["soluong"];
                    $id = $_SESSION["id_pro"];
                    // Kiểm tra số lượng nhập vào của sản phẩm
                    if(!preg_match('/^0?[1-9]$|^0?[1-9]\d$/', $soluong)){
                        $_SESSION['tb_invalid_quantity'] = "Quý khách vui lòng chọn số lượng từ 1 đến 99!";
                        header('location: index.php?pg=product_detail&id_product='.$id);
                        exit();
                    }

                    $product = ['id' => $id, 'name' => $name, 'img' => $img, 'price' => $price, 'soluong' => $soluong];
            
                    // Tạo giỏ hàng nếu chưa có
                    if (!isset($_SESSION['cart'][$userId])) 
                    {
                        $_SESSION['cart'][$userId] = [];
                    }
            
                    $found = false;
            
                    // Duyệt giỏ hàng xem sản phẩm đã có chưa, có rồi thì tằng số lượng sản phẩm lên
                    foreach ($_SESSION['cart'][$userId] as $key => $item) 
                    {
                        if ($item['id'] == $id) {
                            $_SESSION['cart'][$userId][$key]['soluong'] += $soluong;
                            $found = true;
                            break;
                        }
                    }
            
                    // Nếu chưa có thì thêm mới
                    if (!$found) 
                    {
                        $_SESSION['cart'][$userId][] = $product;
                    }
            
                    header("Location: index.php?pg=viewshoppingcart"); 
                    exit();
                }
                break;
            // 9. Chức năng xóa sản phẩm trong giỏ hàng
            case 'removecart':
                if(isset($_POST["remove_cart"]))
                {

                    $key = $_POST["key"];
                    if(isset($_SESSION['cart'][$_SESSION['s_user']['id']][$key]))
                    {
                        unset($_SESSION['cart'][$_SESSION['s_user']['id']][$key]);
                    }
                    header("Location: index.php?pg=viewshoppingcart"); 
                    exit();
                }
                break;
            
            // 10. Chức năng chỉnh sửa số lượng sản phẩm
            case 'updatecart':
                if(isset($_POST["update_cart"]))
                {   
                    $key =  $_POST["key"];
                    $new_soluong = intval($_POST["soluong"]);

                    if(isset($_SESSION['s_user'])){
                        $userId = $_SESSION['s_user']['id'];
                        if($new_soluong>0){
                            $_SESSION['cart'][$userId][$key]['soluong'] = $new_soluong;
                            header("Location: index.php?pg=viewshoppingcart"); 
                            exit();
                        }
                    }
                }
                break;
            // 11. Chức năng đặt hàng
            case 'addtoorder':
                if(isset($_POST["order"])){
                    // Bill
                    $id_user = $_POST["id_self"];
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $address = $_POST["address"];
                    $paymentmethod = $_POST["payment_method"];
                    $code = isset($_POST["code"]) && $_POST["code"] !== '' ? $_POST["code"] : null;
                    
                    if ($code !== null) 
                    {
                        insert_info_bill_with_code($id_user, $name, $phone, $email, $address, $paymentmethod, $code);
                    } else {
                        insert_info_bill_without_code($id_user, $name, $phone, $email, $address, $paymentmethod);
                    }

                    $bill_id = get_last_bill_id();
                    // Bill_detail
                    $product_id =  $_POST["product_id"];
                    $product_quantity =  $_POST["product_quantity"];
                    $product_price =  $_POST["product_price"];
                    $product_total_unit =  $_POST["total_unit"];
                    $total = $_POST["total"];

                    for ($i = 0; $i < count($product_id)-1; $i++) {
                        $id = $product_id[$i];
                        $quantity = $product_quantity[$i];
                        $price = $product_price[$i];
                        $unit_total = $product_total_unit[$i];
                        var_dump($bill_id, $id, $quantity, $price, $unit_total, $total);
                        insert_info_bill_detail($bill_id, $id, $quantity, $price, $unit_total, $total);
                    }
                    unset($_SESSION['cart']);
                    header("Location: index.php?pg=order"); 
                    exit();

                }

                break;






            // Trang bill(hóa đơn)
            case 'order':
                if(!isset($_SESSION["s_user"])){
                    header("Location: index.php?pg=dangnhap"); 
                    exit();
                }
                include "view/order.php";
                break;

            // 12. Chức năng hủy đơn hàng khi đã đặt hàng
            case 'cancel_order':
                if(isset($_POST["huy"])){
                    $bill_id = $_POST['bill_id'];
    
                    cancelOrder($bill_id);
                    
                    
                    header("Location: index.php?pg=order");
                    exit();
                }
                break;

            // 13. Chức năng bình luận
            case 'comment_submit':
                if(!isset($_SESSION["s_user"])){
                    header("Location: index.php?pg=dangnhap"); 
                    exit();
                }

                if(isset($_POST["comment"])){
                    $id_user = $_POST['id_user'];
                    $id_product = $_POST['id_product'];
                    $content = $_POST['content'];

                    insert_comment($id_user, $id_product, $content);

                    header("Location: index.php?pg=product_detail&id_product=".$id_product); 
                    exit();

                }
                break;
            // 14. Chức năng xóa bình luận
            case 'remove_comment':
                if(isset($_POST["removecomment"])){
                    $id_comment = $_POST['id_comment'];
                    $id_product = $_POST['id_product'];
                    // var_dump($id_comment, $id_product);
                    remove_comment_by_id_comment($id_comment);
                    header("Location: index.php?pg=product_detail&id_product=".$id_product); 
                    exit();
                }
                break;
            // 15. Chức năng chỉnh sửa bình luận
            case 'update_comment':
                if(isset($_POST["updatecomment"])){
                    $id_comment = $_POST['id_comment'];
                    $id_product = $_POST['id_product'];
                    $content = $_POST['content'];

                    update_comment_by_id_comment($content, $id_comment);
                    header("Location: index.php?pg=product_detail&id_product=".$id_product); 
                    exit();
                }
                break;

            // 16. Trang sản phẩm yêu thích
            case 'favorite_product':
                if(!isset($_SESSION["s_user"])){
                    header("Location: index.php?pg=dangnhap"); 
                    exit();
                }
                $user_id = $_SESSION["s_user"]['id'];
                $favorites_pro = get_favorite_by_user_id_and_product_id($user_id);
                include "view/favorite_product.php";
                break;
            // 17. Chức năng add mã giảm giá
            case 'add_voucher':
                if(!isset($_SESSION["s_user"])){
                    header("Location: index.php?pg=dangnhap"); 
                    exit();
                }

                if (isset($_POST["voucher_add"])) {
                    $code = $_POST["code"];
                    
                    if(!check_voucher($code)){
                        $_SESSION['tb_invalid_code'] = "Mã giảm giá không chính xác!";
                        $_SESSION['show_modal'] = true;
                        header('location: index.php?pg=viewshoppingcart');
                        exit();
                    }

                    if(!check_voucher_time($code)){
                        $_SESSION['tb_invalid_code'] = "Mã giảm giá đã hết hạn!";
                        $_SESSION['show_modal'] = true;
                        header('location: index.php?pg=viewshoppingcart');
                        exit();
                    }

                    $_SESSION['voucher'] = get_voucher($code);
                    
                    header('location: index.php?pg=viewshoppingcart');
                    exit();

                }
                break;
            // 18. Chức năng thanh toán bằng ví MOMO tài khoản test
            case 'payment':
                // Hàm gửi yêu cầu POST đến API MoMo
                function execPostRequest($url, $data)
                {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    ));
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    
                    $result = curl_exec($ch);
                    curl_close($ch);
                    return $result;
                }

                if (isset($_POST['total_price']) && isset($_POST['bill_id'])) {
                    // Thông tin cấu hình từ MoMo
                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                    $partnerCode = 'MOMOBKUN20180529';
                    $accessKey = 'klm05TvNBzhg7h7j';
                    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

                    // Dữ liệu từ form
                    $amount = $_POST["total_price"];
                    $bill_id = $_POST["bill_id"];



                    $orderInfo = "Thanh toán qua MoMo";
                    $orderId = $bill_id . "_" . time(); // Đảm bảo duy nhất
                    $redirectUrl = "http://localhost/final_project_15_4/index.php?pg=check_payment";
                    $ipnUrl = "http://localhost/final_project_15_4/index.php?pg=check_payment";
                    $extraData = "";

                    // Chuẩn bị các thông tin cần thiết
                    $requestId = time() . ""; // Mỗi lần tạo đơn hàng khác nhau
                    $requestType = "payWithATM";

                    // Tạo chữ ký (signature)
                    $rawHash = "accessKey=" . $accessKey
                            . "&amount=" . $amount
                            . "&extraData=" . $extraData
                            . "&ipnUrl=" . $ipnUrl
                            . "&orderId=" . $orderId
                            . "&orderInfo=" . $orderInfo
                            . "&partnerCode=" . $partnerCode
                            . "&redirectUrl=" . $redirectUrl
                            . "&requestId=" . $requestId
                            . "&requestType=" . $requestType;

                    $signature = hash_hmac("sha256", $rawHash, $secretKey);

                    // Dữ liệu gửi đến MoMo
                    $data = array(
                        'partnerCode' => $partnerCode,
                        'partnerName' => "Test",
                        'storeId' => "MomoTestStore",
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature
                    );

                    // Gửi yêu cầu đến API MoMo
                    $result = execPostRequest($endpoint, json_encode($data));
                    $jsonResult = json_decode($result, true); // Kết quả trả về từ MoMo

                    // Kiểm tra và chuyển hướng nếu có payUrl
                    if (isset($jsonResult['payUrl'])) {
                        header('Location: ' . $jsonResult['payUrl']);
                        exit();
                    } else {
                        echo "Không thể tạo link thanh toán. Thông tin lỗi:<br>";
                        echo '<pre>';
                        print_r($jsonResult);
                        echo '</pre>';
                        exit();
                    }
                }
         
                break;
            // 18. Chức năng thanh toán bằng ví MOMO tài khoản test
            case 'check_payment';

                if (isset($_GET['resultCode']) && isset($_GET['orderId'])) {
                    $resultCode = $_GET['resultCode'];
                    $orderIdFull = $_GET['orderId']; // VD: 107_1710000123
            
                    // Tách lấy bill_id từ orderId
                    $bill_id = explode("_", $orderIdFull)[0];
                    
                    if ($resultCode == 0) {
                        update_payment_status_bill($bill_id);
                        update_status_bill_confirmed($bill_id);
                        
                        header("Location: index.php?pg=order");
                        exit();
                    }
                }
                break;




                



            // Mặc định trả về trang chủ
            default:
                include "view/body.php";
                break;
        }
        
    }

    if (!$no_header_footer) {
        include "view/footer.php";
    }

    ob_end_flush();
?>
