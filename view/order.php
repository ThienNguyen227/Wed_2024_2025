<!-- Navbar Menu -->
<!-- <section class="bgg mb-1 sticky-navbar" data-aos="fade-down" data-aos-duration="3000">
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
            class="nav-link dropdown-toggle active w"
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
  if (isset($_SESSION['s_user'])) {
    $user_id = $_SESSION['s_user']['id'];
    $bills = getBillsByUserId($user_id); 
  } else {
    $bills = []; 
  }
?>

<h2 class="mb-5 mt-3 text-center text-col-rgb_229_121_5 fw-bold fs-2">
  <i class="bi bi-bag-check-fill me-2"></i>Đơn Hàng 
  <span class="badge bg-danger"><?= count($bills)?> Đơn</span>
</h2>


<!-- Thông báo khi thanh toán thành công hay thất bại -->
<?php 
  if (isset($_SESSION['tb_payment_success'])){
    echo '<div class="alert alert-success text-center" role="alert">'.$_SESSION['tb_payment_success'].'</div>';
    unset($_SESSION['tb_payment_success']);
  }
  if (isset($_SESSION['tb_payment_failed'])){
    echo '<div class="alert alert-danger text-center" role="alert">'.$_SESSION['tb_payment_failed'].'</div>';
    unset($_SESSION['tb_payment_failed']);
  }
?>

