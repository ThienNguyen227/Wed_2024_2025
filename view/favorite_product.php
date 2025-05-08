<?php
  $html_product_fv = '';
  foreach ($favorites_pro as $pro_fv) 
  {
    extract($pro_fv);

    // Thêm kí hiệu bestseller
    if($bestseller==1)
    {
      $best_seller = '<div
                      class="position-absolute start-35 bg-danger text-white px-2 py-1 rounded"
                      style=" bottom: 173px; left: 10px; font-weight: bold; font-size: 14px;"
                      >
                      <i class="fa-solid fa-thumbs-up me-1"></i> BEST SELLER
                      </div>';
    }
    else{$best_seller = '';}
    
    $link = "index.php?pg=product_detail&id_product=".$id;

    $html_product_fv .='<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                          <div
                            class="card position-relative mb-4 radius_shadow_2"
                            style="width: 16rem max-height: 450px; overflow: hidden;"
                            data-aos="zoom-in"
                            data-aos-duration="3000"
                          > <a href="'.$link.'" class="text-dark text-decoration-none">
                              <img src="'.IMG_PATH_USER_PRODUCT.$img.'" class="card-img-top zoom_up" alt="'.$name.'" />
                              '.$best_seller.'
                              <div class="card-body">
                                <h5 class="card-title">'.$name.'</h5>
                                <p class="card-text ita">
                                '.$description.'
                                </p>
                              </div>
                            </a>
                          </div>
                        </div>';
  }





?>

<!-- Thanh NAVBAR -->
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
            <a class="nav-link dropdown-toggle active w" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <a class="nav-link w" href="index.php?pg=spdg"><i class="fa-solid fa-box"></i> Sản Phẩm Đóng Gói</a>
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

<!-- Phần Sản Phẩm Yêu Thích -->
<div class="container">
  <div class="row">

    <div class="col-12">
      <h4 class="text-center py-3 mt-2 mb-4 fav-title">SẢN PHẨM YÊU THÍCH CỦA BẠN</h4>
    </div>
    
    <?=$html_product_fv;?>

  </div>
</div>


