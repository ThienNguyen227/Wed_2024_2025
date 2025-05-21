<?php
  if(isset($_SESSION['admin_account']) && count($_SESSION['admin_account'])>0)
  {
    extract($_SESSION['admin_account']);
  }
?>


<div class="main">
    <h2 class="text-center"><span class="badge title_page mt-3 mb-4"><i class="fa-solid fa-id-card"></i> Thông tin cá nhân</span></h2>
    <div class="row">

        <!--  Phần khung thông tin cá nhân -->
        <div class="col-9">
            
            <!-- Khung Thông Tin Cá Nhân -->
            <div class="row border border-dark rounded-4 shadow-sm p-4 mb-4 bg-light">
                <form method="post" action="index.php?pg=user_update" class="row" onsubmit="return validateForm()">
                    <input type="hidden" name="id" value="<?= $_SESSION['admin_account']['id'] ?>">
                    <!-- Tên khách hàng -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label text-col-rgb_229_121_5"><strong> <i class="bi bi-person-circle"></i> Tên admin</strong></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn ..." value="<?=$name;?>">
                    </div>

                    <!-- Số điện thoại -->
                    <div class="col-md-6 mb-3">
                        <label for="customerPhone" class="form-label text-col-rgb_229_121_5"><strong><i class="bi bi-telephone-fill"></i> Số điện thoại</strong></label>

                        <input type="text" class="form-control" id="phone" name="phone" value="<?=$phone;?>">

                        <!-- Thông báo khi không hợp lệ số điện thoại -->
                        <?php
                            if(isset($_SESSION['tb_phone_update']) && $_SESSION['tb_phone_update'] != "") {
                            echo '<div class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_phone_update'] . '</div>';
                            unset($_SESSION['tb_phone_update']);
                            }
                        ?>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="customerEmail" class="form-label text-col-rgb_229_121_5"><strong><i class="bi bi-envelope-fill"></i> Email</strong></label>
                        <input type="email" class="form-control" id="email" name="email" value="<?=$email;?>">
                        <!-- Thông báo khi không hợp lệ email -->
                        <?php
                            if(isset($_SESSION['tb_email_update']) && $_SESSION['tb_email_update'] != "") {
                            echo '<div class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_email_update'] . '</div>';
                            unset($_SESSION['tb_email_update']);
                            }
                        ?>
                    </div>

                    <!-- Địa chỉ -->
                    <div class="col-md-6 mb-3">
                        <label for="customerAddress" class="form-label text-col-rgb_229_121_5"><strong><i class="bi bi-geo-alt-fill"></i> Địa Chỉ</strong></label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ của bạn của bạn ..." value="<?= $address;?>">
                    </div>

                    <!-- Nút cập nhật -->
                    <div class="col-12 text-end">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <button type="submit" name="capnhat" class="btn btn-success px-4 rounded-pill fw-bold">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Cập Nhật
                        </button>
                    </div>

                    <!-- Thông báo khi cập nhật thông tin thành công -->
                    <?php
                        if(isset($_SESSION['tb_update_thanhcong']) && $_SESSION['tb_update_thanhcong'] != "") {
                            echo '<div class="text-success"><i class="fa-solid fa-circle-check"></i> ' . $_SESSION['tb_update_thanhcong'] . '</div>';
                            unset($_SESSION['tb_update_thanhcong']);
                        }
                    ?>
                </form>
            </div>
        </div>

        <!--  List Danh Mục -->
        <div class="col-3 mt-5">
            <div class="row">
                <div class="col">
                    <div class="list-group" id="list-tab" role="tablist" data-aos="slide-up" data-aos-duration="3000">
                    <a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center h_active"
                        href="index.php?pg=user_account">
                        <span><i class="fa-solid fa-id-card"></i> Thông Tin Cá Nhân</span>
                        <i class="fa-solid fa-caret-right"></i>
                    </a>
                    <a  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        href="index.php?pg=login_forgot">
                        <span><i class="fa-solid fa-repeat"></i> Đổi Mật Khẩu</span>
                        <i class="fa-solid fa-caret-right"></i>
                    </a>
                    <a  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        href="index.php?pg=logout">
                        <span><i class="fa-solid fa-right-from-bracket"></i></i> Đăng Xuất</span>
                        <i class="fa-solid fa-caret-right"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>