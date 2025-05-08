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
      <img src="<?= IMG_PATH_USER_LOG . 'Logo-removebg-preview.png' ?>" alt="Logo" class="logo" />
      <h4 class="text-center mb-5">Quên Mật Khẩu <i class="fas fa-question-circle"></i></h4>

      <form action="index.php?pg=forgot" method="post">
        <!-- Email -->
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
          
          <!-- Check email khi không hợp lệ -->
          <?php
            if (isset($_SESSION['tb_invalid_email_5']) && $_SESSION['tb_invalid_email_5'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_email_5'] . '</div>';
              unset($_SESSION['tb_invalid_email_5']);
            }
          ?>
          <?php
            if (isset($_SESSION['tb_invalid_email_6']) && $_SESSION['tb_invalid_email_6'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_email_6'] . '</div>';
              unset($_SESSION['tb_invalid_email_6']);
            }
          ?>
          <?php
            if (isset($_SESSION['tb_invalid_email_7']) && $_SESSION['tb_invalid_email_7'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_email_7'] . '</div>';
              unset($_SESSION['tb_invalid_email_7']);
            }
          ?>
          <?php
            if (isset($_SESSION['tb_invalid_email_8']) && $_SESSION['tb_invalid_email_8'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_invalid_email_8'] . '</div>';
              unset($_SESSION['tb_invalid_email_8']);
            }
          ?>
          <!-- Check khi không trùng email trong db -->
          <?php
            if (isset($_SESSION['tb_email_exists_1']) && $_SESSION['tb_email_exists_1'] != "") {
              echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_email_exists_1'] . '</div>';
              unset($_SESSION['tb_email_exists_1']);
            }
          ?>
        </div>
        <div class="text-end ml-5">
          <a href="index.php?pg=dangnhap" class="font-weight-bold text-decoration-none cl"><i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập</a>
        </div>
        <!-- Submit Button -->
        <div>
          <input type="submit" name="quenmatkhau" value="Xác Nhận" class="btn btn-success" />
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
