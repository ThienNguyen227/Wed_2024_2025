<?php
require_once 'pdo.php';

// -------- ADMIN --------

// Hàm ẩn sản phầm
function ad_update_product_status_hidden($id_pro){
    $sql = "UPDATE product SET product_status=1 WHERE id=?";
    pdo_execute($sql, $id_pro);
}

// Hàm hiện sản phầm
function ad_update_product_status_show($id_pro){
    $sql = "UPDATE product SET product_status=0 WHERE id=?";
    pdo_execute($sql, $id_pro);
}

// Hàm thêm bestseller
function ad_update_product_bestseller($id_pro){
    $sql = "UPDATE product SET bestseller=1 WHERE id=?";
    pdo_execute($sql, $id_pro);
}

// Hàm gỡ bestseller
function ad_update_product_cancel_bestseller($id_pro){
    $sql = "UPDATE product SET bestseller=0 WHERE id=?";
    pdo_execute($sql, $id_pro);
}


// 1. Hàm lấy ra danh sách sản phẩm admin
function get_list_product_admin($limit_product)
{
    $sql = "SELECT * FROM product ORDER BY id DESC LIMIT ".$limit_product;
    return pdo_query($sql);
}

// 2. Hàm thêm sản phẩm admin
function add_product($img, $name, $categories, $price, $description){
    $sql = "INSERT INTO product(img, name, product_category_id, price, description) VALUES (?,?,?,?,?)";
    pdo_execute($sql, $img, $name, $categories, $price, $description);
}

// 2. Hàm thêm sản phẩm đóng gói
function add_packed_product($img, $name, $price, $product_quantity, $categories, $description){
    $sql = "INSERT INTO product(img, name, price, product_quantity, product_category_id, description) VALUES (?,?,?,?,?,?)";
    pdo_execute($sql, $img, $name, $price, $product_quantity, $categories, $description);
}

// 2. Hàm thêm tin tức đóng gói
function add_news($img, $name, $price, $product_quantity, $categories, $description){
    $sql = "INSERT INTO (img, name, price, product_quantity, product_category_id, description) VALUES (?,?,?,?,?,?)";
    pdo_execute($sql, $img, $name, $price, $product_quantity, $categories, $description);
}

// 3. Hàm xóa sản phẩm admin
function delete_product($id_pro){
    $sql = "DELETE FROM product WHERE  id=?";
    pdo_execute($sql, $id_pro);
}

// 4. Hàm lấy hình ảnh sản phẩm
function get_img_by_id($id_pro){
    $sql = "SELECT img FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id_pro);
    return $result['img'];
}

// 5. Hàm cập nhật sản phẩm
function update_product($name, $category_id, $price, $description, $img, $id_pro){
    $sql = "UPDATE product SET name=?, product_category_id=?, price=?, description=?, img=? WHERE id=?";
    pdo_execute($sql, $name, $category_id, $price,  $description, $img, $id_pro);
}

// 5. Hàm cập nhật sản phẩm đóng gói
function update_packed_product($name, $price,  $description, $product_quantity, $img, $id_pro){
    $sql = "UPDATE product SET name=?, price=?, description=?, product_quantity=?, img=? WHERE id=?";
    pdo_execute($sql, $name, $price,  $description, $product_quantity, $img, $id_pro);
}

// 6. Hàm lấy thông tin sản phẩm qua id sản phẩm
function get_product_by_id($id_pro){
    $sql = "SELECT * FROM product WHERE id=?";
    return pdo_query_one($sql, $id_pro);
}


// 7. Hàm lấy ra tất cả đơn hàng 
function get_all_list_orders(){
    $sql = "SELECT * FROM bill ORDER BY created_at DESC";
    return pdo_query($sql);
}

// 8. Hàm lấy ra chi tiết hóa đơn thông qua bill_id
function get_detail_bill_by_bill_id($id){
    $sql = "SELECT *
            FROM bill_detail bd
            JOIN product pd ON pd.id = bd.product_id
            WHERE bd.bill_id=?";
    return pdo_query($sql, $id);
}

