<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Ký Tài Khoản</title>
    <!-- login.css -->
    <link rel="stylesheet" href="layout/css/login.css">
    <!-- Favicon -->
    <link rel="icon" href="layout/Img/ZRvS2r9P.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="form-container">
      <img src="layout\Img\Logo-removebg-preview.png" alt="Logo" class="logo" />
      <h4 class="text-center mb-5">Đăng Ký Tài Khoản <i class="fa-solid fa-user-plus"></i></h4>

      <form action="index.php?pg=adduser" method="post">

        <!-- 1. Name -->
        <div class="mb-3">
          <label for="phone" class="form-label"><i class="fa-solid fa-signature"></i> Tên Người Dùng</label>
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            placeholder="Nhập tên"
            required
          />
          <?php
            if (isset($_SESSION['tb_invalid_name']) && $_SESSION['tb_invalid_name'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_name'] . '</div>';
              unset($_SESSION['tb_invalid_name']);
            }
          ?>
        </div>

        <!-- 2. Phone -->
        <div class="mb-3">
          <label for="phone" class="form-label"><i class="fa-solid fa-phone"></i> Số điện thoại</label>
          <input
            type="text"
            id="phone"
            name="phone"
            class="form-control"
            placeholder="Nhập số điện thoại"
            required
          />
          
          <!-- Thông báo check phone khi không hợp lệ -->
          <?php
            if (isset($_SESSION['tb_invalid_phone']) && $_SESSION['tb_invalid_phone'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_phone'] . '</div>';
              unset($_SESSION['tb_invalid_phone']);
            }
          ?>
        </div>

        <!-- 3. Email -->
        <div class="mb-3">
          <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
          <input
            type="text"
            id="email"
            name="email"
            class="form-control"
            placeholder="Nhập email"
            required
          />
          
          <!-- Thông báo Check email khi không hợp lệ -->
          <?php
            if (isset($_SESSION['tb_invalid_email']) && $_SESSION['tb_invalid_email'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_email'] . '</div>';
              unset($_SESSION['tb_invalid_email']);
            }
          ?>          
        </div>

        <!-- 4. Password -->
        <div class="mb-3">
          <label for="password" class="form-label"><i class="fa-solid fa-key"></i> Mật khẩu</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            placeholder="Nhập mật khẩu"
            required
          />
          <!-- Thông báo check pass khi không hợp lệ -->
          <?php
            if (isset($_SESSION['tb_invalid_password']) && $_SESSION['tb_invalid_password'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_password'] . '</div>';
              unset($_SESSION['tb_invalid_password']);
            }
          ?>
        </div>

        <!-- 5. Submit button -->
        <div>
          <input type="submit" name="dangky" value="Đăng Ký" class="btn" />
        </div>

        <!-- Thông báo trùng tài khoản-->
        <?php
          if (isset($_SESSION['tb_phone_email']) && $_SESSION['tb_phone_email'] != "") {
            echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_phone_email'] . '</div>';
            unset($_SESSION['tb_phone_email']);
          }
        ?>
        <div class="text-center mt-3">
          <a href="index.php?pg=dangnhap" class="font-weight-bold text-decoration-none cl"><i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập Tài Khoản</a>
        </div>
      </form>
    </div>

    <!-- bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
