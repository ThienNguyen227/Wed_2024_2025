<?php
  // SẢN PHẨM MỚI
  $html_product_new = '';
  foreach ($list_product_new as $pro_new) 
  {
    extract($pro_new);
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
    else
    {
      $best_seller = '';
    }
    $link = "index.php?pg=product_detail&id_product=".$id;
    $html_product_new .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div
                              class="card radius_shadow_2 position-relative zoom_up"
                              style="width: 16rem"
                              data-aos="zoom-in"
                              data-aos-duration="3000"
                            > <a href="'.$link.'" class="text-dark text-decoration-none">
                                <img src="'.IMG_PATH_USER_PRODUCT.$img.'" class="card-img-top" alt="..." />
                                '.$best_seller.'
                                <div class="card-body">
                                  <h5 class="card-title">'.$name.'</h5>
                                  <p class="card-text">
                                    '.$description.'
                                  </p>
                                </div>
                              </a>
                            </div>
                          </div>';
  }
  // SẢN PHẨM BESTSELLER
  $html_product_bestseller = '';
  foreach ($list_product_bestseller as $pro_bestseller) 
  {
    extract($pro_bestseller);
    $link = "index.php?pg=product_detail&id_product=".$id;
    $html_product_bestseller.=' <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                  <div
                                    class="card radius_shadow_2 position-relative zoom_up"
                                    style="width: 16rem"
                                    data-aos="zoom-in"
                                    data-aos-duration="3000"
                                  >
                                    <a href="'.$link.'" class="text-dark text-decoration-none">
                                      <img src="'.IMG_PATH_USER_PRODUCT.$img.'" class="card-img-top" alt="..." />
                                      <!-- Add BEST SELLER -->
                                      <div
                                        class="position-absolute start-35 bg-danger text-white px-2 py-1 rounded"
                                        style=" bottom: 173px; left: 10px; font-weight: bold; font-size: 14px;"
                                      >
                                        <i class="fa-solid fa-thumbs-up me-1"></i> BEST SELLER
                                      </div>
                                      <div class="card-body">
                                        <h5 class="card-title">'.$name.'</h5>
                                        <p class="card-text">
                                          '.$description.'
                                        </p>
                                      </div>
                                    </a>
                                  </div>
                                </div>';
  
  }
?>
<!-- Navbar Menu -->
<!-- <section class="bgg mb-1 sticky-navbar" data-aos="fade-down" data-aos-duration="3000">
  <div class="container py-2">
    <div class="row">
      
        
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a
            class="nav-link active w"
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
</section> -->

