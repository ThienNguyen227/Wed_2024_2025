<?php
    


    $html_discount_notification = '';

    if (!empty($discount_notification)) {
        foreach ($discount_notification as $dn) {
            extract($dn);

            $formatted_date = date('H:i:s - d/m/Y', strtotime($created_at));
            $read_class = ($notification_status == 1) ? 'read' : 'unread';

            $html_discount_notification .= '<div class="radius_shadow_2 bg-white p-4 mb-4 '.$read_class.' notification-item position-relative">
                                                <a href="index.php?pg=handle_subtraction_personal_notification&id='.$notification_id.'" class="position-absolute top-0 end-0 mt-2 me-3 text-danger">
                                                    <i class="bi bi-trash3-fill fs-2"></i>
                                                </a>
                                                <h4 class="text-col-rgb_229_121_5">'.htmlspecialchars($notification_title).'</h4>
                                                <p>'.htmlspecialchars($notification_message).'</p>
                                                <p class="text-end">'.$formatted_date.'</p>
                                            </div>';
        }
    } else {
        $html_discount_notification = '<p class="text-muted fst-italic">Hiện em chưa có thông báo cá nhân nào.</p>';
    }

    

    $html_public_notification = '';
    if (!empty($public_notification)) {
        foreach ($public_notification as $pn) {
            extract($pn);
            $formatted_date = date('H:i:s - d/m/Y', strtotime($created_at));
            $html_public_notification .='<div class="radius_shadow_2 bg-white p-3 mb-4 max_height_notification">
                                            <h5 class="text-col-rgb_229_121_5">'.$notification_title.'</h5>
                                            <div class="clamp-3">'.$notification_message.'</div>
                                            <p class="text-end mt-3">'.$formatted_date.'</p>
                                        </div>';
    }
    } else {
        $html_public_notification = '<p class="text-muted fst-italic">Hiện bạn chưa có thông báo hệ thống nào.</p>';
    }
?>





<body>
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
                    <a class="nav-link w nb" href="index.php?pg=khuyenmai"><i class="fa-solid fa-gift"></i> Khuyến Mãi</a>
                </li>
                </ul>
            </div>
            </div>

        </div>
    </section>


    <div class="container py-2">
        <div class="text-center mb-4">
            <h2 class="text-col-rgb_229_121_5 fs"><i class="bi bi-bell-fill"></i> Thông Báo</h2>
            <p class="ita">Những cập nhật mới nhất từ cửa hàng của chúng tôi</p>
        </div>

        <div class="row">
            <!-- Cột Thông báo chung -->
            <div class="col-md-6 mb-4">
                <h4 class="text-primary mb-3 fw-bold"><i class="bi bi-newspaper"></i> THÔNG BÁO HỆ THỐNG </h4>
                <div class="p-3 border rounded shadow-lg scrollable-notification">
                    
                    <?=$html_public_notification;?>

                </div>
            </div>

            <!-- Cột Thông báo cá nhân -->
            <div class="col-md-6 mb-4">
                <h4 class="text-success mb-3 fw-bold"><i class="bi bi-file-person-fill"></i> THÔNG BÁO CÁ NHÂN</h4>
                
                <div class="p-3 border rounded shadow-lg scrollable-notification">
                    
                    <?=$html_discount_notification;?>

                </div>
                <!-- 1. Thông báo xanh -->
                <?php
                    if (isset($_SESSION['tb_success']) && $_SESSION['tb_success'] != "") {
                        echo '<div class="text-success mb-3 fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success'] . '</div>';
                        unset($_SESSION['tb_success']);
                    }
                ?>
                <div class="text-end mt-3">
                    <a href="index.php?pg=handle_delete_all_discount_notifications" class="btn btn-outline-danger btn-md" onclick="return confirm('Bạn có chắc muốn xóa tất cả thông báo không?')">
                        <i class="bi bi-trash3-fill"></i> Xóa tất cả
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="ord text-decoration-none">Về Trang Chủ</a>
        </div>
    </div>


</body>



















