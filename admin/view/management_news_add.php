<?php 
  $html_news_categories = '';
  foreach ($news_categories as $news_cate) {
    extract($news_cate);
    $html_news_categories .= '<option value="'.$id.'">'.$name.'</option>';
  }


?>

<div class="sidebar">
  <h4>Admin</h4>
  <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
  <a href="index.php?pg=product_list"><i class="bi bi-box-seam"></i>Sản phẩm</a>
  <a href="index.php?pg=product_list_packed"><i class="bi bi-box2"></i>Sản phẩm đóng gói</a>
  <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
  <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
  <a href="index.php?pg=management_news" class="active_slide_bar"><i class="bi bi-newspaper"></i>Tin Tức</a>
  <a href="index.php?pg=discount_list"><i class="bi bi-tag"></i>Khuyến Mãi</a>
  <a href="index.php?pg=management_statistics"><i class="bi bi-bar-chart"></i>Thống kê</a>
  <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
</div>

<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Thêm Tin Tức Mới</span></h2>
    
    <form action="index.php?pg=handle_addition_news" method="post" enctype="multipart/form-data">

      <!-- 1. Hình ảnh tin tức -->
      <div class="mb-3">
        <label for="image" class="form-label"><i class="bi bi-image me-2"></i> Hình ảnh</label>
        <input type="file" class="form-control" id="image" name="image" required>
      </div>

      <!-- 2. Danh mục tin tức -->
      <div class="mb-3">
        <label for="type" class="form-label"><i class="bi bi-list-ul me-2"></i> Danh mục</label>
        <select class="form-select" id="type" name="type" required>
          <option value="">-- Chọn danh mục --</option>
          <?=$html_news_categories;?>
        </select>
      </div>

      <!-- 3. Tiêu đề tin tức -->
      <div class="mb-3">
        <label for="title" class="form-label"><i class="bi bi-card-heading me-2"></i> Tiêu đề</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề tin tức">
      </div>

      <!-- 4. Mô tả -->
      <div class="mb-3">
        <label for="content" class="form-label"><i class="bi bi-file-text me-2"></i> Nội dung</label>
        <textarea class="form-control cke" id="content" name="content" rows="4" placeholder="Nhập nội dung tin tức..."></textarea>
      </div>

      <button type="submit" name="add_news" class="btn btn_200_105_5 d-block ms-auto"><i class="bi bi-plus-circle"></i> Thêm tin tức</button>
    </form>
  </div>
</div>




