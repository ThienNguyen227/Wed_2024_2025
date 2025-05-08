<?php
    $html_management_user_order ='';
    $i = 1;
    foreach ($info_order as $io) 
    {
        $bill_id = $io["bill_id"];
        $total_price = $io["total_price"];
        $html_management_user_order .='<tr class="text-center align-middle">
                                        <td>'.$i.'</td>
                                        <td>'.$bill_id.'</td>
                                        <td></td>
                                        <td>'.$total_price.'</td>
                                        <td></td>
                                    </tr>';
        $i++;
    }
?>

<div class="sidebar">
    <h4>Admin</h4>
    <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
    <a href="index.php?pg=product_list"><i class="bi bi-box-seam"></i>Sản phẩm</a>
    <a href="index.php?pg=product_list_packed"><i class="bi bi-box2"></i>Sản phẩm đóng gói</a>
    <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
    <a href="index.php?pg=management_user" class="active_slide_bar"><i class="bi bi-people"></i>Người dùng</a>
    <a href="index.php?pg=management_news"><i class="bi bi-newspaper"></i>Tin Tức</a>
    <a href="index.php?pg=discount_list"><i class="bi bi-tag"></i>Khuyến Mãi</a>
    <a href="index.php?pg=management_statistics"><i class="bi bi-bar-chart"></i>Thống kê</a>
    <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
</div>

<div class="main">

    <!-- Bảng list khách hàng -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
            <thead class="table-warning text-center align-middle">
                <tr>
                    <th scope="col"><i class="bi bi-hash me-1"></i>STT</th>
                    <th scope="col"><i class="bi bi-person-vcard me-1"></i>Mã đơn hàng</th>
                    <th scope="col"><i class="bi bi-person-lines-fill me-1"></i>Sản phẩm</th>
                    <th scope="col"><i class="bi bi-telephone me-1"></i>Tổng đơn giá</th>
                    <th scope="col"><i class="bi bi-envelope me-1"></i>Ngày đặt</th>
                </tr>
            </thead>

            <tbody>
               <?=$html_management_user_order;?> 
            </tbody>
        </table>
    </div>
</div>