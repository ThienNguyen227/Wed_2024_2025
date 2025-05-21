<?php
  // SẢN PHẨM MỚI
  $html_product_new = '';
foreach ($list_product_new as $pro_new) {
  extract($pro_new);
  $best_seller = $bestseller == 1
    ? '<div class="position-absolute bg-danger text-white px-2 py-1 rounded" style="bottom: 225px; left: 10px; font-weight: bold; font-size: 0.9rem;">
         <i class="fa-solid fa-thumbs-up me-1"></i> BEST SELLER
       </div>' : '';

  $link = "index.php?pg=product_detail&id_product=" . $id;
  $short_description = mb_strimwidth($description, 0, 180, "...");

  $html_product_new .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                          <div class="card radius_shadow_2 position-relative h-100 custom_card" data-aos="zoom-in" data-aos-duration="2000">
                            <a href="' . $link . '" class="text-dark text-decoration-none">
                              <img src="' . IMG_PATH_USER_PRODUCT . $img . '" class="card-img-top zoom_up" alt="' . htmlspecialchars($name) . '" />
                              ' . $best_seller . '
                              <div class="card-body">
                                <h5 class="card-title fw-bold">' . $name . '</h5>
                                <p class="card-text">' . $short_description . '</p>
                              </div>
                            </a>
                          </div>
                        </div>';
}

  // SẢN PHẨM BESTSELLER
  $html_product_bestseller = '';
foreach ($list_product_bestseller as $pro_bestseller) {
  extract($pro_bestseller);
  $link = "index.php?pg=product_detail&id_product=" . $id;
  $short_description = mb_strimwidth($description, 0, 95, "...");
  $html_product_bestseller .= '
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card radius_shadow_2 position-relative h-100 custom_card height_card" data-aos="zoom-in" data-aos-duration="2000">
        <a href="' . $link . '" class="text-dark text-decoration-none">
          <img src="' . IMG_PATH_USER_PRODUCT . $img . '" class="card-img-top zoom_up" alt="' . htmlspecialchars($name) . '" />
          <div
  class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end"
  style="font-weight: bold; font-size: 14px; z-index: 1;"
>
  <i class="fa-solid fa-thumbs-up me-1"></i> BEST SELLER
</div>
          <div class="card-body">
            <h5 class="card-title fw-bold">' . $name . '</h5>
            <p class="card-text">' . $short_description . '</p>
          </div>
        </a>
      </div>
    </div>';
}


  // News ad type product
  $html_ad_type_product = '';
extract($news_ad_type_product);
$html_ad_type_product = '
  <div class="col-12 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="2000">
    <a href="index.php?pg=menu&product_categories_id=' . $link_connected . '">
      <img src="' . IMG_PATH_USER_NEWS . $image . '" class="img-fluid radius_shadow_2 shadow-lg w-100 ad1 zoom_in" />
    </a>
  </div>';


  // News bannerhome
  $html_news_bannerhome = '';
  $html_carousel_indicators = '';
  $i = 0;
  foreach ($news_banner_home as $news_bh) {
    extract($news_bh);
    
    $active = ($i == 0) ? 'active' : '';
    $aria_current = ($i == 0) ? 'aria-current="true"' : '';
    $html_carousel_indicators .= '<button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="'.$i.'" class="'.$active.'" '.$aria_current.' aria-label="Slide '.($i+1).'"></button>';

    $html_news_bannerhome .= '<div class="carousel-item '.($i == 0 ? 'active' : '').'">
                                <img src="'.IMG_PATH_USER_NEWS.$image.'" class="d-block w-100" alt="Slide '.($i+1).'" />
                              </div>';
    $i++;
  }

  // News coffeeholic
  $html_news_coffeeholic = '';
  foreach ($news_coffeeholic as $news_c){
    extract($news_c);
    $html_news_coffeeholic .= ' <div class="col-12 col-md-6 col-lg-4 mb-4">
                      <div class="card h-100 shadow-sm">
                        <img src="'.IMG_PATH_USER_NEWS.$image.'" class="card-img-top img-fixed-height" data-aos="fade-right" data-aos-duration="3000" />
                        <div class="card-body d-flex flex-column">
                          <h6 class="card-title">'.$title.'</h6>
                          <p class="card-text">'.$content.'</p>
                        </div>
                      </div>
                    </div>';
  }

  // News teaholic
  $html_news_teaholic = '';
  foreach ($news_teaholic as $news_t) {
    extract($news_t);
    $html_news_teaholic .= ' <div class="col-12 col-md-6 col-lg-4 mb-4">
                      <div class="card h-100 shadow-sm">
                        <img src="'.IMG_PATH_USER_NEWS.$image.'" class="card-img-top img-fixed-height" data-aos="fade-right" data-aos-duration="3000" />
                        <div class="card-body d-flex flex-column">
                          <h6 class="card-title">'.$title.'</h6>
                          <p class="card-text">'.$content.'</p>
                        </div>
                      </div>
                    </div>';
  }
  // News sales
  $html_news_sales = '';
  foreach ($news_sales as $news_s){
    extract($news_s);
    $html_news_sales .= ' <div class="col-12 col-md-6 col-lg-4 mb-4">
                      <div class="card h-100 shadow-sm">
                        <img src="'.IMG_PATH_USER_NEWS.$image.'" class="card-img-top img-fixed-height" data-aos="fade-right" data-aos-duration="3000" />
                        <div class="card-body d-flex flex-column">
                          <h6 class="card-title">'.$title.'</h6>
                          <p class="card-text">'.$content.'</p>
                        </div>
                      </div>
                    </div>';
  }

  // News hình ảnh signature
  $html_news_signature_img = '';
  foreach ($news_signature_img as $nsi) {
    extract($nsi);
    $html_news_signature_img .= '<div class="carousel-item active" data-bs-interval="3000">
                                  <img
                                    src="'.IMG_PATH_USER_NEWS.$image.'"
                                    class="d-block w-100 zoom_up"
                                    alt="slide 1"
                                  />
                                </div>';
  }

  // News doc signature
  $html_news_signature_doc = '';
  extract($news_signature_doc);
  $html_news_signature_doc = '<strong
                                data-aos="zoom-in-up"
                                data-aos-duration="3000"
                                data-aos-easing="ease-in-out"
                                class="signature_size d-block text-center text-lg-start"
                              >
                                <i class="bi bi-bookmark-star"></i> '.$title.'
                              </strong>
                              <p
                                data-aos="zoom-in"
                                data-aos-duration="3000"
                                data-aos-easing="ease-in-out"
                                class="text-justify text-center text-lg-start px-2"
                              >
                                '.$content.'
                              </p>';

