<?php 
  $html_product_categories = '';
  foreach ($product_categories as $pro_cate) {
    extract($pro_cate);
    $html_product_categories .= '<option value="'.$id.'">'.$name.'</option>';
  }


?>

<div class="sidebar">
  <h4>Admin</h4>
  <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
  <a href="index.php?pg=product_list" class="active_slide_bar"><i class="bi bi-box-seam"></i>Sản phẩm</a>
  <a href="index.php?pg=product_list_packed"><i class="bi bi-box2"></i>Sản phẩm đóng gói</a>
  <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
  <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
  <a href="index.php?pg=management_news"><i class="bi bi-newspaper"></i>Tin Tức</a>
  <a href="index.php?pg=discount_list"><i class="bi bi-tag"></i>Khuyến Mãi</a>
  <a href="index.php?pg=management_statistics"><i class="bi bi-bar-chart"></i>Thống kê</a>
  <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
</div>



<!-- Thêm sản phẩm -->
<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-1 mb-3">Thêm Sản Phẩm Mới</span></h2>
    
    <form action="index.php?pg=handle_addition_product" method="post" enctype="multipart/form-data">

      <!-- 1. Hình ảnh sản phẩm -->
      <div class="mb-3">
        <label for="image" class="form-label">
          <i class="bi bi-image me-2"></i> Hình ảnh sản phẩm
        </label>
        <input type="file" class="form-control" id="image" name="image" required>
      </div>

      <!-- 2. Tên sản phẩm -->
      <div class="mb-3">
        <label for="name" class="form-label">
          <i class="bi bi-box me-2"></i> Tên sản phẩm
        </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
      </div>

      <!-- 3. Danh mục sản phẩm -->
      <div class="mb-3">
        <label for="category" class="form-label"><i class="bi bi-list-ul me-2"></i>Danh mục sản phẩm</label>
        <select class="form-select" id="category" name="category_id" required>
          <option value="">-- Chọn danh mục --</option>
          <?=$html_product_categories;?>
        </select>
      </div>

      <!-- 4. Đơn giá -->
      <div class="mb-3">
        <label for="price" class="form-label"><i class="bi bi-currency-dollar me-2"></i>Đơn giá (VNĐ)</label>
        <input type="text" class="form-control" id="price" name="price" min="0" placeholder="Nhập đơn giá" required>
      </div>

      <!-- 5. Mô tả sản phẩm -->
      <div class="mb-3">
        <label for="description" class="form-label"><i class="bi bi-pencil-square me-2"></i>Mô tả sản phẩm</label>
        <textarea class="form-control cke" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm..."></textarea>
      </div>

      <button type="submit" name="add_product" class="btn btn_200_105_5 d-block ms-auto"><i class="bi bi-plus-circle"></i> Thêm sản phẩm</button>
    </form>
  </div>
</div>
