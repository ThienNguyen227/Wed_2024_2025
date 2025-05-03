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




<?php
  $html_categories='';
  $html_title_icon='';
  $current_page_id = isset($_GET['product_categories_id']) ? $_GET['product_categories_id'] : ''; 
  foreach ($categories as $types) {
    extract($types);
    $link = 'index.php?pg=menu&product_categories_id='.$id;
    $active_class = ($current_page_id == $id) ? 'active' : '';
    $html_categories.='<a
                        class="list-group-item list-group-item-action ' . $active_class . '"
                        href="'.$link.'"
                        ><i class="fa-solid '.$icon.'"></i> '.$name.'</a
                      >';

    if($current_page_id == $id){
      $html_title_icon.='<h3
                          class="label_pro mb-3"
                          data-aos="fade-left"
                          data-aos-duration="3000"
                        >
                          <i class="fa-solid '.$icon.'"></i> '.$name.'
                        </h3>';
    } elseif($current_page_id =='') {
      $html_title_icon='<h3
                          class="label_pro mb-3"
                          data-aos="fade-left"
                          data-aos-duration="3000"
                        >
                          <i class="fa-solid fa-list"></i> ALL
                        </h3>';
    }
  }
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

  
  // Sản phẩm liên quan
  $html_relative_product = '';
  foreach ($relative_product as $repro) {
    extract($repro);
    if($bestseller==1){
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
    $html_relative_product .= ' <div class="col position-relative">
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
  // Thông báo lỗi số lượng
  $error_quantity = '';
  if(isset($_SESSION['tb_invalid_quantity'])) 
  {
    $error_quantity = $_SESSION['tb_invalid_quantity'];
    unset($_SESSION['tb_invalid_quantity']);
  }

  $html_detail_product = ''; 
  extract($detail_product);
  $total_price = $price;
  $_SESSION['id_pro'] = $id;

  // Khởi tạo $is_favorite
  $is_favorite = false;
  if (isset($_SESSION['s_user'])) 
  {
    require_once "dao/product.php";
    $user_id = $_SESSION['s_user']['id'];
    $favorite = check_favorite($user_id, $id);
    $is_favorite = $favorite ? true : false;
  }

  $html_detail_product.= '<!-- Hình ảnh sản phẩm chi tiết -->
                          <div class="col-4">
                            <img
                            src="'.IMG_PATH_USER_PRODUCT.$img.'"
                            class="adjust_pic_pro mb-2 "
                            data-aos="zoom-in-up"
                            data-aos-duration="3000"
                            />
                          </div>
                          <!-- Tên, mô tả, giá, nút đặt hàng -->
                          <div class="col-8">
                            <h4
                              class="label_pro"
                              data-aos="fade-left"
                              data-aos-duration="3000"
                              >
                              '.$name.'
                            </h4>

                            <p class="ita">- '.$description.'</p>
                            <button class="btn btn-sm btn-light border-0 p-0 btn-favorite favorite-btn mb-3" data-product-id="'.$id.'">
                              <span class="favorite-label">- Sản phẩm yêu thích</span>
                              <i class="fa-solid fa-heart-circle-plus favorite-icon '.($is_favorite ? 'text-danger' : 'text-muted').'"></i>
                            </button>
                            
                            <p><strong>- Đơn giá: <span class="unit-price">'.$price.'</span> VNĐ</strong><p>

                            <form action="index.php?pg=addtocart" method="post">
                              <input type="hidden" name="name" value="'.$name.'"/>

                              <input type="hidden" name="img" value="'.$img.'"/>

                              <input type="hidden" name="price" value="'.$price.'"/>
                              
                              <div style="display: flex; align-items: center; gap: 10px;">

                                <strong class="mt-3">- Số lượng:</strong>
                                <div class="input-group" style="width: 120px; margin-top: 16px;">
                                  <button class="btn btn-outline-secondary hvsl" type="button" onclick="decreaseDetailQuantity()">−</button>

                                  <input type="text" name="soluong" class="form-control text-center quantity-input" value="1">
                                  
                                  <button class="btn btn-outline-secondary hvsl" type="button" onclick="increaseDetailQuantity()">+</button>
                                </div>
                                
                              </div>

                              <div class="mb-3">
                                <div class="error-message">' . $error_quantity . '</div>
                                <strong id="errorQ" style="color: red; font-size: 14px;"></strong>
                              </div>
                              <button class="ord d-block w-80 mt-2" 
                                      type="submit" 
                                      name="press-add" 
                                      id="hidden-quantity">
                                      <i class="fa-solid fa-cart-plus"></i> 
                                      Thêm Vào Giỏ Hàng: <span class="total-price">'.$total_price.'</span> VNĐ
                              </button>
                            </form>
                          </div>';
?>


<?php
  $id_product_1 = $id;
  $html_comments = '';
  foreach ($comments as $cmt) {
    extract($cmt);          
    $html_comments .= '
      <div class="mb-4 d-flex align-items-start">
        <!-- Avatar -->
        <div class="me-3 mt-3">
          <div class="bg-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
            <i class="fas fa-user text-secondary fs-5"></i>
          </div>
        </div>

        <div class="flex-grow-1">
          <!-- Dòng chứa nội dung bình luận và nút ba chấm -->
          <div class="d-flex justify-content-between align-items-start">
            <div class="comment-box pe-2">
              <strong class="text-col-rgb_229_121_5 d-block mb-1">@' . htmlspecialchars($user_name) . '</strong>
              <div class="text-dark" style="white-space: pre-wrap;">' . htmlspecialchars($content) . '</div>
            </div>';

      if (isset($_SESSION['s_user']) && $_SESSION['s_user']['id'] == $id_user) {
        $html_comments .= '
            <div class="dropdown">
              <button class="btn btn-sm text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <button class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#editCommentModal'.$id.'">
                    <i class="fas fa-pen-alt me-2"></i>Chỉnh sửa
                  </button>
                </li>
                <li>
                  <form action="index.php?pg=remove_comment" method="post">
                    <input type="hidden" name="id_comment" value="'.$id.'"/>
                    <input type="hidden" name="id_product" value="'.$id_product_1.'"/>
                    <button type="submit" name="removecomment" class="dropdown-item text-danger">
                      <i class="fas fa-trash-alt me-2"></i>Xóa
                    </button>
                  </form>
                </li>
              </ul>
            </div>';
      }

$html_comments .= '
    </div> <!-- End flex row -->

    <!-- Thời gian -->
    <small class="text-muted ms-1 mt-1 d-block">' . date("H:i d/m/Y", strtotime($created_at)) . '</small>

    <!-- Modal chỉnh sửa bình luận -->
    <div class="modal fade" id="editCommentModal'.$id.'" tabindex="-1" aria-labelledby="editCommentLabel'.$id.'" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form action="index.php?pg=update_comment" method="post" class="modal-content shadow rounded-4 border-0">
          <div class="modal-header bg-col-rgb_229_121_5">
            <h5 class="modal-title text-white" id="editCommentLabel'.$id.'">
              <i class="fas fa-pen-alt me-2"></i>Chỉnh sửa bình luận
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
          </div>

          <div class="modal-body">
            <input type="hidden" name="id_comment" value="'.$id.'">
            <input type="hidden" name="id_product" value="'.$id_product_1.'">
            <label for="commentContent'.$id.'" class="form-label text-col-rgb_229_121_5">
              <i class="fas fa-comment-dots me-1"></i> Nội dung mới:
            </label>
            <textarea name="content" id="commentContent'.$id.'" class="form-control rounded-3 border-warning" rows="4" required>'.htmlspecialchars($content).'</textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times me-1"></i> Hủy
            </button>
            <button type="submit" class="btn text-white bg-col-rgb_229_121_5 h" name="updatecomment">
              <i class="fas fa-circle-check me-1"></i> Lưu thay đổi
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>';


  }
?>






<!-- Phần các sản phẩm trong giỏ hàng -->

<section>
  <div class="container">
    <div class="row">

      <!-- 1. List Menu -->
      <div class="col-3 py-5">
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
              > -->
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Sản phẩm chi tiết -->
      <div class="col-9 py-5">
        <div class="row">
          <?=$html_detail_product;?>
        </div>

        <hr>

        <!-- Show bình luận về sản phẩm -->
        <?php if(!empty($html_comments)): ?>
          
          <h5 class="h55 mb-3"><i class="fa-solid fa-comments"></i> ý kiến của mọi  người về sản phẩm</h5>
          <div class="mt-4 comment-section">
            <?=$html_comments;?>
          </div>
        <?php else: ?>
          <p class="text-muted mt-4">Chưa có bình luận nào cho sản phẩm này.</p>
        <?php endif; ?>

        <hr>
        
        <!-- Bình Luận -->
        <div class="mt-3">
          <h5 class="h55"><i class="fa-solid fa-comment"></i> bình luận</h5>
          
          <form action="index.php?pg=comment_submit" method="post">

            <?php if (isset($_SESSION['s_user'])): ?>
              <input type="hidden" name="id_user" value="<?= $_SESSION['s_user']['id'] ?>">
            <?php endif; ?>

            <input type="hidden" name="id_product" value="<?=$id_product_1?>">

            <div class="mb-3">
              <textarea name="content" class="form-control" placeholder="Hãy viết những dòng cảm nghĩ của bạn về sản phẩm này ..." rows="3" required></textarea>
            </div>

            <div class="d-flex justify-content-end">
              <button type="submit" name="comment" class="btn bg-col-rgb_229_121_5">Gửi bình luận <i class="fa-solid fa-paper-plane"></i></button>
            </div>
          </form>
          
        </div>

        <hr>

        <!-- Sản phẩm liên quan -->
        <h3
          class="label_pro mb-3"
          data-aos="fade-left"
          data-aos-duration="3000"
        >
          <i class="fa-solid fa-list"></i> Sản Phẩm Liên Quan
        </h3>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
          <?=$html_relative_product;?>
        </div>
        
      </div>
    </div>
  </div>
</section>



