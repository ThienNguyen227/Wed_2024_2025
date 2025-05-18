<div class="main">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Danh Sách Thông Báo</span></h2>

    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                
                <form class="d-flex" role="search">
                    <div class="input-group w-100">
                        <!-- Thanh tìm kiếm -->
                        <input type="text" class="form-control" id="searchInputNotification" placeholder="Tìm kiếm thông báo ..." style="flex: 1;">

                        <!-- Thanh lọc-->
                        <select class="form-select" id="filterSelectNotification" name="filterSelectNotification" style="flex: 0 0 30%;">
                            <option value="">-- Lọc theo loại --</option>
                            <!-- <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                            <option value="cake">Cake</option>
                            <option value="ame">A-Mê</option> -->
                            <option value="newest">Mới nhất</option>
                            <option value="oldest">Cũ nhất</option>
                        </select>

                        <!-- Nút tìm kiếm -->
                        <button class="btn btn-outline-secondary" type="button" id="searchButtonNotification">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Thông báo tìm kiếm thông báo-->
                <div id="searchResultText_found" class="mb-3 fw-semibold text-success fs-5"></div>
                <div id="searchResultText_notfound" class="mb-3 fw-semibold text-danger fs-5"></div>

            </div>

            <!-- Nút thêm thông báo -->
            <div class="col-6">
                <div class="d-flex justify-content-end mb-3">
                    <a href="index.php?pg=notification_add" class="btn btn_200_105_5">
                        <i class="bi bi-plus-circle me-1"></i> Thêm thông báo
                    </a>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Thông báo xóa thông báo thành công -->
    <?php
        if (isset($_SESSION['tb_success_delete']) && $_SESSION['tb_success_delete'] != "") {
            echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_delete'] . '</div>';
            unset($_SESSION['tb_success_delete']);
        }
    ?>

    <!-- Thông báo không được xóa thông báo -->
    <?php
        if (isset($_SESSION['tb_invalid_delete']) && $_SESSION['tb_invalid_delete'] != "") {
            echo '<div class="text-danger  mb-3 fw-bold fs-5"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_delete'] . '</div>';
            unset($_SESSION['tb_invalid_delete']);
        }
    ?>

    <!-- Thông báo thêm thông báo thành công -->
    <?php
        if (isset($_SESSION['tb_success_addition']) && $_SESSION['tb_success_addition'] != "") {
            echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_addition'] . '</div>';
            unset($_SESSION['tb_success_addition']);
        }
    ?>

    <!-- Thông báo chỉnh sửa thông báo thành công -->
    <?php
        if (isset($_SESSION['tb_success_edition']) && $_SESSION['tb_success_edition'] != "") {
            echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_edition'] . '</div>';
            unset($_SESSION['tb_success_edition']);
        }
    ?>

    
    <!-- Bảng show danh sách thông báo -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
            <thead class="table-warning text-center">
                <tr>
                    <th scope="col"><i class="bi bi-list-ol me-1"></i> STT</th>
                    <th scope="col"><i class="bi bi-box2"></i> Tiêu đề</th>
                    <th scope="col"><i class="bi bi-image"></i> Nội dung</th>
                    <th scope="col"><i class="bi bi-tags"></i> Ngày đăng</th>
                    <th scope="col"><i class="bi bi-gear me-1"></i> Ngày cập nhật</th>
                    <th scope="col"><i class="bi bi-gear me-1"></i> Hành động</th>
                </tr>
            </thead>

            <tbody id="product-list">
                <!-- Dữ liệu phân trang -->
            </tbody>
        </table>
    </div>

    <!-- Các nút phân trang -->
    <div id="pagination"></div>
</div>

<script>
    // Gọi lần đầu khi trang tải
    window.onload = function () 
    {
        const filter = document.getElementById('filterSelectNotification')?.value || '';
        const keyword = document.getElementById('searchInputNotification')?.value || '';
        loadProductsWithSearch(1, filter, keyword);
    };

    function loadProductsWithSearch(page, filter = '', keyword = '') {
        const xhr = new XMLHttpRequest();
        const params = new URLSearchParams({
            page: page,
            filter: filter,
            keyword: keyword
        });

        xhr.open('GET', '../dao/aj_ad_search_filter_notification.php?' + params.toString(), true);
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
        .getElementById("searchButtonNotification")
        .addEventListener("click", function () {
            var keyword = document.getElementById("searchInputNotification").value;
            var filter = document.getElementById("filterSelectNotification").value;

            var xhr = new XMLHttpRequest();

            xhr.open(
            "GET",
            "../dao/aj_ad_search_filter_notification.php?keyword="+encodeURIComponent(keyword) +"&filter="+encodeURIComponent(filter),
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
                    tb_1 = `<i class="bi bi-exclamation-circle"></i> Hãy nhập thông tin hoặc chọn lọc loại để tìm kiếm sản phẩm.`;
                }

                document.getElementById("searchResultText_found").innerHTML = tb;
                document.getElementById("searchResultText_notfound").innerHTML = tb_1;
            }
            };

            xhr.send();
        });
</script>
