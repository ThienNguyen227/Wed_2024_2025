<?php
    extract($bill);
    $bill_id = $bill['bill_id'];
    $user_id = $bill['user_id'];
    $receiver_name = $bill['receiver_name'];
    $receiver_phone = $bill['receiver_phone'];
    $receiver_email = $bill['receiver_email'];
    $receiver_address = $bill['receiver_address'];
    $payment_method = $bill['payment_method'];
    $payment_status = $bill['payment_status'];
    $status = $bill['status'];
    $created_at = $bill['created_at'];
?>


<div class="sidebar">
    <h4>Admin</h4>
    <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
    <a href="index.php?pg=product_list"><i class="bi bi-box-seam"></i>Sản phẩm</a>
    <a href="index.php?pg=product_list_packed"><i class="bi bi-box2"></i>Sản phẩm đóng gói</a>
    <a href="index.php?pg=product_order" class="active_slide_bar"><i class="bi bi-cart"></i>Đơn hàng</a>
    <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
    <a href="index.php?pg=management_news"><i class="bi bi-newspaper"></i>Tin Tức</a>
    <a href="index.php?pg=discount_list"><i class="bi bi-tag"></i>Khuyến Mãi</a>
    <a href="index.php?pg=management_statistics"><i class="bi bi-bar-chart"></i>Thống kê</a>
    <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
</div>

<div class="main">
    <h2 class="title_page">Chi tiết đơn hàng #<?= $bill_id ?></h2>

    <div class="container mt-4">
        <div class="row g-4 align-items-stretch">
            <!-- Thông tin khách hàng -->
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <h4 class="text_200_105_5 mb-3 text-center">Thông Tin Khách Hàng</h4>
                        <p><i class="bi bi-person-badge me-2"></i><strong>ID Người dùng:</strong> <?= $user_id ?></p>
                        <p><i class="bi bi-person me-2"></i><strong>Họ tên:</strong> <?= htmlspecialchars($receiver_name) ?></p>
                        <p><i class="bi bi-telephone me-2"></i><strong>Số điện thoại:</strong> <?= htmlspecialchars($receiver_phone) ?></p>
                        <p><i class="bi bi-envelope me-2"></i><strong>Email:</strong> <?= htmlspecialchars($receiver_email) ?></p>
                        <p><i class="bi bi-geo-alt me-2"></i><strong>Địa chỉ:</strong> <?= htmlspecialchars($receiver_address) ?></p>
                        <p><i class="bi bi-credit-card me-2"></i><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($payment_method) ?></p>
                        <p><i class="bi bi-calendar-date me-2"></i><strong>Ngày đặt:</strong> <?= $created_at ?></p>
                    </div>
                </div>

            </div>

            <!-- Cập nhật trạng thái -->
            <div class="col-md-6">
            <div class="card shadow-sm rounded-4 h-100">
                <div class="card-body d-flex flex-column">

                    <h4 class="text_200_105_5 mb-4 text-center">Cập Nhật Trạng Thái</h4>

                    <form action="index.php?pg=handle_edition_status_order" method="post" class="flex-grow-1 d-flex flex-column justify-content-between">
                        
                        <input type="hidden" name="bill_id" value="<?= $bill_id ?>">

                        <div class="mb-5">
                            <label for="payment_status" class="form-label"><strong><i class="bi bi-cash-coin"></i> Trạng thái thanh toán:</strong></label>
                            <select name="payment_status" id="payment_status" class="form-select">
                            <option value="0" <?= $payment_status == 0 ? 'selected' : '' ?>>Chưa thanh toán</option>
                            <option value="1" <?= $payment_status == 1 ? 'selected' : '' ?>>Đã thanh toán</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label"><strong><i class="bi bi-truck"></i> Trạng thái đơn hàng:</strong></label>
                            <select name="status" id="status" class="form-select">
                                <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Chờ xác nhận</option>
                                <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Đã xác nhận</option>
                                <option value="2" <?= $status == 2 ? 'selected' : '' ?>>Đang giao</option>
                                <option value="3" <?= $status == 3 ? 'selected' : '' ?>>Đã giao</option>
                                <option value="4" <?= $status == 4 ? 'selected' : '' ?>>Đã hủy</option>
                            </select>
                        </div>
                        
                        <div class="text-end mt-auto">
                            <button type="submit" name="edit_status_order" class="btn btn_200_105_5">
                            <i class="bi bi-floppy2-fill"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>


</div>

