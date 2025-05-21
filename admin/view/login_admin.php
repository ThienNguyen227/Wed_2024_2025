<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Nhập Tài Khoản</title>

    <!-- login.css -->
    <link rel="stylesheet" href="layout/css/login.css">

    <!-- Favicon -->
    <link rel="icon" href="/uploads/log/ZRvS2r9P.ico" type="image/x-icon" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- CDN Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="form-container">
      <img src="<?= IMG_PATH_ADMIN_LOG . 'Logo-removebg-preview.png' ?>" alt="Logo" class="logo" />
      <h4 class="text-center mb-5">Đăng Nhập Tài Khoản <i class="fa-solid fa-right-to-bracket"></i></h4>

      <form action="index.php?pg=login" method="post">
        <!-- Phone -->
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

          <!-- Thông báo tài khoản không tồn tại -->
          <?php
            if (isset($_SESSION['tb_wrong_account']) && $_SESSION['tb_wrong_account'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_wrong_account'] . '</div>';
              unset($_SESSION['tb_wrong_account']);
            }
          ?>
        </div>
        
        <!-- Password -->
        <div class="mb-3 position-relative">
          <label for="password" class="form-label"><i class="fa-solid fa-key"></i> Mật khẩu</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            placeholder="Nhập mật khẩu"
            required
          />
          
          <i class="fa-solid fa-eye toggle_icon_password" id="togglePassword"></i>
          
          
        </div>

        <!-- Thông báo khi nhập sai mật khẩu -->
        <?php
          if (isset($_SESSION['tb_wrong_password']) && $_SESSION['tb_wrong_password'] != "") {
            echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_wrong_password'] . '</div>';
            unset($_SESSION['tb_wrong_password']);
          }
        ?>

        <!-- Chuyển qua quên mật khẩu -->
        <div class="text-end ml-5 mt-2">
          <a href="index.php?pg=login_forgot" class="font-weight-bold text-decoration-none cl"><i class="fa-solid fa-user-lock"></i> Quên Mật Khẩu</a>
        </div>

        <!-- Submit-->
        <div>
          <input type="submit" name="dangnhap" value="Đăng Nhập" class="btn btn-success" />
        </div>

        
        <?php
          if (isset($_SESSION['tb_wrong_account_or_password']) && $_SESSION['tb_wrong_account_or_password'] != "") {
            echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_wrong_account_or_password'] . '</div>';
            unset($_SESSION['tb_wrong_account_or_password']);
          }
        ?>
      </form>
    </div>

    <!-- Bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- login.js -->
    <script src="layout/js/login.js"></script>

  </body>
</html>