// 9. Hàm điều chỉnh trạng thái thanh toán, trạng thánh đơn hàng thông qua bill_id
function adjust_status($payment_status, $status, $bill_id){
    $sql = "UPDATE bill SET payment_status=?, status=? WHERE bill_id=?";
    pdo_execute($sql, $payment_status, $status, $bill_id);
}

// 10. Hàm lấy ra bill qua bill_id
function get_bill_by_bill_id($bill_id){
    $sql = "SELECT * FROM bill WHERE bill_id=?";
    return pdo_query_one($sql, $bill_id);
}

























// -------- User --------

// Hàm lấy ra danh sách sản phẩm mới
function get_list_product_new($limit_product){
    $sql = "SELECT * FROM product WHERE product_status = 0 ORDER BY id DESC LIMIT ".$limit_product;
    return pdo_query($sql);
} 

// Hàm lấy ra danh sách sản phẩm bestseller
function get_list_product_bestseller($limit_product){
    $sql = "SELECT * FROM product WHERE bestseller = 1 AND product_status = 0 ORDER BY id DESC LIMIT ".$limit_product;
    return pdo_query($sql);

}

// Hàm lấy ra danh sách sản phẩm
function get_list_product($kyw, $product_categories_id, $limit_product){
    $sql = "SELECT * FROM product WHERE 1";

    if($product_categories_id>0){
        $sql .=" AND product_category_id=".$product_categories_id;
    }
    
    if($kyw != ""){
        $sql .=" AND name like '%".$kyw."%'";
    }
    $sql .= " AND product_category_id IN (1, 2, 3, 4) AND product_status = 0";

    $sql .= " ORDER BY id DESC LIMIT ".$limit_product;
    return pdo_query($sql);
}

// Hàm lấy ra sản phẩm chi tiết thông qua id_product sản phẩm 
function get_detail_product_by_id($id){
    $sql = "SELECT * FROM product WHERE id=?";
    return pdo_query_one($sql, $id);
}

// Hàm lấy ra danh sách sản phẩm liên quan
function get_list_relative_product($category_id, $id, $limit_product){
    $sql = "SELECT * FROM product WHERE product_category_id=? AND id<>? ORDER BY id DESC LIMIT ".$limit_product;
    return pdo_query($sql, $category_id, $id);
} 

// Phần sản phẩm yêu thích
function check_favorite($user_id, $product_id){
    $sql= "SELECT * FROM favorite WHERE id_user=? AND id_product=?";
    return pdo_query_one($sql, $user_id, $product_id);
}
 
function delete_favorite($user_id, $product_id){
    $sql= "DELETE FROM favorite WHERE id_user=? AND id_product=?";
    pdo_execute($sql, $user_id, $product_id);
}

function insert_favorite($user_id, $product_id){
    $sql= "INSERT INTO favorite(id_user, id_product) VALUES(?, ?)";
    pdo_execute($sql, $user_id, $product_id);
}

function count_favorite_by_user_id($user_id){
    $sql = "SELECT COUNT(*) AS total FROM favorite WHERE id_user = ?";
    $result = pdo_query_one($sql, $user_id);
    return $result['total']; 
}

function get_favorite_by_user_id_and_product_id($user_id){
    $sql = "SELECT * 
            FROM favorite fv
            JOIN product pd ON pd.id = fv.id_product
            WHERE fv.id_user=?
            ORDER BY fv.created_at DESC";
    return pdo_query($sql, $user_id);
}

// Phần mã giảm giá khi ấn nút "ÁP DỤNG"

// 1. Kiểm tra user trong bảng customer_discount
function check_user_in_customer_discount($id_user){
    $sql = "SELECT customer_id FROM customer_discounts WHERE customer_id = ?";
    $result = pdo_query_one($sql, $id_user);
    return $result ? true : false;
}

