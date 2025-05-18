<?php 
    extract($info_news);
    $id = $info_news['id'];
    $title = $info_news['title'];
    $content = $info_news['content'];
    $image = $info_news['image'];
    $created_at = $info_news['created_at'];
?>


<div class="main">
    <div class="container mt-4">
        <!-- Tiêu đề -->
        <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Cập Nhật Tin Tức</span></h2>

        <form action="index.php?pg=handle_edition_news" method="post" enctype="multipart/form-data">

            <!-- 1. Hình ảnh hiện tại -->
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-image me-2"></i> Hình ảnh hiện tại</label><br>
                <img src="<?=IMG_PATH_ADMIN_NEWS.$image?>" alt="Hình ảnh hiện tại" width="150">
            </div>

            <!-- 2. Chọn hình ảnh mới tin tức-->
            <div class="mb-3">
                <label for="image" class="form-label"><i class="bi bi-image me-2"></i> Thay ảnh mới (nếu cần)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- 3. Tiêu đề tin tức-->
            <div class="mb-3">
                <label for="title" class="form-label"><i class="bi bi-card-heading me-2"></i> Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title) ?>" placeholder="Nhập tiêu đề bài viết">
            </div>

            <!-- 4. Nội dung tin tức-->
            <div class="mb-3">
                <label for="content" class="form-label"><i class="bi bi-file-text me-2"></i> Nội dung</label>
                <textarea id="content" name="content" class="form-control editor" rows="8"><?= htmlspecialchars($content) ?></textarea>
            </div>

            <!-- 5. Ngày tạo tin tức-->
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-calendar me-2"></i> Ngày tạo</label>
                <input type="text" class="form-control" value="<?= $created_at ?>" readonly>
            </div>

            <input type="hidden" name="id" value="<?=$id?>">

            <button type="submit" name="edit_news" class="btn btn_200_105_5 d-block ms-auto">
                <i class="bi bi-save"></i> Lưu thay đổi
            </button>
        </form>
    </div>
</div>


