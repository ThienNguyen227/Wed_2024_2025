<?php 
  extract($notification_by_id);
  $id_notification = $notification_by_id['notification_id'];
  $title_notification = $notification_by_id['notification_title'];
  $message_notification = $notification_by_id['notification_message'];
?>

<div class="main">
  <div class="container mt-4">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-1 mb-3">Cập Nhật Thông Báo</span></h2>
    
    <form action="index.php?pg=handle_edition_notification" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?=$id_notification?>">
        <!-- 1. Tiêu đề thông báo-->
      <div class="mb-3">
        <label for="title" class="form-label">
          <i class="bi bi-box me-2"></i> Tiêu đề
        </label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$title_notification?>" placeholder="Nhập tiêu đề ..." required>
      </div>

      <!-- 2. Nội dung thông báo-->
      <div class="mb-3">
        <label for="content" class="form-label"><i class="bi bi-pencil-square me-2"></i>Nội dung</label>
        <textarea class="form-control editor" id="content" name="content" rows="4" placeholder="Nhập nội dung thông báo ..."><?=$message_notification?></textarea>
      </div>

        <button type="submit" name="update_notification" class="btn btn_200_105_5 d-block ms-auto"><i class="bi bi-box-arrow-in-down-left"></i> Cập nhật sản phẩm</button>

    </form>
  </div>
</div>
