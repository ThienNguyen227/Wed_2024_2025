<?php 
  extract($info_discount);
  $code = $info_discount['code'];
  $discount_percent = $info_discount['discount_percent'];
  $start_date = $info_discount['start_date'];
  $end_date = $info_discount['end_date'];
  $created_at = $info_discount['created_at'];
  $update_at = $info_discount['update_at'];
?>






<div class="sidebar">
  <h4>Admin</h4>
  <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
  <a href="index.php?pg=product_list"><i class="bi bi-box-seam"></i>Sản phẩm</a>
  <a href="index.php?pg=product_list_packed"><i class="bi bi-box2"></i>Sản phẩm đóng gói</a>
  <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
  <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
  <a href="index.php?pg=management_news"><i class="bi bi-newspaper"></i>Tin Tức</a>
  <a href="index.php?pg=discount_list" class="active_slide_bar"><i class="bi bi-tag"></i>Khuyến Mãi</a>
  <a href="index.php?pg=management_statistics"><i class="bi bi-bar-chart"></i>Thống kê</a>
  <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
</div>


<div class="main">
    <div class="container mt-4">
        <h2 class="text-center">
            <span class="badge title_page mt-3 mb-4">Cập Nhật Mã Giảm Giá</span>
        </h2>

        <form action="index.php?pg=handle_edition_discount" method="post">

            <!-- 1. Mã giảm giá -->
            <div class="mb-3">
                <label for="code" class="form-label"><i class="bi bi-ticket-perforated me-2"></i> Mã giảm giá</label>
                <input type="text" class="form-control" id="code" name="code" value="<?= htmlspecialchars($code) ?>" required>
            </div>

            <!-- 2. Phần trăm giảm -->
            <div class="mb-3">
                <label for="discount_percent" class="form-label"><i class="bi bi-percent me-2"></i> Phần trăm giảm (%)</label>
                <input type="number" class="form-control" id="discount_percent" name="discount_percent" value="<?= $discount_percent ?>" min="1" max="100" required>
            </div>

            <!-- 3. Ngày bắt đầu -->
            <div class="mb-3">
                <label for="start_date" class="form-label"><i class="bi bi-calendar-plus me-2"></i> Ngày bắt đầu</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $start_date ?>" required>
            </div>

            <!-- 4. Ngày kết thúc -->
            <div class="mb-3">
                <label for="end_date" class="form-label"><i class="bi bi-calendar-minus me-2"></i> Ngày kết thúc</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $end_date ?>" required>
            </div>

            <!-- 5. Ngày tạo -->
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-calendar me-2"></i> Ngày tạo</label>
                <input type="text" class="form-control" 
                      value="<?= date('H:i:s - d/m/Y', strtotime($created_at)) ?>" readonly>
            </div>

            <!-- 6. Ngày cập nhật cuối -->
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-clock-history me-2"></i> Cập nhật lần cuối</label>
                <input type="text" class="form-control" 
                      value="<?= date('H:i:s - d/m/Y', strtotime($update_at)) ?>" readonly>
            </div>

            <input type="hidden" name="discount_id" value="<?= $discount_id ?>">

            <button type="submit" name="edit_discount" class="btn btn_200_105_5 d-block ms-auto">
                <i class="bi bi-save"></i> Lưu thay đổi
            </button>
        </form>
    </div>
</div>

