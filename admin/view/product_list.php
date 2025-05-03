<body>

    <div class="sidebar">
        <h4>Admin</h4>
        <a href="index.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
        <a href="index.php?pg=product_list" class="active_slide_bar"><i class="bi bi-box-seam"></i>Sản phẩm</a>
        <a href="index.php?pg=product_order"><i class="bi bi-cart"></i>Đơn hàng</a>
        <a href="index.php?pg=management_user"><i class="bi bi-people"></i>Người dùng</a>
        <a href="#"><i class="bi bi-bar-chart"></i>Thống kê</a>
        <a href="#"><i class="bi bi-gear"></i>Cài đặt</a>
    </div>

    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <span class="navbar-brand fw-bold text_200_105_5"><i class="bi bi-file-earmark-text"></i> QUẢN LÝ SẢN PHẨM</span>
        <div class="ms-auto">
          <span class="me-3">Xin chào, Admin</span>
          <i class="bi bi-person-circle fs-4"></i>
        </div>
      </div>
    </nav>


    <div class="main">

        <!-- <h2 class="fw-bold mb-4">Bảng điều khiển</h2>
        <div class="row dashboard-cards">
            <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                <div class="card-icon"><i class="bi bi-box-seam"></i></div>
                <h5 class="card-title">Sản phẩm</h5>
                <p class="card-text">120 sản phẩm</p>
                </div>
            </div>
            </div>
            <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                <div class="card-icon"><i class="bi bi-cart-check"></i></div>
                <h5 class="card-title">Đơn hàng</h5>
                <p class="card-text">25 đơn hôm nay</p>
                </div>
            </div>
            </div>
            <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                <div class="card-icon"><i class="bi bi-people-fill"></i></div>
                <h5 class="card-title">Người dùng</h5>
                <p class="card-text">10 người mới</p>
                </div>
            </div>
            </div>
        </div> -->

        <!-- Bảng list sản phẩm Danh sách sản phẩm -->
        <h2 class="text-center"><span class="badge title_page fw-bold mt-3 mb-3">Danh sách sản phẩm</span></h2>
        
        <!-- Thông báo xóa sản phẩm thành công -->
        <?php
            if (isset($_SESSION['tb_success_delete']) && $_SESSION['tb_success_delete'] != "") {
              echo '<div class="text-success mb-3 fw-bold"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_delete'] . '</div>';
              unset($_SESSION['tb_success_delete']);
            }
        ?>

        <!-- Thông báo không được xóa sản phẩm -->
        <?php
            if (isset($_SESSION['tb_invalid_delete']) && $_SESSION['tb_invalid_delete'] != "") {
              echo '<div class="text-danger  mb-3 fw-bold"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_delete'] . '</div>';
              unset($_SESSION['tb_invalid_delete']);
            }
        ?>

        <!-- Thông báo thêm sản phẩm thành công -->
        <?php
            if (isset($_SESSION['tb_success_addition']) && $_SESSION['tb_success_addition'] != "") {
              echo '<div class="text-success mb-3 fw-bold"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_addition'] . '</div>';
              unset($_SESSION['tb_success_addition']);
            }
        ?>

        <!-- Thông báo chỉnh sửa sản phẩm thành công -->
        <?php
            if (isset($_SESSION['tb_success_edition']) && $_SESSION['tb_success_edition'] != "") {
              echo '<div class="text-success mb-3 fw-bold"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_edition'] . '</div>';
              unset($_SESSION['tb_success_edition']);
            }
        ?>


        

        <!-- Thanh tìm kiếm sản phẩm -->
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    
                    <form class="d-flex" role="search">
                        <div class="input-group w-100">
                            <!-- Thanh tìm kiếm -->
                            <input type="text" class="form-control" id="searchInputProduct" placeholder="Tìm kiếm sản phẩm ..." style="flex: 1;">

                            <!-- Thanh lọc-->
                            <select class="form-select" id="filterSelectProduct" name="filterSelectProduct" style="flex: 0 0 30%;">
                                <option value="">-- Lọc theo loại --</option>
                                <option value="coffee">Coffee</option>
                                <option value="tea">Tea</option>
                                <option value="cake">Cake</option>
                                <option value="ame">A-Mê</option>
                                <option value="newest">Mới nhất</option>
                                <option value="oldest">Cũ nhất</option>
                            </select>

                            <!-- Nút tìm kiếm -->
                            <button class="btn btn-outline-secondary" type="button" id="searchButtonProduct">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Thông báo tìm kiếm sản phẩm -->
                    <div id="searchResultText_found" class="mb-3 fw-semibold text-success fs-5"></div>
                    <div id="searchResultText_notfound" class="mb-3 fw-semibold text-danger fs-5"></div>

                </div>

                <!-- Nút thêm sản phẩm -->
                <div class="col-6">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="index.php?pg=product_add" class="btn btn_200_105_5">
                            <i class="bi bi-plus-circle me-1"></i> Thêm sản phẩm
                        </a>
                    </div>
                </div>

            </div>
        </div>

        

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
                <thead class="table-warning text-center">
                    <tr>
                        <th scope="col"><i class="bi bi-list-ol me-1"></i> STT</th>
                        <th scope="col"><i class="bi bi-box2"></i> Sản phẩm</th>
                        <th scope="col"><i class="bi bi-image"></i> Hình ảnh</th>
                        <th scope="col"><i class="bi bi-tags"></i> Đơn giá</th>
                        <th scope="col"><i class="bi bi-gear me-1"></i> Hành động</th>
                    </tr>
                </thead>

                <tbody id="product-list">
                    <!-- Dữ liệu phân trang -->
                </tbody>

                

            </table>
        </div>


        <!-- Các nút phân trang -->
        <div id="pagination">
            
        </div>

    
    </div>

    <script>
        // Gọi lần đầu khi trang tải
        window.onload = function () {
            const filter = document.getElementById('filterSelectProduct')?.value || '';
            const keyword = document.getElementById('searchInputProduct')?.value || '';
            loadProductsWithSearch(1, filter, keyword);
        };

        function loadProductsWithSearch(page, filter = '', keyword = '') {
            const xhr = new XMLHttpRequest();
            const params = new URLSearchParams({
                page: page,
                filter: filter,
                keyword: keyword
            });

            xhr.open('GET', '../dao/aj_ad_search_filter_product.php?' + params.toString(), true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    document.getElementById('product-list').innerHTML = response.list_product;
                    document.getElementById('pagination').innerHTML = response.pagination;
                }
            };
            xhr.send();
        }

        


        document
            .getElementById("searchButtonProduct")
            .addEventListener("click", function () {
                var keyword = document.getElementById("searchInputProduct").value;
                var filter = document.getElementById("filterSelectProduct").value;

                var xhr = new XMLHttpRequest();

                xhr.open(
                "GET",
                "../dao/aj_ad_search_filter_product.php?keyword="+encodeURIComponent(keyword) +"&filter="+encodeURIComponent(filter),
                true
                );

                xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    document.getElementById("product-list").innerHTML = response.list_product;
                    document.getElementById("pagination").innerHTML = response.pagination;

                    const resultText_keyword = keyword.trim();
                    const resultText_filter = filter.trim();


                    let tb = "";
                    let tb_1 = "";
                    if (resultText_keyword && resultText_filter) {
                        tb = `<i class="bi bi-arrow-right-circle"></i> Kết quả tìm kiếm với từ khóa: "<strong>${keyword}</strong>" và lọc theo: "<strong>${filter}</strong>"`;
                    } else if (resultText_keyword) {
                        tb = `<i class="bi bi-arrow-right-circle"></i> Kết quả tìm kiếm với từ khóa: "<strong>${keyword}</strong>"`;
                    } else if (resultText_filter) {
                        tb = `<i class="bi bi-arrow-right-circle"></i> Kết quả tìm kiếm lọc theo: "<strong>${filter}</strong>"`;
                    } else {
                        tb_1 = `<i class="bi bi-exclamation-circle"></i> Hãy nhập thông tin hoặc chọn lọc loại để tìm kiếm sản phẩm`;
                    }

                    document.getElementById("searchResultText_found").innerHTML = tb;
                    document.getElementById("searchResultText_notfound").innerHTML = tb_1;
                }
                };

                xhr.send();
            });
    </script>
