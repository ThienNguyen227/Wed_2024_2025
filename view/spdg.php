<!-- Menu -->
<!-- <section
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
              <a class="nav-link active w" href="index.php?pg=spdg"
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
</section> -->
<?php 
  $html_packed_product = '';
  foreach ($packed_products as $pp) {
    extract($pp);
    $link = "index.php?pg=product_detail&id_product=".$id;
    $html_packed_product .='<div class="col">
                              <a href="'.$link.'" class="text-dark text-decoration-none">
                                <img
                                  src="'.IMG_PATH_USER_PRODUCT.$img.'"
                                  class="adjust_pic_pro mb-2"
                                  data-aos="zoom-in-up"
                                  data-aos-duration="3000"
                                />
                                <h5>'.$name.'</h5>
                                <p>'.number_format($price).'</p>
                              </a>
                            </div>';
  }



?>

<section class="bgg mb-1 sticky-navbar" data-aos="fade-down" data-aos-duration="3000">
  <div class="container py-2">
    
    <!-- Toggle Button -->
    <div class="d-flex justify-content-end d-lg-none mb-2">
      <button class="btn btn-dark ms-0 me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#customNav" aria-expanded="false" aria-controls="customNav">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>

    <!-- Responsive Nav -->
    <div class="row">
      <div class="collapse d-lg-block" id="customNav">
        <ul class="nav flex-column flex-lg-row align-items-start align-items-lg-center justify-content-lg-center">
          <li class="nav-item">
            <a class="nav-link w" href="index.php"><i class="fa-solid fa-store"></i> Trang chủ</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle w" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-list"></i> Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?pg=menu&product_categories_id=1"><i class="fa-solid fa-mug-hot"></i> COFFEE</a></li>
              <li><a class="dropdown-item" href="index.php?pg=menu&product_categories_id=2"><i class="fa-solid fa-leaf"></i> TEA</a></li>
              <li><a class="dropdown-item" href="index.php?pg=menu&product_categories_id=3"><i class="fa-solid fa-cookie"></i> CAKE</a></li>
              <li><a class="dropdown-item" href="index.php?pg=menu&product_categories_id=4"><i class="fa-solid fa-glass-water"></i> A-MÊ</a></li>
              <li><a class="dropdown-item" href="index.php?pg=menu"><i class="fa-solid fa-list"></i> ALL</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active w" href="index.php?pg=spdg"><i class="fa-solid fa-box"></i> Sản Phẩm Đóng Gói</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle w" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-scroll"></i> Về Chúng Tôi
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?pg=gioithieucongty"><i class="fa-solid fa-building"></i> Giới Thiệu Công Ty</a></li>
              <li><a class="dropdown-item" href="index.php?pg=lienhe"><i class="fa-solid fa-headset"></i> Liên Hệ</a></li>
              <li><a class="dropdown-item" href="index.php?pg=tuyendung"><i class="fa-solid fa-briefcase"></i> Tuyển Dụng</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link w nb" href="index.php?pg=khuyenmai"><i class="fa-solid fa-gift"></i> Khuyến Mãi</a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</section>


<!-- Sản phảm đóng gói -->
<section>
  <div class="container">
    <h3
      class="label_pro mb-3"
      data-aos="fade-left"
      data-aos-duration="3000"
    >
      <i class="fa-solid fa-leaf"></i> CÀ PHÊ TẠI NHÀ
    </h3>
    
    <div class="row">
      <?=$html_packed_product;?>
    </div>
  </div>
</section>