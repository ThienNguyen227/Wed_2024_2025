<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Nhập Tài Khoản</title>
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
    <h3 class="text-center mb-5">
      <i class="fa-solid fa-key"></i> Xác minh OTP
    </h3>

    <form action="index.php?pg=confirmotp" method="post">
      <label for="otp"><i class="fa-solid fa-key"></i> Nhập mã OTP:</label>
      <input type="text" name="otp" id="otp" placeholder="Nhập mã OTP gồm 6 chữ số" required>

      <?php
        if (isset($_SESSION['tb_otp_error'])) {
          echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_otp_error'] . '</div>';
          unset($_SESSION['tb_otp_error']);
        }
      ?>

      <input type="submit" name="confirm_otp" value="Xác nhận">
    </form>

    <p style="text-align:center; margin-top: 10px;">
      <a href="index.php?pg=quenmatkhau" class="cl">Quay lại trang quên mật khẩu</a>
    </p>
  </div>
  <!-- bootstrap -->
  <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>
