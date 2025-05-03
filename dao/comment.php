<?php
require_once 'pdo.php';

// Thêm bình luận vào DB

function insert_comment($id_user, $id_product, $content){
    $sql = "INSERT INTO comment(id_user, id_product, content) VALUES (?,?,?)";
    pdo_execute($sql, $id_user, $id_product, $content);
}

// Lấy bình luận ra bằng id_product 
function get_comment_by_id_product($id_product){
    $sql = "SELECT comment.*, user.name AS user_name
            FROM comment 
            JOIN user ON comment.id_user = user.id
            WHERE comment.id_product = ? 
            ORDER BY comment.created_at DESC";
    return pdo_query($sql, $id_product);
}
// Xóa comment
function remove_comment_by_id_comment($id_comment){
    $sql = "DELETE FROM comment WHERE id=?";
    pdo_execute($sql, $id_comment);
}
    
// Chỉnh sửa comment
function update_comment_by_id_comment($content, $id_comment){
    $sql = "UPDATE comment SET content=? WHERE id=?";
    pdo_execute($sql, $content, $id_comment);
}















// function binh_luan_insert($ma_kh, $ma_hh, $noi_dung, $ngay_bl){
//     $sql = "INSERT INTO binh_luan(ma_kh, ma_hh, noi_dung, ngay_bl) VALUES (?,?,?,?)";
//     pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl);
// }

// function binh_luan_update($ma_bl, $ma_kh, $ma_hh, $noi_dung, $ngay_bl){
//     $sql = "UPDATE binh_luan SET ma_kh=?,ma_hh=?,noi_dung=?,ngay_bl=? WHERE ma_bl=?";
//     pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl, $ma_bl);
// }

// function binh_luan_delete($ma_bl){
//     $sql = "DELETE FROM binh_luan WHERE ma_bl=?";
//     if(is_array($ma_bl)){
//         foreach ($ma_bl as $ma) {
//             pdo_execute($sql, $ma);
//         }
//     }
//     else{
//         pdo_execute($sql, $ma_bl);
//     }
// }

// function binh_luan_select_all(){
//     $sql = "SELECT * FROM binh_luan bl ORDER BY ngay_bl DESC";
//     return pdo_query($sql);
// }

// function binh_luan_select_by_id($ma_bl){
//     $sql = "SELECT * FROM binh_luan WHERE ma_bl=?";
//     return pdo_query_one($sql, $ma_bl);
// }

// function binh_luan_exist($ma_bl){
//     $sql = "SELECT count(*) FROM binh_luan WHERE ma_bl=?";
//     return pdo_query_value($sql, $ma_bl) > 0;
// }
// //-------------------------------//
// function binh_luan_select_by_hang_hoa($ma_hh){
//     $sql = "SELECT b.*, h.ten_hh FROM binh_luan b JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_bl DESC";
//     return pdo_query($sql, $ma_hh);
// }