<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-1 mb-3">Thêm Thông Báo Mới</span></h2>
    
    <form action="index.php?pg=handle_addition_notification" method="post">

      <!-- 1. Tiêu đề thông báo-->
      <div class="mb-3">
        <label for="title" class="form-label">
          <i class="bi bi-box me-2"></i> Tiêu đề
        </label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề ..." required>
      </div>

      <!-- 2. Nội dung thông báo-->
      <div class="mb-3">
        <label for="content" class="form-label"><i class="bi bi-pencil-square me-2"></i>Nội dung</label>
        <textarea class="form-control editor" id="content" name="content" rows="4" placeholder="Nhập Nội dung ..."></textarea>
      </div>

      <button type="submit" name="add_notification" class="btn btn_200_105_5 d-block ms-auto"><i class="bi bi-plus-circle"></i> Thêm thông báo</button>
    </form>
  </div>
</div>