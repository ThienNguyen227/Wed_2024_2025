<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-1 mb-3">Thêm Mã Giảm Giá Mới</span></h2>
    
    <form action="index.php?pg=handle_addition_categories_apply" method="post">

      <!-- 1. Tên giảm giá -->
      <div class="mb-3">
        <label for="name" class="form-label">
          <i class="bi bi-ticket-perforated me-2"></i> Tên danh mục giảm giá
        </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục ... " required>
      </div>


      <!-- 2. Target -->
      <div class="mb-3">
        <label for="target_total_bill" class="form-label">
          <i class="bi bi-percent me-2"></i> Mức tổng chi phí thanh toán
        </label>
        <input type="text" class="form-control" id="target_total_bill" name="target_total_bill" placeholder="Nhập mức tổng chi phí thanh toán ... " required>
      </div>

      <button type="submit" name="add_categories_apply" class="btn btn_200_105_5 d-block ms-auto">
        <i class="bi bi-plus-circle"></i> Thêm danh mục
      </button>
    </form>

    <!-- Thông báo thêm danh mục khuyến mãi thành công -->
    <?php
      if (isset($_SESSION['tb_success_addition']) && $_SESSION['tb_success_addition'] != "") {
        echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_addition'] . '</div>';
        unset($_SESSION['tb_success_addition']);
      }
    ?>

  </div>
</div>
