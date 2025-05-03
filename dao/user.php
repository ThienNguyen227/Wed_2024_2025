<?php
require_once 'pdo.php';

// ----------- ADMIN ------------------

// 1. Hàm lấy ra danh sách khách hàng
function get_all_list_user(){
    $sql = "SELECT * FROM user ORDER BY created_at DESC";
    return pdo_query($sql);
}

// 2. 
function user_search_by_keyword($keyword) {
    $searchTerm = "%$keyword%";
    $sql = "SELECT * FROM user WHERE name LIKE ? OR phone LIKE ? OR email LIKE ?";
    return pdo_query($sql, $searchTerm, $searchTerm, $searchTerm);
}




















// ----------- USER ------------------
// Đăng kí
function user_insert($name, $phone, $email, $password){
    $sql = "INSERT INTO user(name, phone, email, password) VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $name, $phone, $email, $password);
}

function check_phone_email_exists($phone, $email){
    $sql = "SELECT * FROM user WHERE phone = ? and email = ?";
    $result = pdo_query_one($sql, $phone, $email);
    return $result ? true : false;
}

// Check số điện thoại và email dùng khi update thông tin
function check_phone_exists($phone, $id) 
{
    $sql = "SELECT * FROM user WHERE phone = ? AND id != ?";
    $result = pdo_query_one($sql, $phone, $id);
    return $result ? true : false;
}

function check_email_exists($email, $id) {
    $sql = "SELECT * FROM user WHERE email = ? AND id != ?";
    $result = pdo_query_one($sql, $email, $id);
    return $result ? true : false;
}

// Dùng khi đăng kí tài khoản vì lúc này chưa có id của user
function check_phone_exists_without_id($phone) 
{
    $sql = "SELECT phone FROM user WHERE phone = ?";
    $result = pdo_query_one($sql, $phone);
    return $result ? true : false;
}

function check_email_exists_without_id($email) 
{
    $sql = "SELECT email FROM user WHERE email = ?";
    $result = pdo_query_one($sql, $email);
    return $result ? true : false;
}

// 
function check_password_login($phone,$password){
    $sql = "SELECT * FROM user WHERE phone=? and password !=?";
    $result = pdo_query_one($sql, $phone, $password);
    return $result ? true : false;
}

function check_valid_login_user($phone, $password){
    $sql = "SELECT * FROM user WHERE phone = ? and password = ?";
    return pdo_query_one($sql, $phone, $password);
}


function get_user_by_phone($phone){
    $sql = "SELECT * FROM user WHERE phone = ?";
    return pdo_query_one($sql, $phone);
}