<!-- Navbar Menu -->
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
  <!-- Slide Banner -->
  <div class="container-fluid" data-aos="zoom-in " data-aos-duration="3000">
    <div
      id="carouselExampleSlidesOnly"
      class="carousel slide"
      data-bs-ride="carousel"
    >
      <div class="carousel-inner">
        <div class="carousel-item active zoom_up">
          <img src="layout/Img/Slide1.png" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item zoom_up">
          <img src="layout/Img/Slide2.png" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item zoom_up">
          <img src="layout/Img/Slide3.png" class="d-block w-100" alt="..." />
        </div>
      </div>
    </div>
  </div>
  
  <div class="container mt-3">
    
    <div class="row hf1 mb-4">
      <h2 class="text-center mb-2">BEST SELLERS</h2>
      <div data-aos="fade-right" data-aos-duration="3000" class="col-12 col-sm-12 col-md-4 col-lg-6">
        <a href="index.php?pg=menu&product_categories_id=4"><img src="layout/Img/Ad1.png" class="ad1 zoom_up img-fluid"/></a>
      </div>
      <!-- DANH SÁCH SẢN PHẨM BESTSELLER -->
      <?=$html_product_bestseller;?>
    </div>

    <!-- DANH SÁCH SẢN PHẨM MỚI -->
    
    <div class="row mb-2">
      <div class="col-12 mt-5">
        <h3 class="text-center py-3 mt-2 mb-4">SẢN PHẨM MỚI</h3>
      </div>
      <?=$html_product_new;?>
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
    <!-- Facing -->
    <!-- <div class="container mb-3">
      <div class="row">
        
        <div class="col">
          <strong
            data-aos="zoom-in-up"
            data-aos-duration="3000"
            data-aos-easing="ease-in-out"
            class="signature_size"
            >SIGNATURE BY T
          </strong>
          <p
            data-aos="zoom-in"
            data-aos-duration="3000"
            data-aos-easing="ease-in-out"
            class="text-left"
          >
            Không chỉ là một loại đồ uống đặc trưng, mà còn là dấu ấn riêng,
            là linh hồn tạo nên sự khác biệt và khiến khách hàng nhớ mãi. Đó
            có thể là một ly cà phê đậm đà với hương thơm quyến rũ, một loại
            trà sáng tạo mang vị thanh mát, hay thậm chí là một món nước thủ
            công được pha chế từ những nguyên liệu đặc biệt, chỉ có tại
            quán. Nhưng hơn cả hương vị, signature còn là cảm giác mà nó
            mang lại. Khi khách hàng nhấp một ngụm, họ không chỉ thưởng thức
            hương vị, mà còn cảm nhận được cái "chất" riêng của quán – thứ
            khiến họ muốn quay lại, để tìm lại hương vị đặc trưng không thể
            tìm thấy ở bất kỳ nơi nào khác.
          </p>
        </div>

        
        <div class="col">
          <div
            id="carouselExampleInterval"
            class="carousel slide"
            data-bs-ride="carousel"
            data-aos="flip-left"
            data-aos-duration="3000"
            data-aos-easing="ease-out"
          >
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="3000">
                <img
                  src="layout/Img/s1.png"
                  class="d-block w-100 zoom_up"
                  alt="..."
                />
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img
                  src="layout/Img/s2.png"
                  class="d-block w-100 zoom_up"
                  alt="..."
                />
              </div>
              <div class="carousel-item">
                <img
                  src="layout/Img/s3.png"
                  class="d-block w-100 zoom_up"
                  alt="..."
                />
              </div>
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleInterval"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleInterval"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div> -->
    <div class="container mb-3">
      <div class="row align-items-center">
        <!-- Text section -->
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
          <strong
            data-aos="zoom-in-up"
            data-aos-duration="3000"
            data-aos-easing="ease-in-out"
            class="signature_size d-block text-center text-lg-start"
          >
            SIGNATURE BY T
          </strong>
          <p
            data-aos="zoom-in"
            data-aos-duration="3000"
            data-aos-easing="ease-in-out"
            class="text-justify text-center text-lg-start px-2"
          >
            Không chỉ là một loại đồ uống đặc trưng, mà còn là dấu ấn riêng,
            là linh hồn tạo nên sự khác biệt và khiến khách hàng nhớ mãi. Đó
            có thể là một ly cà phê đậm đà với hương thơm quyến rũ, một loại
            trà sáng tạo mang vị thanh mát, hay thậm chí là một món nước thủ
            công được pha chế từ những nguyên liệu đặc biệt, chỉ có tại
            quán. Nhưng hơn cả hương vị, signature còn là cảm giác mà nó
            mang lại. Khi khách hàng nhấp một ngụm, họ không chỉ thưởng thức
            hương vị, mà còn cảm nhận được cái "chất" riêng của quán – thứ
            khiến họ muốn quay lại, để tìm lại hương vị đặc trưng không thể
            tìm thấy ở bất kỳ nơi nào khác.
          </p>
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
              <div class="carousel-item active" data-bs-interval="3000">
                <img
                  src="layout/Img/s1.png"
                  class="d-block w-100 zoom_up"
                  alt="slide 1"
                />
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img
                  src="layout/Img/s2.png"
                  class="d-block w-100 zoom_up"
                  alt="slide 2"
                />
              </div>
              <div class="carousel-item">
                <img
                  src="layout/Img/s3.png"
                  class="d-block w-100 zoom_up"
                  alt="slide 3"
                />
              </div>
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
<!-- <div class="container-fluid bg_news">
  <div class="container">
    <h3 class="text-center mb-2 pt-4 rgb_119_139_55">
      <strong>TIN TỨC & KHUYẾN MÃI</strong>
    </h3>
    <p class="text-center rgb_119_139_55">
      TIN TỨC & KHUYẾN MÃI CỦA T COFFEE
    </p>
    
    <h5 class="bf mb-2">COFFEE_HOLIC</h5>
    <div class="row">
      <div class="col">
        <img
          src="layout/Img/cfholic1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-right"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          BẮT GẶP SÀI GÒN XƯA TRONG MUỐN UỐNG HIỆN ĐẠI CỦA GIỚI TRẺ
        </h6>
        <p class="adjust_text_news">
          Dẫu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại
          những dấu ấn thăng trầm của một Sài Gòn xưa cũ. Trên những góc
          phố,...
        </p>
      </div>
      <div class="col">
        <img
          src="layout/Img/cfholic2.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-down"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          CHỈ CHỌN CÀ PHÊ MỖI SÁNG NHƯNG CŨNG KHIẾN CUỘC SỐNG CỦA BẠN THÊM
          THÚ VỊ, TẠI SAO KHÔNG?
        </h6>
        <p class="adjust_text_news">
          Thực chất, bạn không nhất thiết phải làm gì to tát để tạo nên một
          ngày rực rỡ. Chỉ cần bắt đầu từ những việc nhỏ nhặt nhất, khi
          bạn...
        </p>
      </div>
      <div class="col">
        <img
          src="layout/Img/cfhoclic3.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-left"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          SIGNATURE - BIỂU TƯỢNG VĂN HOÁ CÀ PHÊ CỦA THE COFFEE HOUSE ĐÃ QUAY
          TRỞ LẠI
        </h6>
        <p class="adjust_text_news">
          Mới đây, các "tín đồ" cà phê đang bàn tán xôn xao về SIGNATURE -
          Biểu tượng văn hóa cà phê của The Coffee House đã quay trở lại.Một
          lời...
        </p>
      </div>
    </div>
    
    <h5 class="bf mb-2">TEA_HOLIC</h5>
    <div class="row">
      <div class="col">
        <img
          src="layout/Img/teaholic1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-right"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          “KHUẤY ĐỂ THẤY TRĂNG" - KHUẤY LÊN NIỀM HẠNH PHÚC: TRẢI NGHIỆM
          KHÔNG THỂ BỎ LỠ MÙA TRUNG THU NÀY
        </h6>
        <p class="adjust_text_news">
          Năm 2024 là năm đề cao sức khỏe tinh thần nên giới trẻ muốn tận
          hưởng một Trung thu với nhiều trải nghiệm mới mẻ, rôm rả cùng bạn
          bè...
        </p>
      </div>
      <div class="col">
        <img
          src="layout/Img/teaholic2.png"
          class="adjust_pictures_news mb-1"
          data-aos="zoom-in"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          BỘ SƯU TẬP CẦU TOÀN KÈO THƠM: "VÍA" MAY MẮN KHÔNG THỂ BỎ LỠ TẾT
          NÀY
        </h6>
        <p class="adjust_text_news">
          Tết nay vẫn giống Tết xưa, không hề mai một nét văn hoá truyền
          thống mà còn thêm vào những hoạt động “xin vía” hiện đại, trẻ
          trung. Ví như...
        </p>
      </div>
      <div class="col">
        <img
          src="layout/Img/teaholic3.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-left"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          TRUNG THU NÀY, SAO BẠN KHÔNG TỰ CHO MÌNH "DỪNG MỘT CHÚT THÔI,
          THƯỞNG MỘT CHÚT TRÔI"?
        </h6>
        <p class="adjust_text_news">
          Bạn có từng nghe: “Trung thu thôi mà, có gì đâu mà chơi”, hay
          “Trung thu càng ngày càng chán”...? Sự bận rộn đến mức “điên rồ”
          đã khiến chúng...
        </p>
      </div>
    </div>
   
    <h5 class="bf mb-2">SALES</h5>
    <div class="row">
      <div class="col">
        <img
          src="layout/Img/TT1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-right"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">VALENTINE'S DAY</h6>
        <p class="adjust_text_news">
          Chào đón ngày lễ tình nhân với ưu đãi ngọt ngào nhất! Nhân dịp
          Valentine's Day, chúng tôi mang đến cho bạn SALE UP TO 50% – Cơ
          hội hoàn hảo để chọn quà cho người ấy hoặc tự thưởng cho bản thân!
        </p>
      </div>
      <div class="col">
        <img
          src="layout/Img/sale1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-up"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">BIG SALE</h6>
        <p class="adjust_text_news">
          Cơ hội mua sắm cực đỉnh với mức giá không thể tốt hơn! Hàng loạt
          sản phẩm chất lượng cao đang được giảm giá lên đến 50%. Đừng bỏ lỡ
          cơ hội sở hữu những món đồ yêu thích với giá cực hời!
        </p>
      </div>
      <div class="col">
        <img
          src="layout/Img/sale2.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-left"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">UP TO 50% OFF</h6>
        <p class="adjust_text_news">
          Giảm giá cực sốc, cơ hội mua sắm giá hời! Nhanh tay kẻo lỡ!
        </p>
      </div>
    </div>
  </div>
