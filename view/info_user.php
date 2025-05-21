<!-- Menu menu -->
<section
      class="bgg mb-1 sticky-navbar"
      data-aos="fade-down"
      data-aos-duration="3000"
    >
      <div class="container py-2">
        <div class="row">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a
                class="nav-link w"
                aria-current="page"
                href="index.php"
                ><i class="fa-solid fa-store"></i> Trang chủ</a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle w"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="fa-solid fa-list"></i> Menu
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="index.php?pg=menu&product_categories_id=1"
                    ><i class="fa-solid fa-mug-hot"></i> COFFEE</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?pg=menu&product_categories_id=2"
                    ><i class="fa-solid fa-leaf"></i> TEA</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?pg=menu&product_categories_id=3">
                    <i class="fa-solid fa-cookie"></i> CAKE</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?pg=menu&product_categories_id=4">
                    <i class="fa-solid fa-glass-water"></i> A-MÊ</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?pg=menu"
                    ><i class="fa-solid fa-list"></i> ALL</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link w" href="index.php?pg=spdg"
                ><i class="fa-solid fa-box"></i> Sản Phẩm Đóng Gói</a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle w"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="fa-solid fa-scroll"></i> Về Chúng Tôi
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="index.php?pg=gioithieucongty"
                    ><i class="fa-solid fa-building"></i> Giới Thiệu Công Ty</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?pg=lienhe"
                    ><i class="fa-solid fa-headset"></i> Liên Hệ</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?pg=tuyendung">
                    <i class="fa-solid fa-briefcase"></i> Tuyển Dụng</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link w nb" href="index.php?pg=khuyenmai"
                ><i class="fa-solid fa-gift"></i> Khuyến Mãi</a
              >
            </li>
          </ul>
        </div>
      </div>
</section>


<?php
  if(isset($_SESSION['s_user']) && count($_SESSION['s_user'])>0)
  {
    extract($_SESSION['s_user']);
  }
?>



<section>
  <div class="container">
    <div class="row">

      <!-- 1. List Danh Mục -->
      <div class="col-3">
        <div class="row">
          <div class="col">
            <div class="list-group" id="list-tab" role="tablist" data-aos="slide-up" data-aos-duration="3000">
              <a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center"
                href="index.php?pg=user_account">
                <span><i class="fa-solid fa-id-card"></i> Thông Tin Cá Nhân</span>
                <i class="fa-solid fa-caret-right"></i>
              </a>
              <a  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                href="index.php?pg=favorite_product">
                <span><i class="fa-solid fa-heart"></i> Sản Phấm Yêu Thích</span>
                <i class="fa-solid fa-caret-right"></i>
              </a>
              <a  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                href="index.php?pg=viewshoppingcart">
                <span><i class="fa-solid fa-cart-shopping"></i> Giỏ Hàng</span>
                <i class="fa-solid fa-caret-right"></i>
              </a>
              <a  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                href="index.php?pg=order">
                <span><i class="fa-solid fa-truck-fast"></i> Đơn Hàng</span>
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

      <!-- 2. Phần khung thông tin cá nhân -->
      <div class="col-9">

        <!-- Thông Tin Cá Nhân -->
        <h3
          class="label_pro mb-3"
          data-aos="fade-left"
          data-aos-duration="3000"
        >
          <i class="fa-solid fa-id-card"></i> Thông Tin Cá Nhân
        </h3>
        
        <!-- Khung Thông Tin Cá Nhân -->
        <div class="row border border-dark rounded-4 shadow-sm p-4 mb-4 bg-light">
          <form method="post" action="index.php?pg=user_update" class="row" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $_SESSION['s_user']['id'] ?>">
            <!-- Tên khách hàng -->
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label text-col-rgb_229_121_5"><strong><i class="bi bi-person-circle"></i> Tên khách hàng</strong></label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn ..." value="<?=$name;?>">
            </div>

            <!-- Số điện thoại -->
            <div class="col-md-6 mb-3">
              <label for="customerPhone" class="form-label text-col-rgb_229_121_5"><strong><i class="bi bi-telephone-fill"></i> Số điện thoại</strong></label>

              <input type="text" class="form-control" id="phone" name="phone" value="<?=$phone;?>">

              <!-- Thông báo khi không hợp lệ số điện thoại -->
              <?php
                if(isset($_SESSION['tb_phone_update']) && $_SESSION['tb_phone_update'] != "") {
                  echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_phone_update'] . '</div>';
                  unset($_SESSION['tb_phone_update']);
                }
              ?>
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
              <label for="customerEmail" class="form-label text-col-rgb_229_121_5"><strong> <i class="bi bi-envelope-fill"></i> Email</strong></label>
              <input type="email" class="form-control" id="email" name="email" value="<?=$email;?>">
              <!-- Thông báo khi không hợp lệ email -->
              <?php
                if(isset($_SESSION['tb_email_update']) && $_SESSION['tb_email_update'] != "") {
                  echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . $_SESSION['tb_email_update'] . '</div>';
                  unset($_SESSION['tb_email_update']);
                }
              ?>
            </div>

            <!-- Địa chỉ -->
            <div class="col-md-6 mb-3">
              <label for="customerAddress" class="form-label text-col-rgb_229_121_5"><strong> <i class="bi bi-geo-alt-fill"></i>Địa Chỉ</strong></label>
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
                echo '<div class="suc-message"><i class="fa-solid fa-circle-check"></i> ' . $_SESSION['tb_update_thanhcong'] . '</div>';
                unset($_SESSION['tb_update_thanhcong']);
              }
            ?>
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>

