<?php
    extract($info_user);
    $id = $info_user['id'];
    $phone = $info_user['phone'];
    $email = $info_user['email'];
    $name = $info_user['name'];
    $address = $info_user['address'];
    $role = $info_user['role'];
?>


<div class="main">
    <div class="container mt-4">
        <!-- Tiêu đề -->
        <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Cập Nhật Người Dùng</span></h2>

        <form action="index.php?pg=handle_edition_user" method="post">

            <!-- 1. Tên người dùng -->
            <div class="mb-3">
            <label for="name" class="form-label"><i class="bi bi-person me-2"></i> Tên khách hàng/quản trị viên</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$name?>" placeholder="Nhập tên người dùng ..." required>
            </div>

            <!-- Thông báo tên không hợp lệ -->
            <?php
                if (isset($_SESSION['tb_invalid_name']) && $_SESSION['tb_invalid_name'] != "") {
                    echo '<div class="text-danger mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_name'] . '</div>';
                    unset($_SESSION['tb_invalid_name']);
                }
            ?>

            <!-- 2. Số điện thoại -->
            <div class="mb-3">
            <label for="phone" class="form-label"><i class="bi bi-telephone me-2"></i> Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?=$phone?>" placeholder="Nhập số điện thoại" required>
            </div>

            <!-- Thông báo Số điện thoại không hợp lệ -->
            <?php
                if (isset($_SESSION['tb_phone_update']) && $_SESSION['tb_phone_update'] != "") {
                    echo '<div class="text-danger mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_phone_update'] . '</div>';
                    unset($_SESSION['tb_phone_update']);
                }
            ?>

            <!-- 3. Email -->
            <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i> Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$email?>" placeholder="Nhập email" required>
            </div>

            <!-- Thông báo Email không hợp lệ -->
            <?php
                if (isset($_SESSION['tb_email_update']) && $_SESSION['tb_email_update'] != "") {
                    echo '<div class="text-danger mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_email_update'] . '</div>';
                    unset($_SESSION['tb_email_update']);
                }
            ?>

            <!-- 4. Địa chỉ -->
            <div class="mb-3">
                <label for="address" class="form-label"><i class="bi bi-geo-alt me-2"></i> Địa chỉ</label>
                <!-- <input type="text" class="form-control" id="address" name="address" value="<?=$address?>" placeholder="Nhập địa chỉ"> -->
                <textarea class="form-control editor" id="address" name="address" rows="4" placeholder="Nhập địa chỉ ..." required><?=$address?></textarea>
            </div>

            <!-- 5. Vai trò (Role) -->
            <div class="mb-3">
                <label for="role" class="form-label"><i class="bi bi-shield-lock me-2"></i> Vai trò</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">-- Chọn vai trò --</option>
                    <option value="0" <?= $role == 0 ? 'selected' : '' ?>>Người dùng</option>
                    <option value="1" <?= $role == 1 ? 'selected' : '' ?>>Quản trị viên</option>
                </select>
            </div>

            <input type="hidden" name="id" value="<?=$id?>">

            <!-- Nút cập nhật -->
            <button type="submit" name="edit_user" class="btn btn_200_105_5 d-block ms-auto">
                <i class="bi bi-plus-circle"></i> Lưu thay đổi
            </button>
        </form>

    </div>
</div>