// 2. Kiểm tra có mã giảm giá trong bảng total_discount hay không?
function check_voucher($code){
    $sql = "SELECT code FROM total_discounts WHERE code = ?";
    $result = pdo_query_one($sql, $code);
    return $result ? true : false;
}

// Lấy ra id mã giảm giá từ code
function get_code_id_from_code($code){
    $sql = "SELECT discount_id FROM total_discounts WHERE code = ?";
    return pdo_query_value($sql, $code);
}

// 3. CK mã giảm giá trong customer discount có nằm chung dòng hay không?
function check_voucher_code_id_and_id_user($code_id, $id_user){
    $sql = "SELECT discount_id, customer_id
            FROM customer_discounts 
            WHERE discount_id = ? AND customer_id=?";
    $result = pdo_query_one($sql, $code_id, $id_user);
    return $result ? true : false;
}

// 4. Kiểm tra có mã giảm giá còn thời hạn sử dụng không?
function check_voucher_time($code){
    $sql = "SELECT code FROM total_discounts WHERE code = ? AND CURDATE() BETWEEN start_date AND end_date";
    $result = pdo_query_one($sql, $code);
    return $result ? true : false;
}

// Hàm xóa cái mã giảm giá khi đã được sử dụng
function delete_status_discount_used($id_code, $id_user){
    $sql = "DELETE FROM customer_discounts WHERE discount_id = ? AND customer_id=?";
    pdo_execute($sql, $id_code, $id_user);
}

// Hàm cập nhật lại số lượng
function update_amount_discount($code){
    $sql = "UPDATE total_discounts SET discount_amount=GREATEST(discount_amount - 1, 0) WHERE code=?";
    pdo_execute($sql, $code);
}


































// 4. Cập nhật lại trạng thái sử dụng của discount khi đăt hàng
function update_status_discount($id_code, $id_user){
    $sql = "UPDATE customer_discounts SET status=1 WHERE discount_id=? AND customer_id=?";
    pdo_execute($sql, $id_code, $id_user);
}




// Kiểm tra mã giảm giá còn số lượng hay không?
function check_amount($code){
    $sql = "SELECT discount_amount FROM total_discounts WHERE code = ? AND discount_amount>0";
    $result = pdo_query_one($sql, $code);
    return $result ? true : false;
}

function get_voucher($code){
    $sql = "SELECT *
            FROM total_discounts
            WHERE code = ?";
    return pdo_query_one($sql, $code);
}

// Hàm load mã giảm giá lên
function get_available_discounts_for_customer($userId){
    $sql = "SELECT *
            FROM total_discounts td 
            JOIN customer_discounts cd ON cd.discount_id = td.discount_id
            WHERE cd.customer_id = ? AND cd.status = 0";


    return pdo_query($sql, $userId);
}

// Hàm lấy ra sản phẩm đóng gói
function get_packed_products($limit_product){
    $sql = "SELECT * FROM product WHERE product_category_id = 5 AND product_status = 0 LIMIT ".$limit_product;
    return pdo_query($sql);
}



// ------------------------------------------------- Phần giảm giá ------------------------------------
// 1. Hàm thêm danh mục khuyến mãi
function ad_add_categories_discount_apply($name, $target_total_bill){
    $sql= "INSERT INTO apply_discount_categories(name, target_total_bill) VALUES(?, ?)";
    pdo_execute($sql, $name, $target_total_bill);
}

// 2. Hàm lấy ra danh mục khuyến mãi
function get_apply_discount_categories(){
    $sql = "SELECT * FROM apply_discount_categories ORDER BY id_apply_to DESC";
    return pdo_query($sql);
}

// 3. Hàm thêm mã giảm giá
function ad_add_discount($code, $discount_percent, $discount_amount, $discount_apply, $start_date, $end_date){
    $sql= "INSERT INTO total_discounts(code, discount_percent, discount_amount, apply_to, start_date, end_date) VALUES(?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $code, $discount_percent, $discount_amount, $discount_apply, $start_date, $end_date);
}


