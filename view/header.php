<?php 
  if(isset($_SESSION['s_user']) && count($_SESSION['s_user']) >0 )
  {
    extract($_SESSION['s_user']);
    $html_account = '<div class="me-2">
                      <i class="bi bi-person-circle fs-3"></i>
                    </div>
                    <div class="d-flex align-items-center">
                      <a href="index.php?pg=user_account" class="text-decoration-none fw-bold gap-1 zoom_up">'.$name. '</a>
                    </div>';           
  } 
  else
  {
    $html_account = '<div class="me-2">
                      <i class="bi bi-person-circle fs-3"></i>
                    </div>
                    <div class="d-flex align-items-center">
                      <a href="index.php?pg=dangnhap" class="text-decoration-none gap-1 fw-bold">Đăng Nhập</a>
                    </div>';
  }

  if(isset($_SESSION['s_user'])){
    $userId = $_SESSION['s_user']['id'];
    $userCart = isset($_SESSION['cart'][$userId]) ? $_SESSION['cart'][$userId] : [];
  }

  
  if (isset($_SESSION['s_user'])) {
    $user_id = $_SESSION['s_user']['id'];
    
    $bills = getBillsByUserId($user_id); // Gọi lại hàm để lấy đơn hàng

    $favorites = count_favorite_by_user_id($user_id);

    $notifications = get_total_notifications($user_id);
  } else {
    $bills = []; // Nếu chưa đăng nhập thì danh sách đơn trống
    $favorites = 0;
    
    $notifications = 0;
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>T Coffee & Tea</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Favicon -->
    <link rel="icon" href="layout/Img/ZRvS2r9P.ico" type="image/x-icon" />
    <!-- Link css -->
    <link rel="stylesheet" href="layout/css/index.css" />
    <!-- Thư viện AOS(Animate on scroll) -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  </head>

  <body>
    <!-- Header-->
    <section class="myheader" data-aos="fade-down" data-aos-duration="1000">
      <div class="container">
        <div class="row align-items-center flex-wrap text-center text-md-start">

          <!-- 1. Logo -->
          <div class="col-12 col-sm-12 col-md-2 col-lg-1 mb-3 mb-md-0">
            <img
              src="layout/Img/Logo-removebg-preview.png"
              class="img-fluid zoom_up"
              alt="Logo"
            />
          </div>
          
          <!-- 2. Searching Bar -->
          <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3 mb-md-0">
            <form action="index.php?pg=menu" method="post">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  name="kyw"
                  placeholder="Tìm kiếm sản phẩm ..."
                  aria-label="Search here..."
                />
                <button class="btn btn-outline-secondary" type="submit" name="timkiem">
                  <i class="fa-solid fa-magnifying-glass zoom_up"></i>
                </button>
              </div>
            </form>
          </div>

          <!-- Hotline and Login -->
          <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3 mb-md-0">
            <div class="row d-flex justify-content-center justify-content-md-start">
              <div class="col-6 col-sm-6 col-md-auto mt-2">
                <a href="tel:999999" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                  <i class="bi bi-telephone fs-3"></i>
                  <p class="mb-0">Hotline 999999</p>
                </a>
              </div>
              <div class="col-12 col-sm-6 col-md-auto mt-2">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                  <?=$html_account;?>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Notification -->
          <div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
            <div class="row justify-content-center justify-content-lg-end">

            <!-- Xem thông báo -->
              <div class="col-auto mt-2 zoom_up">
                <a href="index.php?pg=notification" class="position-relative text-primary fw-bold">
                  <i class="bi bi-bell fs-2"></i>
                  <?php if(isset($notifications)):?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      <?=$notifications;?>
                    </span>
                  <?php else: ?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      0
                    </span>
                  <?php endif;?>
                </a>
              </div>

              <!-- Xem đơn hàng -->
              <div class="col-auto mt-2 zoom_up">
                <a href="index.php?pg=order" class="position-relative text-success fw-bold">
                  <!-- <i class="fa-solid fa-truck-fast fa-2x"></i> -->
                  <i class="bi bi-truck fs-2"></i>
                  <?php if(isset($bills)):?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      <?=count($bills);?>
                    </span>
                  <?php else: ?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      0
                    </span>
                  <?php endif;?>
                </a>
              </div>


              <!-- Xem giỏ hàng -->
              <div class="col-auto mt-2 zoom_up">
                <a href="index.php?pg=viewshoppingcart"  class="position-relative">
                  <!-- <i class="fa-solid fa-cart-shopping fa-2x text-warning"></i> -->
                  <i class="bi bi-cart fs-2 text-warning"></i>
                  <?php if(isset($userCart)):?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      <?=count($userCart);?>
                    </span>
                  <?php else: ?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      0
                    </span>
                  <?php endif;?>
                </a>
              </div>

              <!-- Xem sản phẩm yêu thích -->
              <div class="col-auto mt-2 zoom_up">
                <a href="index.php?pg=favorite_product" class="position-relative text-danger">
                <!-- <i class="fa-solid fa-heart fa-2x"></i> -->
                <i class="bi bi-bag-heart fs-2 text-danger"></i>
                <?php if(isset($favorites)):?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      <?=$favorites;?>
                    </span>
                  <?php else: ?>
                    <span style="top: -10px;" class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                      0
                    </span>
                  <?php endif;?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>