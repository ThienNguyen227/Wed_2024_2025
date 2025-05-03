<?php 
    extract($product_by_id);
    $id_pro = $product_by_id['id'];
    $img_product = $product_by_id['img'];
    $name_product = $product_by_id['name'];
    $price_product = $product_by_id['price'];
    $description_product = $product_by_id['description'];
    $categories_product = $product_by_id['product_category_id'];
    
    $html_product_categories = '';
    foreach ($product_categories as $pro_cate) {
        extract($pro_cate);
            $selected = ($id == $categories_product) ? 'selected' : '';
            $html_product_categories .= '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
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
        <span class="navbar-brand fw-bold text-dark">Cập Nhật Sản Phẩm</span>
        <div class="ms-auto">
          <span class="me-3">Xin chào, Admin</span>
          <i class="bi bi-person-circle fs-4"></i>
        </div>
      </div>
    </nav>

    <!-- Thêm sản phẩm -->
    <div class="main">
      <div class="container mt-4">
        <h3 class="mb-4">Cập Nhật Sản Phẩm</h3>
        
        <form action="index.php?pg=handle_edition_product" method="post" enctype="multipart/form-data">
            <!-- 0. Hình ảnh sản phẩm cũ -->
            <div class="mb-3">
                <h4>Hình ảnh sản phẩm cũ</h4>
                <img src="<?= IMG_PATH_ADMIN_PRODUCT . $img_product ?>" class="img-thumbnail" style="width: 200px;  object-fit: cover">
            </div>

            <!-- 1. Hình ảnh sản phẩm muốn thay đổi-->
            <div class="mb-3">
                <label for="image" class="form-label">Chọn hình ảnh mới cho sản phẩm</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- 2. Tên sản phẩm -->
            <div class="mb-3">
                <label for="name" class="form-label">Nhập tên mới cho sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$name_product?>" placeholder="Nhập tên sản phẩm" required>
            </div>

            <!-- 3. Danh mục sản phẩm -->
            <div class="mb-3">
                <label for="category" class="form-label">Danh mục sản phẩm</label>
                <select class="form-select" id="category" name="category_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?=$html_product_categories;?>
                </select>
            </div>

            <!-- 4. Đơn giá -->
            <div class="mb-3">
                <label for="price" class="form-label">Nhập đơn giá mới (VNĐ)</label>
                <input type="number" class="form-control" id="price" name="price" value="<?=$price_product?>" min="0" placeholder="Nhập đơn giá" required>
            </div>

            <!-- 5. Mô tả sản phẩm -->
            <div class="mb-3">
                <input type="hidden" name="id" value="<?=$id_pro?>">
                <label for="description" class="form-label">Nhập mô tả mới cho sản phẩm</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm..." required><?=$description_product?></textarea>

            </div>

            <button type="submit" name="update_product" class="btn btn-success d-block ms-auto"><i class="bi bi-pencil-square me-1"></i> Cập nhật sản phẩm</button>

        </form>
      </div>
    </div>
