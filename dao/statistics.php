<?php
require_once 'pdo.php';

// function thong_ke_hang_hoa(){
//     $sql = "SELECT lo.ma_loai, lo.ten_loai,"
//             . " COUNT(*) so_luong,"
//             . " MIN(hh.don_gia) gia_min,"
//             . " MAX(hh.don_gia) gia_max,"
//             . " AVG(hh.don_gia) gia_avg"
//             . " FROM hang_hoa hh "
//             . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
//             . " GROUP BY lo.ma_loai, lo.ten_loai";
//     return pdo_query($sql);
// }

// function thong_ke_binh_luan(){
//     $sql = "SELECT hh.ma_hh, hh.ten_hh,"
//             . " COUNT(*) so_luong,"
//             . " MIN(bl.ngay_bl) cu_nhat,"
//             . " MAX(bl.ngay_bl) moi_nhat"
//             . " FROM binh_luan bl "
//             . " JOIN hang_hoa hh ON hh.ma_hh=bl.ma_hh "
//             . " GROUP BY hh.ma_hh, hh.ten_hh"
//             . " HAVING so_luong > 0";
//     return pdo_query($sql);
// }

// 1. Hàm lấy ra tổng khách hàng
function ad_get_total_customers() {
    $sql = "SELECT COUNT(*) FROM user WHERE role=0";
    return pdo_query_value($sql);
}

// 2. Hàm lấy ra tổng khách hàng mới
function ad_get_total_today_customers() {
    $sql = "SELECT COUNT(*) FROM user WHERE role=0 AND DATE(created_at) = CURDATE()";
    return pdo_query_value($sql);
}

// 3. Hàm lấy ra tổng sản phẩm
function ad_get_total_products() {
    $sql = "SELECT COUNT(*) FROM product WHERE product_category_id IN (1,2,3,4)";
    return pdo_query_value($sql);
}

// 4. Hàm lấy ra tổng sản phẩm đóng gói

function ad_get_total_packed_products() {
    $sql = "SELECT COUNT(*) FROM product WHERE product_category_id=5";
    return pdo_query_value($sql);
}

// 5. Hàm lấy ra tổng đơn hàng
function ad_get_total_orders() {
    $sql = "SELECT COUNT(*) FROM bill";
    return pdo_query_value($sql);
}

// 6. Hàm lấy ra tổng đơn hàng hôm nay
function ad_get_total_today_orders() {
    $sql = "SELECT COUNT(*) FROM bill WHERE DATE(created_at) = CURDATE()";
    return pdo_query_value($sql);
}

// 7. Hàm lấy ra tổng doanh thu
function ad_get_total_revenue() {
    $sql = "SELECT SUM(bd.total_price) 
            FROM bill_detail bd
            JOIN bill b ON b.bill_id = bd.bill_id
            WHERE b.payment_status = 1";
    return pdo_query_value($sql);
}

// 8. Hàm lấy ra tổng doanh thu hôm nay
function ad_get_total_today_revenue() {
    $sql = "SELECT SUM(bd.total_price) 
            FROM bill_detail bd
            JOIN bill b ON b.bill_id = bd.bill_id
            WHERE b.payment_status = 1 AND DATE(b.created_at) = CURDATE()";
    return pdo_query_value($sql);
}

// 9. Hàm lấy ra doanh thu 7 ngày
function ad_get_revenue_last_7_days() {
    $sql = "SELECT DATE(b.created_at) AS date, SUM(bd.total_price) AS revenue
            FROM bill b
            JOIN bill_detail bd ON b.bill_id = bd.bill_id
            WHERE b.payment_status = 1 AND b.created_at >= CURDATE() - INTERVAL 6 DAY
            GROUP BY DATE(b.created_at)
            ORDER BY DATE(b.created_at)";
    return pdo_query($sql);
}