<?php
    $html_discount_notification = '';
    foreach ($discount_notification as $dn) {
        extract($dn);
        $formatted_date = date('H:i:s - d/m/Y', strtotime($created_at));
        $html_discount_notification .= '<div class="radius_shadow_2 bg-white p-4 mb-4">
                                        <h4 class="text-col-rgb_229_121_5">'.$notification_title.'</h4>
                                        <p>'.$notification_message.'</p>
                                        <p class="text-end">'.$formatted_date.'</p>
                                    </div>';
    }

    $html_public_notification = '';
    foreach ($public_notification as $pn) {
        extract($pn);
        $formatted_date = date('H:i:s - d/m/Y', strtotime($created_at));
        $html_public_notification .='<div class="radius_shadow_2 bg-white p-3 mb-4 max_height_notification">
                                        <h5 class="text-col-rgb_229_121_5">'.$notification_title.'</h5>
                                        <div class="clamp-3">'.$notification_message.'</div>
                                        <p class="text-end mt-3">'.$formatted_date.'</p>
                                    </div>';
    }

?>

<body>

    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="text-col-rgb_229_121_5 fs">📢 Thông Báo</h2>
            <p class="ita">Những cập nhật mới nhất từ cửa hàng của chúng tôi</p>
        </div>

        <div class="row">
            <!-- Cột Thông báo chung -->
            <div class="col-md-6 mb-4">
                <h4 class="text-primary mb-3"><i class="bi bi-newspaper"></i> Thông báo hệ thống</h4>
                <div class="p-3 border rounded shadow-sm scrollable-notification">
                    
                    <?=$html_public_notification;?>

                </div>
            </div>

            <!-- Cột Thông báo cá nhân -->
            <div class="col-md-6 mb-4">
                <h4 class="text-success mb-3"><i class="bi bi-file-person-fill"></i> Thông báo cá nhân</h4>
                <div class="p-3 border rounded shadow-sm scrollable-notification">
                    
                    <?=$html_discount_notification;?>

                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="ord text-decoration-none">Về Trang Chủ</a>
        </div>
    </div>


</body>









