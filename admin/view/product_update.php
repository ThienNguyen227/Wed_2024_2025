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


<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-1 mb-3">Cập Nhật Sản Phẩm</span></h2>
    
    <form action="index.php?pg=handle_edition_product" method="post" enctype="multipart/form-data">
        <!-- 0. Hình ảnh sản phẩm cũ -->
        <div class="mb-3">
            <h4 class="text_200_105_5"><i class="bi bi-card-image"></i> Hình ảnh sản phẩm hiện tại</h4>
            <img src="<?= IMG_PATH_ADMIN_PRODUCT . $img_product ?>" class="img-thumbnail" style="width: 200px;  object-fit: cover">
        </div>

        <!-- 1. Hình ảnh sản phẩm muốn thay đổi-->
        <div class="mb-3">
            <label for="image" class="form-label"><i class="bi bi-image me-2"></i> Chọn hình ảnh mới cho sản phẩm</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        

        <!-- 2. Tên sản phẩm -->
        <div class="mb-3">
            <label for="name" class="form-label"><i class="bi bi-box me-2"></i> Nhập tên mới cho sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$name_product?>" placeholder="Nhập tên sản phẩm" required>
        </div>


        <!-- 3. Danh mục sản phẩm -->
        <div class="mb-3">
            <label for="category" class="form-label"><i class="bi bi-list-ul me-2"></i> Danh mục sản phẩm</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                <?=$html_product_categories;?>
            </select>
        </div>

        <!-- 4. Đơn giá -->
        <div class="mb-3">
            <label for="price" class="form-label"><i class="bi bi-currency-dollar me-2"></i> Nhập đơn giá mới (VNĐ)</label>
            <input type="text" class="form-control" id="price" name="price" value="<?=$price_product?>" min="0" placeholder="Nhập đơn giá" required>
        </div>

        <?php
            if (isset($_SESSION['tb_error']) && $_SESSION['tb_error'] != "") {
            echo '<div class="text-danger fw-bold mb-3 fs-5"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_error'] . '</div>';
            unset($_SESSION['tb_error']);
            }
        ?>

        <!-- 5. Mô tả sản phẩm -->
        <div class="mb-3">
            <input type="hidden" name="id" value="<?=$id_pro?>">
            <label for="description" class="form-label"><i class="bi bi-pencil-square me-2"></i> Nhập mô tả mới cho sản phẩm</label>
            <textarea class="form-control editor" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm..." required><?=$description_product?></textarea>
        </div>

        <button type="submit" name="update_product" class="btn btn_200_105_5 d-block ms-auto"><i class="bi bi-box-arrow-in-down-left"></i> Cập nhật sản phẩm</button>

    </form>
  </div>
</div>
