<?php
  $pg = $_GET['pg'] ?? '';
?>

<div class="sidebar">
  <h4>Admin</h4>

  <!-- 1. Thanh điều khiển tổng -->
  <a href="index.php" class="<?= ($pg == '') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-speedometer2"></i>Dashboard
  </a>

  <!-- 2. Sản Phẩm -->
  <a href="index.php?pg=product_list" class="<?= ($pg == 'product_list' or $pg == 'product_add' or $pg == 'product_update') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-box-seam"></i>Sản phẩm
  </a>

  <!-- 3. Sản Phẩm Đóng Gói -->
  <a href="index.php?pg=product_list_packed" class="<?= ($pg == 'product_list_packed' or $pg == 'product_packed_add' or $pg == 'product_packed_update') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-box2"></i>Sản phẩm đóng gói
  </a>

  <!-- 4. Đơn hàng -->
  <a href="index.php?pg=product_order" class="<?= ($pg == 'product_order' or $pg == 'product_order_adjust_status') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-cart"></i>Đơn hàng
  </a>

  <!-- 5. Người dùng -->
  <a href="index.php?pg=management_user" class="<?= ($pg == 'management_user' or $pg == 'management_user_add' or $pg == 'management_user_update' or $pg == 'management_user_order') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-people"></i>Người dùng
  </a>

  <!-- 6. Tin tức -->
  <a href="index.php?pg=management_news" class="<?= ($pg == 'management_news' or $pg == 'management_news_add' or $pg == 'management_news_update') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-newspaper"></i>Tin Tức
  </a>

  <!-- 7. Khuyến mãi -->
  <?php
    $discountPages = ['discount_add_categories_apply', 'discount_list', 'discount_add'];
    $isDiscountPage = in_array($pg, $discountPages);
  ?>
  <a class="d-flex justify-content-between align-items-center <?= $isDiscountPage ? 'active_slide_bar' : '' ?>"
      data-bs-toggle="collapse"
      href="#collapseDiscount"
      role="button"
      aria-expanded="<?= $isDiscountPage ? 'true' : 'false' ?>"
      aria-controls="collapseDiscount">
    <span><i class="bi bi-tag"></i>Khuyến Mãi</span>
    <i class="bi bi-chevron-down"></i>
  </a>
  <div class="collapse ps-4 <?= $isDiscountPage ? 'show' : '' ?>" id="collapseDiscount">
    <a href="index.php?pg=discount_add_categories_apply" class="d-block py-1 <?= ($pg == 'discount_add_categories_apply') ? 'active_slide_bar' : '' ?>">
      <i class="bi bi-folder-plus"></i> Tạo danh mục khuyến mãi
    </a>
    <a href="index.php?pg=discount_list" class="d-block py-1 <?= ($pg == 'discount_list') ? 'active_slide_bar' : '' ?>">
      <i class="bi bi-list-ul"></i> Danh sách KM
    </a>
  </div>

  <!-- 8. Thông báo -->
  <a href="index.php?pg=notification_list" class="<?= ($pg == 'notification_list' or $pg == 'notification_add' or $pg == 'notification_update') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-envelope-plus"></i>Thông báo
  </a>

  <!-- 9. Thống kê -->
  <a href="index.php?pg=management_statistics" class="<?= ($pg == 'management_statistics') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-bar-chart"></i>Thống kê
  </a>

  <!-- 10. Cài đặt -->
  <a href="index.php?pg=setting" class="<?= ($pg == 'setting') ? 'active_slide_bar' : '' ?>">
    <i class="bi bi-gear"></i>Cài đặt</a>
</div>