</div> -->

<div class="container-fluid bg_news">
  <div class="container">
    <h3 class="text-center mb-2 pt-4 rgb_119_139_55">
      <strong>TIN TỨC & KHUYẾN MÃI</strong>
    </h3>
    <p class="text-center rgb_119_139_55">
      TIN TỨC & KHUYẾN MÃI CỦA T COFFEE
    </p>
    <!-- Coffeholic -->
    <h5 class="bf mb-2">COFFEE_HOLIC</h5>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/cfholic1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-right"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          BẮT GẶP SÀI GÒN XƯA TRONG MUỐN UỐNG HIỆN ĐẠI CỦA GIỚI TRẺ
        </h6>
        <p class="adjust_text_news">
          Dẫu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại
          những dấu ấn thăng trầm của một Sài Gòn xưa cũ. Trên những góc
          phố,...
        </p>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/cfholic2.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-down"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          CHỈ CHỌN CÀ PHÊ MỖI SÁNG NHƯNG CŨNG KHIẾN CUỘC SỐNG CỦA BẠN THÊM
          THÚ VỊ, TẠI SAO KHÔNG?
        </h6>
        <p class="adjust_text_news">
          Thực chất, bạn không nhất thiết phải làm gì to tát để tạo nên một
          ngày rực rỡ. Chỉ cần bắt đầu từ những việc nhỏ nhặt nhất, khi
          bạn...
        </p>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/cfhoclic3.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-left"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          SIGNATURE - BIỂU TƯỢNG VĂN HOÁ CÀ PHÊ CỦA THE COFFEE HOUSE ĐÃ QUAY
          TRỞ LẠI
        </h6>
        <p class="adjust_text_news">
          Mới đây, các "tín đồ" cà phê đang bàn tán xôn xao về SIGNATURE - 
          Biểu tượng văn hóa cà phê của The Coffee House đã quay trở lại. Một lời...
        </p>
      </div>
    </div>
    <!-- Teaholic -->
    <h5 class="bf mb-2">TEA_HOLIC</h5>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/teaholic1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-right"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          “KHUẤY ĐỂ THẤY TRĂNG" - KHUẤY LÊN NIỀM HẠNH PHÚC: TRẢI NGHIỆM
          KHÔNG THỂ BỎ LỠ MÙA TRUNG THU NÀY
        </h6>
        <p class="adjust_text_news">
          Năm 2024 là năm đề cao sức khỏe tinh thần nên giới trẻ muốn tận
          hưởng một Trung thu với nhiều trải nghiệm mới mẻ, rôm rả cùng bạn
          bè...
        </p>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/teaholic2.png"
          class="adjust_pictures_news mb-1"
          data-aos="zoom-in"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          BỘ SƯU TẬP CẦU TOÀN KÈO THƠM: "VÍA" MAY MẮN KHÔNG THỂ BỎ LỠ TẾT
          NÀY
        </h6>
        <p class="adjust_text_news">
          Tết nay vẫn giống Tết xưa, không hề mai một nét văn hoá truyền
          thống mà còn thêm vào những hoạt động “xin vía” hiện đại, trẻ
          trung. Ví như...
        </p>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/teaholic3.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-left"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">
          TRUNG THU NÀY, SAO BẠN KHÔNG TỰ CHO MÌNH "DỪNG MỘT CHÚT THÔI,
          THƯỞNG MỘT CHÚT TRÔI"?
        </h6>
        <p class="adjust_text_news">
          Bạn có từng nghe: “Trung thu thôi mà, có gì đâu mà chơi”, hay
          “Trung thu càng ngày càng chán”...? Sự bận rộn đến mức “điên rồ” 
          đã khiến chúng...
        </p>
      </div>
    </div>
    <!-- SALE-->
    <h5 class="bf mb-2">SALES</h5>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/TT1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-right"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">VALENTINE'S DAY</h6>
        <p class="adjust_text_news">
          Chào đón ngày lễ tình nhân với ưu đãi ngọt ngào nhất! Nhân dịp
          Valentine's Day, chúng tôi mang đến cho bạn SALE UP TO 50% – Cơ
          hội hoàn hảo để chọn quà cho người ấy hoặc tự thưởng cho bản thân!
        </p>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/sale1.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-up"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">BIG SALE</h6>
        <p class="adjust_text_news">
          Cơ hội mua sắm cực đỉnh với mức giá không thể tốt hơn! Hàng loạt
          sản phẩm chất lượng cao đang được giảm giá lên đến 50%. Đừng bỏ lỡ
          cơ hội sở hữu những món đồ yêu thích với giá cực hời!
        </p>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <img
          src="layout/Img/sale2.png"
          class="adjust_pictures_news mb-1"
          data-aos="fade-left"
          data-aos-duration="3000"
        />
        <h6 class="adjust_text_news">UP TO 50% OFF</h6>
        <p class="adjust_text_news">
          Giảm giá cực sốc, cơ hội mua sắm giá hời! Nhanh tay kẻo lỡ!
        </p>
      </div>
    </div>
  </div>
</div>


