<div class="main">
    <div class="mb-3">

        <!-- Tiêu đề -->
        <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Danh Sách Người Dùng</span></h2>

        <div class="row">
            <div class="col-6">
                
                <form class="d-flex" role="search">
                    <div class="input-group w-100">
                        <!-- Thanh tìm kiếm -->
                        <input type="text" class="form-control" id="searchInputUser" placeholder="Tìm kiếm khách hàng ..." style="flex: 1;">

                        <!-- Thanh lọc-->
                        <select class="form-select" id="filterSelectUser" name="filterSelectUser" style="flex: 0 0 30%;">
                            <option value="">-- Lọc theo loại --</option>
                            <option value="newest">Mới nhất</option>
                            <option value="oldest">Cũ nhất</option>
                        </select>

                        <!-- Nút tìm kiếm -->
                        <button class="btn btn-outline-secondary" type="button" id="searchButtonUser">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <!-- Thông báo tìm kiếm người dùng -->
                <div id="searchResultText_found" class="mb-3 fw-semibold text-success fs-5"></div>
                <div id="searchResultText_notfound" class="mb-3 fw-semibold text-danger fs-5"></div>

            </div>

            <!-- Nút thêm người dùng -->
            <div class="col-6">
                <div class="d-flex justify-content-end mb-3">
                    <a href="index.php?pg=management_user_add" class="btn btn_200_105_5">
                        <i class="bi bi-plus-circle me-1"></i> Thêm người dùng mới
                    </a>
                </div>
            </div>

        </div>
    </div>
    <!-- Thông báo thêm người dùng thành công -->
    <?php
        if (isset($_SESSION['tb_success_add_user']) && $_SESSION['tb_success_add_user'] != "") {
            echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_add_user'] . '</div>';
            unset($_SESSION['tb_success_add_user']);
        }
    ?>


    <!-- Thông báo cập nhật người dùng thành công -->
    <?php
        if (isset($_SESSION['tb_update_thanhcong']) && $_SESSION['tb_update_thanhcong'] != "") {
            echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_update_thanhcong'] . '</div>';
            unset($_SESSION['tb_update_thanhcong']);
        }
    ?>


    <!-- Thông báo xóa người dùng thành công -->
    <?php
        if (isset($_SESSION['tb_success_delete']) && $_SESSION['tb_success_delete'] != "") {
            echo '<div class="text-success mb-3 fw-bold fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_delete'] . '</div>';
            unset($_SESSION['tb_success_delete']);
        }
    ?>

    <!-- Thông báo không được xóa người dùng -->
    <?php
        if (isset($_SESSION['tb_invalid_delete']) && $_SESSION['tb_invalid_delete'] != "") {
            echo '<div class="text-danger  mb-3 fw-bold fs-5"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_invalid_delete'] . '</div>';
            unset($_SESSION['tb_invalid_delete']);
        }
    ?>

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
                    <th scope="col"><i class="bi bi-gear me-1"></i>Hành động</th>
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
        const filter = document.getElementById('filterSelectUser')?.value || '';
        const keyword = document.getElementById('searchInputUser')?.value || '';
        loadProductsWithSearch(1, filter, keyword);
    };

    function loadProductsWithSearch(page, filter = '', keyword = '') {
        const xhr = new XMLHttpRequest();
        const params = new URLSearchParams({
            page: page,
            filter: filter,
            keyword: keyword
        });

        xhr.open('GET', '../dao/aj_ad_search_filter_user.php?' + params.toString(), true);
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
        .getElementById("searchButtonUser")
        .addEventListener("click", function () {
            var keyword = document.getElementById("searchInputUser").value;
            var filter = document.getElementById("filterSelectUser").value;

            var xhr = new XMLHttpRequest();

            xhr.open(
            "GET",
            "../dao/aj_ad_search_filter_user.php?keyword="+encodeURIComponent(keyword) +"&filter="+encodeURIComponent(filter),
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


   