<div class="table-responsive">
  <table class="table table-striped table-hover table-borderless shadow-lg rounded bg-light">
    <thead class="text-center custom-thead align-middle">
      <tr>
        <th><i class="fa-solid fa-barcode"></i> Mã Đơn Hàng</th>
        <th><i class="fa-solid fa-boxes-packing"></i> Sản Phẩm</th>
        <th><i class="fa-solid fa-receipt"></i> Tổng thanh toán</th>
        <th><i class="fa-solid fa-money-check-dollar"></i> Phương thức<br>thanh toán</th>
        <th><i class="fa-solid fa-clock"></i> Đặt lúc</th>
        <th><i class="fa-solid fa-bars-progress"></i> Trạng thái<br>đơn hàng</th>
        <th><i class="fa-solid fa-bars-progress"></i> Trạng thái<br>thanh toán</th>
        <th><i class="fa-solid fa-cog"></i> Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bills as $bill): ?>
        <tr class="text-center">

          <!-- 1. Cột Mã đơn hàng -->
          <td class="align-middle">#<?= $bill['bill_id'] ?></td>

          <!-- 2. Cột Hình ảnh số lượng minh họa -->
          <td>
            <?php 
              $products = getProductsByBillId($bill['bill_id']);
              foreach ($products as $product) 
              {
                echo '<div class="d-flex align-items-center mb-2">
                        <img src="'.IMG_PATH_USER_PRODUCT. $product['img'] . '" alt="' . $product['name'] . '" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                        ' . $product['name'] . ' <span class="text-muted">x' . $product['quantity'] . '</span>
                      </div>';

              }
            ?>
          </td>

          <!-- 3. Cột tổng giá -->
          <td class="align-middle"><strong class="text-danger"><?= number_format($product['total_price'], 0, ',', '.') ?> VND</strong></td>

          <!-- 4. Cột phương thức thanh toán -->
          <td class="align-middle">
            <span class="badge bg-success"><?= $bill['payment_method'] ?></span>
          </td>

          <!-- 5. Cột ngày tạo đơn hàng-->
          <td class="align-middle"><?= date('H:i d/m/Y', strtotime($bill['created_at'])) ?></td>

          <!-- 6. Cột trạng thái đơn hàng-->
          <td class="align-middle"> 
            <?php
              $statusText = [
                0 => ['Chờ xác nhận', 'warning'],
                1 => ['Đã xác nhận', 'primary'],
                2 => ['Đang giao', 'secondary'],
                3 => ['Đã giao', 'success'],
                4 => ['Đã hủy', 'danger'],
                5 => ['Đã hoàn trả', 'dark'],
              ];
              [$text, $color] = $statusText[$bill['status']];
              echo "<span class='badge bg-$color'>$text</span>";
            ?>
          </td>

          <!-- 7. Cột trạng thái thanh toán-->
          <td class="align-middle">
            <?= $bill['payment_status'] == 1 
              ? "<span class='badge bg-success'>Đã thanh toán</span>" 
              : "<span class='badge bg-danger'>Chưa thanh toán</span>" ?>
          </td>

          <!-- 8. Hành động -->
          <td class="align-middle">

            <!-- 8.1. Nút xem chi tiết -->
            <button type="button" class="btn btn-outline-info btn-sm mb-1 rounded-pill shadow-sm w-sm-auto" data-bs-toggle="modal" data-bs-target="#orderModal<?= $bill['bill_id'] ?>">
              <i class="fa-solid fa-eye"></i> Xem chi tiết
            </button>

            <!-- 8.2. Nút hủy khi đơn hàng ở trạng thái đang xác nhận -->
            <?php if ($bill['status'] == 0):?>

              <form action="index.php?pg=cancel_order" method="post" class="d-inline">
                <input type="hidden" name="bill_id" value="<?= $bill['bill_id'] ?>">

                <button type="submit" name="huy" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm w-sm-auto" onclick="return confirm('Bạn có chắc muốn hủy đơn này không?')">
                  <i class="fa-solid fa-trash-can"></i> Hủy
                </button>
              </form>

            <?php endif; ?>
          </td>
        </tr>
        <!-- Modal hiển thị chi tiết sản phẩm -->
        <div class="modal fade" id="orderModal<?= $bill['bill_id'] ?>" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-sm-down">
            <div class="modal-content shadow-lg rounded-3">
              <div class="modal-header bg-gradient">
                <h5 class="modal-title te" id="orderModalLabel"><i class="fa-solid fa-circle-info "></i> Chi tiết đơn hàng #<?= $bill['bill_id'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
              </div>
              <div class="modal-body">
                <!-- P1. Thông Tin Người Nhận -->
                <h5 class="text-col-rgb_229_121_5 mb-3"><i class="fa-solid fa-caret-right"></i> Thông tin người nhận</h5>

                <p><strong><i class="fa-solid fa-user-tie"></i> Tên người nhận: </strong> <?= $bill['receiver_name'] ?></p>
                <p><strong><i class="fa-solid fa-phone"></i> Số điện thoại: </strong> <?= $bill['receiver_phone'] ?></p>
                <p><strong><i class="fa-solid fa-envelope-circle-check"></i> Email: </strong> <?= $bill['receiver_email'] ?></p>
                <p><strong><i class="fa-solid fa-map-location-dot"></i> Địa chỉ giao hàng: </strong> <?= $bill['receiver_address'] ?></p>

                <hr>

                <!-- P2. Thông Tin Sản Phẩm -->
                <h5 class="text-col-rgb_229_121_5 mb-3"><i class="fa-solid fa-caret-right"></i> Thông tin sản phẩm</h5>
                <ul class="list-unstyled">
                  <?php 
                    $products = getProductsByBillId($bill['bill_id']);
                    $i=1;
                    foreach ($products as $product) {
                      echo "
                        <li class='d-flex align-items-center mb-3'>
                          <p>" . $i . "</p>
                          <img src='" . IMG_PATH_USER_PRODUCT . "{$product['img']}' alt='{$product['name']}' style='width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-right: 12px;'>
                          <div>
                            <strong>{$product['name']}</strong> x {$product['quantity']}<br>
                            <span class='text-muted'>Đơn giá: " . number_format($product['price'], 0, ',', '.') . " VND</span>
                          </div>
                        </li>";
                      $i++;
                    }
                  ?>
                </ul>

                <hr>
                  
                <!-- P3. Thông Tin Thanh Toán -->
                <h5 class="text-col-rgb_229_121_5 mb-3"><i class="fa-solid fa-caret-right"></i> Thông tin thanh toán</h5>
                <p><strong><i class="fa-solid fa-receipt"></i> Tổng thanh toán: <span class="text-danger"><?= number_format($product['total_price'], 0, ',', '.') ?> VND</span></strong></p>
                <p><strong><i class="fa-solid fa-money-check-dollar"></i> Phương thức thanh toán:</strong> <?= $bill['payment_method'] ?></p>
                <p><strong><i class="fa-solid fa-money-check-dollar"></i> Mã giảm giá áp dụng:</strong> 
                  <?= isset($bill['discount_code']) && !empty($bill['discount_code']) ? htmlspecialchars($bill['discount_code']) : 'Không áp dụng' ?>
                </p>
                <p><strong><i class="fa-solid fa-clock"></i> Thời gian đặt hàng:</strong> <?= date('H:i d/m/Y', strtotime($bill['created_at'])) ?></p>

                <?php if($bill['payment_method'] == "Momo") :?>
                  <?php if ($bill['payment_status'] == 0): ?>

                    <form action="index.php?pg=payment" method="post">

                      <input type="hidden" name="bill_id" value="<?= $bill['bill_id'] ?>">

                      <input type="hidden" name="total_price" value="<?= $product['total_price'] ?>">

                      <button type="submit" name="payUrl" class="btn btn-success rounded-pill shadow-sm ms-auto d-block">
                        
                        Thanh toán qua ví MoMo <i class="fa-solid fa-arrow-right"></i></button>

                    </form>

                  <?php else: ?>

                    <div class="alert alert-success" role="alert">
                      Đơn hàng đã được thanh toán! Xin cảm ơn quý khách!
                    </div>
                    
                  <?php endif; ?>

                <?php else: ?>   

                  <div class="alert alert-warning" role="alert">
                    Hãy đợi shipper giao hàng cho bạn!
                  </div>

                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; ?>

    </tbody>

  </table>

</div>








