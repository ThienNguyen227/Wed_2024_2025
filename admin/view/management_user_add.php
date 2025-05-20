<div class="main">
    <div class="container mt-4">
        <!-- Tiêu đề -->
        <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Thêm Người Dùng Mới</span></h2>

        <form action="index.php?pg=handle_addition_user" method="post" enctype="multipart/form-data">

            <!-- 1. Tên khách hàng -->
            <div class="mb-3">
            <label for="name" class="form-label"><i class="bi bi-person me-2"></i> Tên khách hàng/quản trị viên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên khách hàng" required>
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
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>

            <!-- Thông báo Số điện thoại không hợp lệ -->
            <?php
                if (isset($_SESSION['tb_invalid_phone']) && $_SESSION['tb_invalid_phone'] != "") {
                    echo '<div class="text-danger mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_phone'] . '</div>';
                    unset($_SESSION['tb_invalid_phone']);
                }
            ?>

            <!-- 3. Email -->
            <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i> Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
            </div>

            <!-- Thông báo Email không hợp lệ -->
            <?php
                if (isset($_SESSION['tb_invalid_email']) && $_SESSION['tb_invalid_email'] != "") {
                    echo '<div class="text-danger mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_email'] . '</div>';
                    unset($_SESSION['tb_invalid_email']);
                }
            ?>

            <!-- 4. Mật khẩu -->
            <div class="mb-3">
            <label for="password" class="form-label"><i class="bi bi-lock me-2"></i> Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>

            <!-- Thông báo Mật khẩu không hợp lệ -->
            <?php
                if (isset($_SESSION['tb_invalid_password']) && $_SESSION['tb_invalid_password'] != "") {
                    echo '<div class="text-danger mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_password'] . '</div>';
                    unset($_SESSION['tb_invalid_password']);
                }
            ?>

            <!-- 5. Địa chỉ -->
            <div class="mb-3">
                <label for="address" class="form-label"><i class="bi bi-geo-alt me-2"></i> Địa chỉ</label>
                <!-- <input type="text" class="form-control editor" id="address" name="address" placeholder="Nhập địa chỉ"> -->
                <textarea class="form-control editor" id="address" name="address" rows="4" placeholder="Nhập địa chỉ ..." required></textarea>
            </div>

            <!-- 6. Vai trò (Role) -->
            <div class="mb-3">
            <label for="role" class="form-label"><i class="bi bi-shield-lock me-2"></i> Vai trò</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">-- Chọn vai trò --</option>
                <option value="0"> Người dùng</option>
                <option value="1"> Quản trị viên</option>
            </select>
            </div>

            <button type="submit" name="add_user" class="btn btn_200_105_5 d-block ms-auto">
                <i class="bi bi-plus-circle"></i> Thêm người dùng
            </button>
        </form>

    </div>
</div>