// Cập nhật thông tin của user
function update_user($name, $phone, $email, $address, $id){
    $sql = "UPDATE user SET name=?, phone=?, email=?, address=? WHERE id=?";
    pdo_execute($sql, $name, $phone, $email, $address, $id);
}
// Cập nhật password
function update_password_by_email($password, $email){
    $sql = "UPDATE user SET password=? WHERE email=?";
    try {
        pdo_execute($sql, $password, $email);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function get_last_bill_id() {
    $sql = "SELECT MAX(bill_id) FROM bill";
    return pdo_query_value($sql); // giả sử em có hàm pdo_query_value trả về 1 giá trị
}

// insert info_bill
function insert_info_bill_with_code($id_user, $name, $phone, $email, $address, $paymentmethod, $code){
    $sql = "INSERT INTO bill(user_id, receiver_name, receiver_phone, receiver_email, receiver_address, payment_method, discount_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $id_user, $name, $phone, $email, $address, $paymentmethod, $code);
}

function insert_info_bill_without_code($id_user, $name, $phone, $email, $address, $paymentmethod){
    $sql = "INSERT INTO bill(user_id, receiver_name, receiver_phone, receiver_email, receiver_address, payment_method) VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $id_user, $name, $phone, $email, $address, $paymentmethod);
    
}

// insert info_bill_detail
function insert_info_bill_detail($bill_id, $id, $quantity, $price, $unit_total, $total){
    $sql = "INSERT INTO bill_detail(bill_id, product_id, quantity, unit_price, unit_total_price, total_price) VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $bill_id, $id, $quantity, $price, $unit_total, $total);
}

// Lấy ra thông tin chi tiết sản phẩm theo bill_id
function get_info_bill_detail($bill_id){
    $sql = "SELECT * FROM bill_detail WHERE bill_id = ?";
    return pdo_query_one($sql, $bill_id);
}

// Lấy ra thông tin sản phẩm theo bill_id
function get_info_bill($bill_id){
    $sql = "SELECT * FROM bill WHERE bill_id = ?";
    return pdo_query_one($sql, $bill_id);
}

// Lấy ra bill_id theo user_id
function get_bill_id_form_user_id($user_id){
    $sql = "SELECT * FROM bill WHERE user_id = ?";
    return pdo_query_one($sql, $user_id);
}


function getBillsByUserId($user_id) {
    $sql = "SELECT * FROM bill WHERE user_id = ? ORDER BY created_at DESC";
    return pdo_query($sql, $user_id);
}


function getProductsByBillId($bill_id) {
    $sql = "SELECT * 
            FROM bill_detail bd 
            JOIN product p ON bd.product_id = p.id
            JOIN bill b ON b.bill_id = bd.bill_id
            WHERE bd.bill_id = ?";
    return pdo_query($sql, $bill_id);
}
// Hàm hủy đơn hàng
function cancelOrder($bill_id) {
    $sql = "UPDATE bill SET status = 4 WHERE bill_id = ? AND status = 0";
    pdo_execute($sql, $bill_id);
}

function check_total_bill($bill_id, $total_price){
    $sql = "SELECT b.bill_id, bd.total_price
            FROM bill b
            JOIN bill_detail bd ON bd.bill_id = b.bill_id

            WHERE b.bill_id=? AND bd.total_price=?";
    $result = pdo_query_one($sql, $bill_id, $total_price);
    return $result ? true : false;
}

// Cập nhật trạng thái "đã thanh toán" đơn hàng
function update_payment_status_bill($bill_id){
    $sql = "UPDATE bill SET payment_status = 1 WHERE bill_id = ?";
    pdo_execute($sql, $bill_id);
}

// Cập nhật trạng thái "đã xác nhận" của đơn hàng
function update_status_bill_confirmed($bill_id){
    $sql = "UPDATE bill SET status = 1 WHERE bill_id = ?";
    pdo_execute($sql, $bill_id);
}






















// function khach_hang_update($ma_kh, $mat_khau, $ho_ten, $email, $hinh, $kich_hoat, $vai_tro){
//     $sql = "UPDATE khach_hang SET mat_khau=?,ho_ten=?,email=?,hinh=?,kich_hoat=?,vai_tro=? WHERE ma_kh=?";
//     pdo_execute($sql, $mat_khau, $ho_ten, $email, $hinh, $kich_hoat==1, $vai_tro==1, $ma_kh);
// }

// function khach_hang_delete($ma_kh){
//     $sql = "DELETE FROM khach_hang  WHERE ma_kh=?";
//     if(is_array($ma_kh)){
//         foreach ($ma_kh as $ma) {
//             pdo_execute($sql, $ma);
//         }
//     }
//     else{
//         pdo_execute($sql, $ma_kh);
//     }
// }

// function khach_hang_select_all(){
//     $sql = "SELECT * FROM khach_hang";
//     return pdo_query($sql);
// }

// function khach_hang_select_by_id($ma_kh){
//     $sql = "SELECT * FROM khach_hang WHERE ma_kh=?";
//     return pdo_query_one($sql, $ma_kh);
// }

// function khach_hang_exist($ma_kh){
//     $sql = "SELECT count(*) FROM khach_hang WHERE $ma_kh=?";
//     return pdo_query_value($sql, $ma_kh) > 0;
// }

// function khach_hang_select_by_role($vai_tro){
//     $sql = "SELECT * FROM khach_hang WHERE vai_tro=?";
//     return pdo_query($sql, $vai_tro);
// }

// function khach_hang_change_password($ma_kh, $mat_khau_moi){
//     $sql = "UPDATE khach_hang SET mat_khau=? WHERE ma_kh=?";
//     pdo_execute($sql, $mat_khau_moi, $ma_kh);
// }