?>

<!-- Navbar Menu -->
<section class="bgg mb-1 sticky-navbar" data-aos="fade-down" data-aos-duration="1000">
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
            <a class="nav-link active w" href="index.php"><i class="fa-solid fa-store"></i> Trang chủ</a>
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


<!-- Body -->
<section>
  <!-- 1. Banner Home -->
  <div class="container-fluid" data-aos="zoom-in " data-aos-duration="3000">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      
      <!-- Các slide banner -->
      <div class="carousel-inner">
        <?=$html_news_bannerhome;?>
      </div>

      <!-- Nút bên dưới slide -->
      <div class="carousel-indicators">
        <?=$html_carousel_indicators;?>
      </div>

    </div>
  </div>
  
  <!-- 2. Sản phẩm bestseller, sản phẩm mới,... -->
  <div class="container mt-3">

    


    <!-- BEST SELLERS -->
    <h2 class="text-center text-col-rgb_229_121_5 mb-4 mt-3 fw-bold"><i class="fa-solid fa-thumbs-up me-1"></i> BEST SELLERS</h2>

    <div class="row mb-4 hf1 gx-3 gy-4">
      <!-- News loại sản phẩm -->
      <?= $html_ad_type_product; ?>

      <!-- DANH SÁCH SẢN PHẨM BESTSELLER -->
      <?= $html_product_bestseller; ?>
    </div>

    <!-- SẢN PHẨM MỚI -->
    <h2 class="text-center text-col-rgb_229_121_5 mb-4 mt-5 fw-bold"><i class="bi bi-fire"></i> SẢN PHẨM MỚI</h2>
    <div class="row mb-2 gx-3 gy-4">
      <?= $html_product_new; ?>
    </div>

    <!-- Quảng Cáo -->
    <div class="container mb-3">
      <div class="row">
        <div class="col">
          <img
            data-aos="fade-right"
            data-aos-duration="3000"
            data-aos-easing="ease-in-out"
            src="layout/Img/Bg1.png"
          />
        </div>
        <!-- ease: nhanh rồi chậm dần, linear: đều, ease-in-out: chậm đầu và cuối -->
        <div class="col">
          <div class="row mb-5">
            <img
              data-aos="fade-left"
              data-aos-duration="3000"
              data-aos-easing="ease-in-out"
              src="layout/Img/Bg2.png"
            />
          </div>
          <div class="row">
            <div class="d-grid mx-auto">
              <a href="index.php?pg=menu&product_categories_id=2" class="text-dark text-decoration-none">
                <button
                  data-aos="zoom-in"
                  data-aos-duration="3000"
                  data-aos-easing="ease-in-out"
                  class="btn gr w-100 d-block"
                  type="button"
                >
                  Trải Nghiệm Ngay
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container mb-3">
      <div class="row align-items-center">
        <!-- Text section -->
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
          <?=$html_news_signature_doc;?>
        </div>

        <!-- Carousel section -->
        <div class="col-12 col-lg-6">
          <div
            id="carouselExampleInterval"
            class="carousel slide"
            data-bs-ride="carousel"
            data-aos="flip-left"
            data-aos-duration="3000"
            data-aos-easing="ease-out"
          >
            <div class="carousel-inner rounded shadow">
              <?=$html_news_signature_img;?>
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleInterval"
              data-bs-slide="prev"
            >
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleInterval"
              data-bs-slide="next"
            >
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- News -->
<div class="container-fluid bg_news">
  <div class="container">

    <h3 class="text-center mb-2 pt-4 rgb_119_139_55">
      <strong><i class="bi bi-newspaper"></i> TIN TỨC & KHUYẾN MÃI</strong>
    </h3>

    <p class="text-center rgb_119_139_55">
      TIN TỨC & KHUYẾN MÃI CỦA T COFFEE
    </p>

    <!-- News Coffeholic -->
    <h5 class="bf mb-2">COFFEE_HOLIC</h5>
    <div class="row">
      <?=$html_news_coffeeholic;?>
    </div>

    <!-- News Teaholic -->
    <h5 class="bf mb-2">TEA_HOLIC</h5>
    <div class="row">
      <?=$html_news_teaholic;?>
    </div>
    
    <!-- News SALE-->
    <h5 class="bf mb-2">SALES</h5>
    <div class="row">
      <?=$html_news_sales;?>
    </div>
  </div>
</div>


