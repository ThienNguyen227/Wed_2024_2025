

<div class="main">
    <!-- Tiêu đề -->
    <h2 class="text-center"><span class="badge title_page mt-3 mb-4">Danh Sách Đơn Hàng</span></h2>
    
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                
                <form class="d-flex" role="search">
                    <div class="input-group w-100">
                        <!-- Thanh tìm kiếm -->
                        <input type="text" class="form-control" id="searchInputOrder" placeholder="Tìm kiếm đơn hàng ..." style="flex: 1;">

                        <!-- Thanh lọc-->
                        <select class="form-select" id="filterSelectOrder" name="filterSelectOrder" style="flex: 0 0 30%;">
                            <option value="">-- Lọc theo loại --</option>
                            <!-- <optgroup label="Trạng thái">
                                <option value="choxacnhan">Chờ xác nhận</option>
                                <option value="xacnhan">Xác nhận</option>
                                <option value="danggiao">Đang giao</option>
                                <option value="dagiao">Đã giao</option>
                                <option value="dahuy">Đã hủy</option>
                                <option value="dahoantra">Đã hoàn trả</option>
                            </optgroup> -->
                            <optgroup label="Thời gian">
                                <option value="newest">Mới nhất</option>
                                <option value="oldest">Cũ nhất</option>
                            </optgroup>
                            
                        </select>

                        <!-- Nút tìm kiếm -->
                        <button class="btn btn-outline-secondary" type="button" id="searchButtonOrder">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <!-- Thông báo tìm kiếm sản phẩm và lọc sản phẩm -->
        <div id="searchResultText_found" class="mb-3 fw-semibold text-success fs-5"></div>
        <div id="searchResultText_notfound" class="mb-3 fw-semibold text-danger fs-5"></div>

        <!-- 1. Thông báo xanh -->
        <?php
            if (isset($_SESSION['tb_success']) && $_SESSION['tb_success'] != "") {
                echo '<div class="text-success mb-3 fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success'] . '</div>';
                unset($_SESSION['tb_success']);
            }
        ?>

        <!-- 2. Thông báo đỏ -->
        <?php
            if (isset($_SESSION['tb_danger']) && $_SESSION['tb_danger'] != "") {
                echo '<div class="text-danger  mb-3 fs-5"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['tb_danger'] . '</div>';
                unset($_SESSION['tb_danger']);
            }
        ?>

    </div>

    <!-- Thông báo chỉnh sửa trạng thái thanh toán, trạng thái đơn hàng thành công -->
    <?php
        if (isset($_SESSION['tb_success_edition']) && $_SESSION['tb_success_edition'] != "") {
            echo '<div class="text-success mb-3 fs-5"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['tb_success_edition'] . '</div>';
            unset($_SESSION['tb_success_edition']);
        }
    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
            <thead class="table-warning text-center align-middle">
                <tr>
                    <th scope="col"><i class="bi bi-list-ol me-1"></i>STT</th>
                    <th scope="col"><i class="bi bi-receipt me-1"></i>Mã đơn hàng</th>
                    <th scope="col"><i class="bi bi-person-badge me-1"></i>Mã khách hàng</th>
                    <th scope="col"><i class="bi bi-person me-1"></i>Tên người nhận</th>
                    <th scope="col"><i class="bi bi-telephone me-1"></i>Số điện thoại người nhận</th>
                    <th scope="col"><i class="bi bi-credit-card me-1"></i>Phương thức thanh toán</th>
                    <th scope="col"><i class="bi bi-cash-coin me-1"></i>Trạng thái thanh toán</th>
                    <th scope="col"><i class="bi bi-truck me-1"></i>Trạng thái đơn hàng</th>
                    <th scope="col"><i class="bi bi-calendar-check me-1"></i>Thời gian đặt hàng</th>
                    <th scope="col"><i class="bi bi-gear me-1"></i>Thao tác</th>
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

    function exportBill(billId) {
        window.open('../dao/export_invoice.php?bill_id=' + billId, '_blank');
    }
  
  window.onload = function () 
  {
    const filter = document.getElementById('filterSelectOrder')?.value || '';
    const keyword = document.getElementById('searchInputOrder')?.value || '';
    loadProductsWithSearch(1, filter, keyword);
  };

  function loadProductsWithSearch(page, filter = '', keyword = '') {
      const xhr = new XMLHttpRequest();
      const params = new URLSearchParams({
          page: page,
          filter: filter,
          keyword: keyword
      });

      xhr.open('GET', '../dao/aj_ad_search_filter_order.php?' + params.toString(), true);
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
    .getElementById("searchButtonOrder")
    .addEventListener("click", function () {
        var keyword = document.getElementById("searchInputOrder").value;
        var filter = document.getElementById("filterSelectOrder").value;

        var xhr = new XMLHttpRequest();

        xhr.open(
        "GET",
        "../dao/aj_ad_search_filter_order.php?keyword="+encodeURIComponent(keyword) +"&filter="+encodeURIComponent(filter),
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


