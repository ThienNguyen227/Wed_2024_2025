
<!-- Navbar Menu -->
<section class="bgg mb-1 sticky-navbar">
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
  if (isset($_SESSION['s_user'])) 
  {
    $userId = $_SESSION['s_user']['id'];
    $userCart = isset($_SESSION['cart'][$userId]) ? $_SESSION['cart'][$userId] : [];
  } 
  else 
  {
    $userCart = [];
  }

  //Load voucher
  $html_load_discounts = '';
  $load_discount = get_available_discounts_for_customer($userId);
  
  $j=1;
  foreach ($load_discount as $ld) {
    extract($ld);
    $html_load_discounts .= '<p>' .$j. ':<strong> ' . $code . '</strong> - Hạn sử dụng: ' . date('d/m/Y', strtotime($end_date)) . '</p>';
    $j++;
  }

  $cost_vc = 0;
  if(isset($_SESSION['voucher'])){
    extract($_SESSION['voucher']);
    $cost_vc = $_SESSION['voucher']['discount_percent'];
    $code_vc = $_SESSION['voucher']['code'];
  }
?>

<section class="bg_news py-3">
  <div class="container">
    <form action="index.php?pg=addtoorder" method="post">
      <div class="row">
        
        <div class="col-12 col-md-6 p-4 bg-white">
          <h2 class="mb-4 text-center text-color-gioithieu fs">
            <i class="fa-solid fa-truck-fast"></i> Giao Hàng
          </h2>

          <input type="hidden" class="form-control" name="id_self" value="<?=$_SESSION['s_user']['id'] ?>">
          <!-- Họ tên -->
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="fa-solid fa-user"></i> Họ và tên</label>
            <input type="text" class="form-control" name="name" value="<?=$_SESSION['s_user']['name'] ?>">
          </div>

          <!-- Số điện thoại -->
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="fa-solid fa-phone"></i> Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?=$_SESSION['s_user']['phone'] ?>">
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="fa-solid fa-envelope"></i> Email</label>
            <input type="text" class="form-control" name="email" value="<?=$_SESSION['s_user']['email'] ?>">
          </div>

          <!-- Địa chỉ -->
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="fa-solid fa-location-dot"></i> Địa chỉ giao hàng</label>
            <textarea class="form-control" name="address" rows="3" required></textarea>
          </div>

          <!-- Mã giảm giá -->
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="fa-solid fa-ticket"></i> Mã giảm giá</label>
            <button type="button" class="btn h bg-col-rgb_229_121_5" data-bs-toggle="modal" data-bs-target="#discountModal">Áp dụng ngay</button>
          </div>

          <?php if (isset($_SESSION['voucher'])): ?>
            <input type="hidden" name="code" value="<?=$code_vc?>">
          <?php endif; ?>

          <!-- Thông báo đã áp mã -->
          <?php if (isset($code_vc) && $code_vc > 0): ?>
            <p class="text-col-rgb_229_121_5 fw-bold"><i class="fa-solid fa-circle-right"></i> Đã áp dụng mã: <?= $code_vc ?> (Giảm <?= $cost_vc ?><?= $cost_vc < 100 ? '%' : 'VNĐ' ?>)</p>
          <?php endif; ?>

          
          <!-- Phương thức thanh toán -->
          <div class="mb-4">
            <label class="form-label fw-bold d-block"><i class="fa-solid fa-money-check-dollar"></i> Phương thức thanh toán</label>

            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="COD" checked>
              <label class="form-check-label"><i class="fa-solid fa-money-bill-wave"></i> Thanh toán khi nhận hàng</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="payment_method" value="Momo">
              <label class="form-check-label">
                <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="MoMo" style="width: 20px; height: 20px; margin-right: 6px;"> Ví MoMo
              </label>
            </div>

          </div>
        </div>
          

        <!-- Danh mục các sản phẩm trong giỏ hàng -->
        <div class="col-12 col-md-6 p-4 bg-white">
          <h2 class="mb-4 text-center text-color-gioithieu fs"><i class="fa-solid fa-basket-shopping"></i> Giỏ Hàng <?php if(isset($userCart)):?> 
                                                                          (<?=count($userCart);?>
                                                                        <?php endif; ?> Sản Phẩm)</h2>



          <?php if (!empty($userCart)): ?>   

            <div class="list-group comment-section">
              <?php
                $tongtien = 0;
                foreach ($userCart as $key => $item):
                  $thanhtien = $item['price'] * $item['soluong'];
                  $tongtien += $thanhtien;
              ?>
              
                <div class="list-group-item list-group-item-action mb-3 shadow-md rounded d-flex flex-column flex-md-row align-items-center gap-3 hv ">
                  <!-- Hình ảnh sản phẩm -->
                  <img src="<?= IMG_PATH_USER_PRODUCT.$item['img']?>" alt="<?=$item['name']?>" class="zoom_up" class="img-fluid" style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px;">
                  <div class="flex-grow-1 w-100">
                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
                      <h5 class="fw-bold mb-0"><?=$item['name']?></h5>
                      
                      <!-- Xóa sản phẩm -->
                      <form action="index.php?pg=removecart" method="post">
                        <input type="hidden" name="key" value="<?=$key?>">
                        <button 
                          type="button" 
                          class="btn btn-sm btn-outline-danger zoom_up" 
                          data-bs-toggle="modal" 
                          data-bs-target="#confirmDeleteModal" 
                          data-key="<?=$key?>">
                          <i class="fa-solid fa-trash-can"></i> Xóa
                        </button>
                      </form>

                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">

                      <p class="mb-1 text-danger"><i class="fa-solid fa-money-bill-wave"></i> Đơn giá: <?=number_format($item['price'], 0, ',', '.')?> VNĐ</p>

                      <!-- Nút Cập Nhật -->
                      <button type="button" class="btn btn-outline-primary zoom_up" onclick="showUpdateModal(<?=$key?>)">
                        <i class="fa-solid fa-pen"></i> Cập Nhật
                      </button>
                    </div>
                    
                    <p class="mb-1"><i class="fa-solid fa-chart-simple"></i> Số lượng: <?= $item['soluong'] ?></p>

                    <p class="mt-2 mb-0 fw-bold text-success"><i class="fa-solid fa-money-check-dollar"></i> Thành tiền: <?=number_format($thanhtien, 0, ',', '.') ?> VNĐ</p>

                  </div>
                </div>
                <!-- input hidden để lấy dữ liệu từ trang này addvtobill -->
                <input type="hidden" name="product_id[]" value="<?= $item['id'] ?>">
                <input type="hidden" name="product_name[]" value="<?= $item['name'] ?>">
                <input type="hidden" name="product_quantity[]" value="<?= $item['soluong'] ?>">
                <input type="hidden" name="product_price[]" value="<?= $item['price'] ?>">
                <input type="hidden" name="total_unit[]" value="<?=$thanhtien?>">
                

                <!-- Modal chỉnh sửa sản phẩm-->
                <div class="modal fade" id="updateModal_<?=$key?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3">
                      <!-- Header modal -->
                      <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-pen"></i> Cập Nhật Sản Phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                      </div>
                      <!-- Body modal -->
                      <form action="index.php?pg=updatecart" method="post">
                        <div class="modal-body">
                          
                          <div class="d-flex gap-3 align-items-center mb-2 flex-wrap">
                            <!-- Hình ảnh  -->
                            <img src="<?= IMG_PATH_USER_PRODUCT.$item['img']?>" alt="<?=$item['name']?>" style="width: 120px; height: 120px; object-fit: cover;" class="rounded mb-3">
                            
                            <div>
                              <!-- Tên -->
                              <h5 class="fw-bold mb-4"><?=$item['name']?></h5>
                              <!-- Đơn giá -->
                              <p class="mb-1 text-danger"><i class="fa-solid fa-money-bill-wave"></i> Đơn giá: <span class="unit-price"><?= number_format($item['price'], 0, ',', '.') ?>₫</span></p>
                              

                              <input type="hidden" name="key" value="<?=$key?>">
                              <div class="d-flex gap-4 align-items-center mb-2 flex-wrap">
                                <p class="mb-1"><i class="fa-solid fa-chart-simple"></i> Chọn số lượng: </p>
                                <div class="input-group mb-3" style="width: 120px; margin-top: 16px;">
                                  <button class="btn btn-outline-secondary hvsl" type="button" onclick="decreaseQuantity(<?=$key;?>)">−</button>

                                  <input type="text" name="soluong" id="quantity_<?=$key;?>" class="form-control text-center quantity-input" value="<?=$item['soluong'];?>">
                                  
                                  <button class="btn btn-outline-secondary hvsl" type="button" onclick="increaseQuantity(<?=$key;?>)">+</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <!-- Footer modal -->
                        <div class="modal-footer justify-content-center">
                          <button type="submit" name="update_cart" class="btn btn-success"><i class="fa-solid fa-check"></i> Lưu Thay Đổi <span class="total-price"><?=number_format($thanhtien, 0, ',', '.')?>₫</span></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              <?php endforeach; ?>
            </div>

            <!-- Tổng cộng -->
            <div class="mt-4 p-4 bg-light rounded text-end shadow-lg">
              <h4 class="text-success"><i class="fa-solid fa-receipt"></i> Tổng thanh toán: <?=number_format($tongtien - ($tongtien*$cost_vc/100), 0, ',', '.')?> VNĐ</h4>
              <input type="hidden" name="total" value="<?=$tongtien - ($tongtien*$cost_vc/100)?>">
              <div class="d-flex justify-content-between mt-3 flex-wrap">
                <a href="index.php?pg=menu" class="ord mb-4 none-outline"><i class="fa-solid fa-circle-left"></i> Tiếp tục mua hàng</a>
                <button type="submit" name="order" class="ord mb-4 none-outline"><i class="fa-solid fa-clipboard-check"></i> Đặt Hàng</button>
              </div>
            </div>
            
            
            <input type="hidden" name="product_id[]" value="<?= $item['id'] ?>">
            <input type="hidden" name="product_name[]" value="<?= $item['name'] ?>">
            <input type="hidden" name="product_price[]" value="<?= $item['price'] ?>">
            <input type="hidden" name="product_quantity[]" value="<?= $item['soluong'] ?>">
            <input type="hidden" name="total_unit[]" value="<?=$thanhtien?>">

          <?php else: ?>

            <div class="alert alert-info text-center fw-bold">Giỏ hàng của bạn đang trống.</div>
            <div class="text-center">
              <a href="index.php?pg=menu" class="btn ord"><i class="fa-solid fa-hand-pointer"></i> Mua sắm ngay</a>
            </div>

          <?php endif; ?>

        </div>
      </div>
    </form>
    
    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
          </div>
          
          <div class="modal-body">
            Bạn có chắc chắn muốn xóa sản phẩm này ra khỏi giỏ hàng không?
          </div>
          
          <div class="modal-footer">
            <form action="index.php?pg=removecart" method="post">
              <input type="hidden" name="key" id="deleteKeyInput">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
              <button type="submit" name="remove_cart" class="btn btn-danger">Xóa</button>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    

    <!-- Modal áp mã giảm giá-->
    <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header bg-col-rgb_229_121_5">
            <h5 class="modal-title" id="discountModalLabel">
              <i class="fa-solid fa-tags"></i> Nhập mã giảm giá
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form id="discountForm" action="index.php?pg=add_voucher" method="POST">

            <div class="modal-body">
              <div class="mb-3">
                <label for="discountCode" class="form-label text-col-rgb_229_121_5"><i class="fa-brands fa-salesforce"></i> Mã giảm giá</label>
                <input type="text" class="form-control" id="discountCode" name="code" placeholder="Nhập mã giảm giá của bạn ...">
              </div>

              <!-- Thông báo khi không hợp lệ -->
              <?php if (isset($_SESSION['tb_invalid_code']) && $_SESSION['tb_invalid_code'] != ""): ?>
                <div class="error-message text-danger mb-3">
                  <i class="fa-solid fa-circle-exclamation"></i> <?= $_SESSION['tb_invalid_code']; ?>
                </div>
              <?php endif; ?>

              <!-- Load mã giảm giảm giá -->
              <div>
                <?=$html_load_discounts;?>
              </div>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fa-solid fa-xmark"></i> Hủy
              </button>

              <input type="hidden" name="id_u" value="<?=$userId?>">


              <button type="submit" name="voucher_add" class="btn h bg-col-rgb_229_121_5">
                <i class="fa-solid fa-check"></i> Áp dụng
              </button>

            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (isset($_SESSION['tb_invalid_code'])): ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('discountModal'));
        myModal.show();
    });
  </script>
  <?php unset($_SESSION['tb_invalid_code']); ?>
<?php endif; ?>

<?php
unset($_SESSION['show_modal']);
unset($_SESSION['voucher']);
?>