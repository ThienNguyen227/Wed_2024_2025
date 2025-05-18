<?php 
  $html_categories_apply = '';
  foreach ($categories_apply as $ca) {
    extract($ca);
    $html_categories_apply .= '<option value="'.$id_apply_to.'">'.$name.'</option>';
  }
?>

<!-- Thêm sản phẩm -->
<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-1 mb-3">Thêm Mã Giảm Giá Mới</span></h2>
    
    <form action="index.php?pg=handle_addition_discount" method="post">

      <!-- 1. Mã giảm giá -->
      <div class="mb-3">
        <label for="code" class="form-label">
          <i class="bi bi-ticket-perforated me-2"></i> Mã giảm giá
        </label>
        <input type="text" class="form-control" id="code" name="code" placeholder="Nhập mã giảm giá ... " required>
      </div>


      <!-- 2. Phần trăm giảm -->
      <div class="mb-3">
        <label for="discount_percent" class="form-label">
          <i class="bi bi-percent me-2"></i> Phần trăm giảm (%)
        </label>
        <input type="text" class="form-control" id="discount_percent" name="discount_percent" placeholder="Nhập phần trăm giảm ... " required>
      </div>

      <!-- 3. Số lượng -->
      <div class="mb-3">
        <label for="discount_amount" class="form-label">
          <i class="bi bi-percent me-2"></i> Số lượng
        </label>
        <input type="text" class="form-control" id="discount_amount" name="discount_amount" placeholder="Nhập số lượng ... " required>
      </div>

      <!-- 4. Danh mục mã giảm giá -->
      <div class="mb-3">
        <label for="apply_to" class="form-label"><i class="bi bi-list-ul me-2"></i>Phạm vi áp dụng mã giảm giá</label>
        <select class="form-select" id="apply_to" name="apply_to" required>
          <option value="">-- Chọn phạm vi áp dụng --</option>
          <?=$html_categories_apply;?>
        </select>
      </div>

      <!-- 5. Ngày bắt đầu -->
      <div class="mb-3">
        <label for="start_date" class="form-label">
          <i class="bi bi-calendar-plus me-2"></i> Ngày bắt đầu
        </label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
      </div>

      <!-- 7. Ngày kết thúc -->
      <div class="mb-3">
        <label for="end_date" class="form-label">
          <i class="bi bi-calendar-minus me-2"></i> Ngày kết thúc
        </label>
        <input type="date" class="form-control" id="end_date" name="end_date" required>
      </div>

      <button type="submit" name="add_discount" class="btn btn_200_105_5 d-block ms-auto">
        <i class="bi bi-plus-circle"></i> Thêm mã giảm giá
      </button>
    </form>

  </div>
</div>