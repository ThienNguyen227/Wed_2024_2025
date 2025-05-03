<?php 
  $html_product_categories = '';
  foreach ($product_categories as $pro_cate) {
    extract($pro_cate);
    $html_product_categories .= '<option value="'.$id.'">'.$name.'</option>';
  }


?>


<body>
    
    <div class="sidebar">
      <h4>Admin</h4>
      <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
      <a href="index.php?pg=product_list" class="active_slide_bar"><i class="bi bi-box-seam"></i>Sản phẩm</a>
      <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
      <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
      <a href="#"><i class="bi bi-bar-chart"></i>Thống kê</a>
      <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
    </div>

    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <span class="navbar-brand fw-bold text-dark">Thêm sản phẩm</span>
        <div class="ms-auto">
          <span class="me-3">Xin chào, Admin</span>
          <i class="bi bi-person-circle fs-4"></i>
        </div>
      </div>
    </nav>

    <!-- Thêm sản phẩm -->
    <div class="main">
      <div class="container mt-4">
        <h3 class="mb-4">Thêm sản phẩm mới</h3>
        
        <form action="index.php?pg=handle_addition_product" method="post" enctype="multipart/form-data">

          <!-- 1. Hình ảnh sản phẩm -->
          <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh sản phẩm</label>
            <input type="file" class="form-control" id="image" name="image" required>
          </div>

          <!-- 2. Tên sản phẩm -->
          <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
          </div>

          <!-- 3. Danh mục sản phẩm -->
          <div class="mb-3">
            <label for="category" class="form-label">Danh mục sản phẩm</label>
            <select class="form-select" id="category" name="category_id" required>
              <option value="">-- Chọn danh mục --</option>
              <?=$html_product_categories;?>
              <!-- <option value="1">Cà phê</option>
              <option value="2">Trà</option>
              <option value="3">Bánh ngọt</option> -->
              
            </select>
          </div>

          <!-- 4. Đơn giá -->
          <div class="mb-3">
            <label for="price" class="form-label">Đơn giá (VNĐ)</label>
            <input type="number" class="form-control" id="price" name="price" min="0" placeholder="Nhập đơn giá" required>
          </div>

          <!-- 5. Mô tả sản phẩm -->
          <div class="mb-3">
            <label for="description" class="form-label">Mô tả sản phẩm</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm..."></textarea>
          </div>

          <button type="submit" name="add_product" class="btn btn-primary d-block ms-auto"><i class="bi bi-plus-circle"></i> Thêm sản phẩm</button>
        </form>
      </div>
    </div>