function get_discount_by_discount_id($discount_id){
    $sql = "SELECT * FROM total_discounts WHERE discount_id = ?";
    return pdo_query_one($sql, $discount_id);

}

function ad_update_discount($code, $discount_percent, $start_date, $end_date, $discount_id){
    $sql = "UPDATE total_discounts SET code=?, discount_percent=?, start_date=?, end_date=?  WHERE discount_id=?";
    pdo_execute($sql, $code, $discount_percent, $start_date, $end_date, $discount_id); 
}

function ad_delete_discount($discount_id){
    $sql= "DELETE FROM total_discounts WHERE discount_id=?";
    pdo_execute($sql, $discount_id);
}















// function hang_hoa_insert($ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet, $so_luot_xem, $ngay_nhap, $mo_ta){
//     $sql = "INSERT INTO hang_hoa(ten_hh, don_gia, giam_gia, hinh, ma_loai, dac_biet, so_luot_xem, ngay_nhap, mo_ta) VALUES (?,?,?,?,?,?,?,?,?)";
//     pdo_execute($sql, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet==1, $so_luot_xem, $ngay_nhap, $mo_ta);
// }

// function hang_hoa_update($ma_hh, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet, $so_luot_xem, $ngay_nhap, $mo_ta){
//     $sql = "UPDATE hang_hoa SET ten_hh=?,don_gia=?,giam_gia=?,hinh=?,ma_loai=?,dac_biet=?,so_luot_xem=?,ngay_nhap=?,mo_ta=? WHERE ma_hh=?";
//     pdo_execute($sql, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet==1, $so_luot_xem, $ngay_nhap, $mo_ta, $ma_hh);
// }

// function hang_hoa_delete($ma_hh){
//     $sql = "DELETE FROM hang_hoa WHERE  ma_hh=?";
//     if(is_array($ma_hh)){
//         foreach ($ma_hh as $ma) {
//             pdo_execute($sql, $ma);
//         }
//     }
//     else{
//         pdo_execute($sql, $ma_hh);
//     }
// }

// function hang_hoa_select_by_id($ma_hh){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_one($sql, $ma_hh);
// }

// function hang_hoa_exist($ma_hh){
//     $sql = "SELECT count(*) FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_value($sql, $ma_hh) > 0;
// }

// function hang_hoa_tang_so_luot_xem($ma_hh){
//     $sql = "UPDATE hang_hoa SET so_luot_xem = so_luot_xem + 1 WHERE ma_hh=?";
//     pdo_execute($sql, $ma_hh);
// }

// function hang_hoa_select_top10(){
//     $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
//     return pdo_query($sql);
// }

// function hang_hoa_select_dac_biet(){
//     $sql = "SELECT * FROM hang_hoa WHERE dac_biet=1";
//     return pdo_query($sql);
// }

// function hang_hoa_select_by_loai($ma_loai){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
//     return pdo_query($sql, $ma_loai);
// }

// function hang_hoa_select_keyword($keyword){
//     $sql = "SELECT * FROM hang_hoa hh "
//             . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
//             . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
//     return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%');
// }

// function hang_hoa_select_page(){
//     if(!isset($_SESSION['page_no'])){
//         $_SESSION['page_no'] = 0;
//     }
//     if(!isset($_SESSION['page_count'])){
//         $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
//         $_SESSION['page_count'] = ceil($row_count/10.0);
//     }
//     if(exist_param("page_no")){
//         $_SESSION['page_no'] = $_REQUEST['page_no'];
//     }
//     if($_SESSION['page_no'] < 0){
//         $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
//     }
//     if($_SESSION['page_no'] >= $_SESSION['page_count']){
//         $_SESSION['page_no'] = 0;
//     }
//     $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh LIMIT ".$_SESSION['page_no'].", 10";
//     return pdo_query($sql);
// }