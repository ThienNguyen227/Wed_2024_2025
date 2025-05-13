<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thay Đổi Mật Khẩu</title>
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
      <img src="<?= IMG_PATH_USER_LOG . 'Logo-removebg-preview.png' ?>" alt="Logo" class="logo"> 
      <h3 class="text-center mb-5"><i class="fa-solid fa-repeat"></i> Thay Đổi Mật Khẩu</h3>

      <form action="index.php?pg=resetpassword" method="post">

        <!-- Email -->
        <div class="mb-3">
          <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
          <input  type="email" 
            name="email" 
            id="email" 
            value="<?php echo isset($_SESSION['otp_email']) ? htmlspecialchars($_SESSION['otp_email']) : ''; ?>" 
            class="mb-3"
            readonly 
            required
          >
        </div>

        <!-- Password -->
        <div class="mb-3 position-relative">
          <label for="password" class="form-label"><i class="fa-solid fa-key"></i> Mật khẩu mới</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            placeholder="Nhập mật khẩu mới ..."
            required
          />
          
          <i class="fa-solid fa-eye toggle_icon_password" id="togglePassword"></i>
      
        </div>
        <!-- Thông báo khi đổi mật khẩu thất bại -->
        <?php
          if (isset($_SESSION['tb_invalid_change_password']) && $_SESSION['tb_invalid_change_password'] != "") {
          echo '<div class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_change_password'] . '</div>';
          unset($_SESSION['tb_invalid_change_password']);
          }
        ?>

        
        <input type="submit" name="reset_password" value="Xác nhận">

        <div class="text-end ml-5">
          <a href="index.php?pg=dangnhap" class="font-weight-bold text-decoration-none cl"><i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập</a>
        </div>

        <!-- Thông báo khi đổi mật khẩu thành công -->
        <?php
          if (isset($_SESSION['tb_success_reset']) && $_SESSION['tb_success_reset'] != "") {
            echo '<div class="text-success"><i class="fa-solid fa-circle-check"></i> ' . $_SESSION['tb_success_reset'] . '</div>';
            unset($_SESSION['tb_success_reset']);
          }
        ?>
      </form>

    </div>
    <!-- bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!-- login.js -->
      <script src="layout/js/login.js"></script>
  </body>
</html>
