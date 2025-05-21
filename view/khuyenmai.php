
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
            <a class="nav-link active w nb" href="index.php?pg=khuyenmai"><i class="fa-solid fa-gift"></i> Khuyến Mãi</a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</section>

<?php 
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

  $html_news_sale_img = '';
  $html_news_sale_doc = '';
  foreach ($news_sales as $ns) {
    extract($ns);
    $html_news_sale_img .= '<div class="mb-3">
                            <img src="'.IMG_PATH_USER_NEWS.$image.'" class="adjust_pictures_news mb-2" data-aos="fade-right" data-aos-duration="3000" />
                          </div>';
    $html_news_sale_doc .= '<div class="mt-1 mb-4" data-aos="fade-up" data-aos-duration="1000">
                              <strong>'.$title.'</strong>
                              <p>
                                '.$content.'
                              </p>
                            </div>';
    
  }





?>


<!-- Khuyến Mãi -->
<section>
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

  <div class="container">
  <div class="row" style="min-height: 100%;">
    
    <!-- Cột 1: Hình ảnh khuyến mãi -->
    <div class="col-md-4 d-flex flex-column justify-content-start">
      <h5 class="bf mb-3 mt-3">KHUYẾN MÃI</h5>
      <?=$html_news_sale_img;?>
    </div>

    <!-- Cột 2: Nội dung khuyến mãi - căn giữa dọc -->
    <div class="col-md-4 d-flex flex-column justify-content-center">
      
      <?=$html_news_sale_doc;?>
      
    </div>

    <!-- Cột 3: Meaningful Holiday -->
    <div class="col-md-4">
      <h3 class="text-center mb-3 text-col-rgb_229_121_5" data-aos="zoom-in" data-aos-duration="3000">
        Meaningful Holiday
      </h3>
      <div id="carouselHoliday" class="carousel slide" data-bs-ride="carousel" data-aos="fade-left" data-aos-duration="3000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="layout/Img/khuyenmai/1.png" class="d-block w-100 bo-holiday" alt="Slide 1" height="300px" />
            <p class="mt-3 text-center ita">"Ngày lễ là dịp đặc biệt để..."</p>
          </div>
          <div class="carousel-item">
            <img src="layout/Img/khuyenmai/2.png" class="d-block w-100 bo-holiday" alt="Slide 2" height="300px" />
            <p class="mt-3 text-center ita">"Ngày lễ là thời điểm ý nghĩa..."</p>
          </div>
          <div class="carousel-item">
            <img src="layout/Img/khuyenmai/3.png" class="d-block w-100 bo-holiday" alt="Slide 3" height="300px" />
            <p class="mt-3 text-center ita">"Chúng mang lại cơ hội để..."</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


</section>