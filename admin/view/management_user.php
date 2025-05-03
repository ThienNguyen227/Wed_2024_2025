<?php
    $html_all_list_user = '';
    $i=1;
    foreach ($all_list_user as $alu) {
        extract($alu);

        $formatted_date = date('H:i:s - d/m/Y', strtotime($created_at));

        $html_all_list_user .= '<tr class="text-center align-middle">
                                    <td>'.$i.'</td>
                                    <td>'.$id.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$phone.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$address.'</td>
                                    <td>'.$formatted_date.'</td>
                                </tr>';
        $i++;
    }
?>

<body>
    
    <div class="sidebar">
        <h4>Admin</h4>
        <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
        <a href="index.php?pg=product_list"><i class="bi bi-box-seam"></i>Sản phẩm</a>
        <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
        <a href="index.php?pg=management_user" class="active_slide_bar"><i class="bi bi-people"></i>Người dùng</a>
        <a href="#"><i class="bi bi-bar-chart"></i>Thống kê</a>
        <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
    </div>

    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <span class="navbar-brand fw-bold text-dark">Quản lý khách hàng</span>
        <div class="ms-auto">
          <span class="me-3">Xin chào, Admin</span>
          <i class="bi bi-person-circle fs-4"></i>
        </div>
      </div>
    </nav>
    

    <div class="main">
        
        <div class="mb-3">
            <div class="row">
                <!-- Thanh tìm kiếm -->
                <div class="col-6">
                    
                    <form class="d-flex" role="search">
                        <div class="input-group mb-3 w-100">
                            <!-- Thanh tìm kiếm -->
                            <input type="text" class="form-control" id="searchInputUser" placeholder="Tìm kiếm khách hàng ..." style="flex: 1;">

                            <!-- Thanh lọc-->
                            <select class="form-select" id="filterSelectUser" name="filterUser" style="flex: 0 0 30%;">
                                <option value="">-- Lọc theo --</option>
                                <option value="name_asc">Tên A → Z</option>
                                <option value="name_desc">Tên Z → A</option>
                                <option value="newest">Mới nhất</option>
                                <option value="oldest">Cũ nhất</option>
                            </select>

                            <!-- Nút tìm kiếm -->
                            <button class="btn btn-outline-secondary" type="button" id="searchButtonUser">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Bảng list khách hàng -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
                <thead class="table-warning text-center align-middle">
                    <tr>
                        <th scope="col"><i class="bi bi-hash me-1"></i>STT</th>
                        <th scope="col"><i class="bi bi-person-vcard me-1"></i>Mã khách hàng</th>
                        <th scope="col"><i class="bi bi-person-lines-fill me-1"></i>Tên khách hàng</th>
                        <th scope="col"><i class="bi bi-telephone me-1"></i>Số điện thoại</th>
                        <th scope="col"><i class="bi bi-envelope me-1"></i>Email</th>
                        <th scope="col"><i class="bi bi-geo-alt me-1"></i>Địa chỉ</th>
                        <th scope="col"><i class="bi bi-calendar-plus me-1"></i>Thời gian tạo tài khoản</th>
                    </tr>
                </thead>

                <tbody>
                    <?=$html_all_list_user;?>
                </tbody>
            </table>
        </div>
        

        
    </div>


   
