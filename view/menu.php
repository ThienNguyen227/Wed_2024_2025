<?php
  // Danh mục sản phẩm
  $html_categories='';
  // Icon(phẩn đầu danh mục)
  $html_title_icon='';
  $current_page_id = isset($_GET['product_categories_id']) ? $_GET['product_categories_id'] : ''; 
  foreach ($categories as $types) 
  {
    extract($types);
    $link = 'index.php?pg=menu&product_categories_id='.$id;
    $active_class = ($current_page_id == $id) ? 'active' : '';
    $html_categories.='<a
                        class="list-group-item list-group-item-action ' . $active_class . '"
                        href="'.$link.'"
                        ><i class="fa-solid '.$icon.'"></i> '.$name.'</a
                      >';
    // Icon(phẩn đầu danh mục)
    if($current_page_id == $id)
    {
      $html_title_icon.='<h3
                          class="label_pro mb-3"
                          data-aos="fade-left"
                          data-aos-duration="3000"
                        >
                          <i class="fa-solid '.$icon.'"></i> '.$name.'
                        </h3>';
    } elseif($current_page_id =='') 
    {
      $html_title_icon='<h3
                          class="label_pro mb-3"
                          data-aos="fade-left"
                          data-aos-duration="3000"
                        >
                          <i class="fa-solid fa-list"></i> ALL
                        </h3>';
    }
  }
  $html_list_product='';
  foreach ($list_product as $listpro) 
  {
    extract($listpro);
    if($bestseller == 1){
      $best_seller = '<div
                        class="position-absolute start-0 bg-danger text-white px-2 py-1 rounded-end"
                        style="font-weight: bold; font-size: 13px; transform: translateX(20px) translateY(-45px);"
                      >
                        <i class="fa-solid fa-thumbs-up me-1"></i> BEST SELLER
                      </div>';

    }else{
      $best_seller = '';
    }
    $link = "index.php?pg=product_detail&id_product=".$id;
    $html_list_product.=' <div class="col position-relative">
                            <a href="'.$link.'" class="text-dark text-decoration-none">
                              <img
                                src="'.IMG_PATH_USER_PRODUCT.$img.'"
                                class="adjust_pic_pro mb-2"
                                data-aos="zoom-in-up"
                                data-aos-duration="3000"
                              />
                              '.$best_seller.'
                              <h5>'.$name.'</h5>
                              <p>'.$price.' Đ</p>
                            </a>
                          </div>';
  }
  // Danh mục sản phẩm All
  if($current_page_id == ''){
    $active_class_menu = 'active';
  } else{
    $active_class_menu = '';
  }
  $html_categories_all = '<a
                            class="list-group-item list-group-item-action ' . $active_class_menu . '"
                            href="index.php?pg=menu"
                            ><i class="fa-solid fa-bars"></i> All</a
                          >';
?>


<!-- Thanh Navbar Menu -->
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
            class="nav-link dropdown-toggle w active"
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






<!-- ALl Menu -->
<section>
  <div class="container">
    <div class="row">
      <!-- List Menu -->
      <div class="col-12 col-md-3 col-lg-3">
        <div class="row">
          <div class="col">
            <div
              class="list-group"
              id="list-tab"
              role="tablist"
              data-aos="slide-up"
              data-aos-duration="3000"
            >
              <?=$html_categories_all;?>
              <!-- <a
                class="list-group-item list-group-item-action active"
                href="index.php?pg=menu"
                ><i class="fa-solid fa-bars"></i> All</a
              > -->
              <?=$html_categories;?>
              <!-- <a
                class="list-group-item list-group-item-action"
                href="index.php?pg=coffee"
                ><i class="fa-solid fa-mug-hot"></i> Coffee</a
              >
              <a
                class="list-group-item list-group-item-action"
                href="index.php?pg=tea"
                ><i class="fa-solid fa-leaf"></i> Tea</a
              >
              <a
                class="list-group-item list-group-item-action"
                href="index.php?pg=cake"
                ><i class="fa-solid fa-cookie"></i> Cake</a
              >
              <a
                class="list-group-item list-group-item-action"
                href="index.php?pg=ame"
                ><i class="fa-solid fa-glass-water"></i> A-Mê</a
              > -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-9 col-lg-9">
        <?=$html_title_icon;?>
        <!-- <h3
          class="label_pro mb-3"
          data-aos="fade-left"
          data-aos-duration="3000"
        >
          <i class="fa-solid fa-list"></i> ALL PRODUCT
        </h3> -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
          <?=$html_list_product;?>
          <!-- <div class="col">
            <img
              src="layout/Img/Coffe/CFD.png"
              class="adjust_pic_pro mb-2"
              data-aos="zoom-in-up"
              data-aos-duration="3000"
            />
            <h5>Cà Phê Đen</h5>
            <p>39.000 Đ</p>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</section>