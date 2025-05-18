<?php
    $revenue_last_7_days = ad_get_revenue_last_7_days();

    // Tạo mảng labels và data cho biểu đồ
    $labels = [];
    $data = [];
    
    $day_map = [
        'Mon' => 'Thứ 2', 'Tue' => 'Thứ 3', 'Wed' => 'Thứ 4',
        'Thu' => 'Thứ 5', 'Fri' => 'Thứ 6', 'Sat' => 'Thứ 7', 'Sun' => 'Chủ nhật'
    ];
    
    foreach ($revenue_last_7_days as $row) {
        $day = date('D', strtotime($row['date']));
        $labels[] = $day_map[$day];
        $data[] = (int)$row['revenue'];
    }
?>


<div class="main">
    <div class="row dashboard-cards">
        <!-- Tổng sản phẩm -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-box-seam"></i></div>
                    <h5 class="card-title">Sản phẩm</h5>
                    <p class="card-text">Tổng: <?= $total_products ?> sản phẩm</p>
                </div>
            </div>
        </div>
        
        <!-- Tổng đơn hàng -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-cart-check"></i></div>
                    <h5 class="card-title">Đơn hàng</h5>
                    <p class="card-text">Tổng: <?= $total_orders ?> đơn hàng</p>
                </div>
            </div>
        </div>
        <!-- Tổng khách hàng -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-people-fill"></i></div>
                    <h5 class="card-title">Khách hàng</h5>
                    <p class="card-text">Tổng: <?= $total_customers ?> khách hàng</p>
                </div>
            </div>
        </div>

        <!-- Tổng sản phẩm đóng gói -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-box2"></i></div>
                    <h5 class="card-title">Sản phẩm đóng gói</h5>
                    <p class="card-text">Tổng: <?= $total_packed_products ?> sản phẩm</p>
                </div>
            </div>
        </div>

        <!-- Tổng đơn hàng hôm nay -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-cart"></i></div>
                    <h5 class="card-title">Đơn hàng hôm nay</h5>
                    <p class="card-text">Tổng: <?= $total_today_orders ?> đơn hàng</p>
                </div>
            </div>
        </div>
        <!-- Tổng khách hàng mới hôm nay -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-person-add"></i></div>
                    <h5 class="card-title">Khách hàng mới</h5>
                    <p class="card-text">Tổng: <?= $total_today_customers ?> khách hàng</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Doanh thu hôm nay -->
    <div class="row">
        <div class="col-6">
            <div class="card p-4 mb-4 text-center">
                <h5 class="mb-3">Doanh thu 7 ngày gần nhất</h5>
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
        <div class="col-6">
            <div class="card p-4">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="bi bi-currency-exchange"></i></div>
                    <h5 class="card-title">Doanh thu hôm nay</h5>
                    <p class="card-text">Tổng: <?= number_format($total_today_revenue, 0, ',', '.') ?> VNĐ</p>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-6">
            
        </div>
        <div class="col-6">
            <div class="card bg-gradient bg-primary text-white p-4 mb-4 d-flex flex-md-row flex-column align-items-center justify-content-between shadow-lg rounded-4">
                <div class="text-center text-md-start">
                    <h5 class="text-uppercase fw-semibold">Tổng doanh thu</h5>
                    <h1 class="fw-bold mt-2"><?= number_format($total_revenue, 0, ',', '.') ?> VNĐ</h1>
                </div>
                <div class="display-3">
                    <i class="bi bi-currency-exchange"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?= json_encode($data) ?>,
                backgroundColor: 'rgb(229, 121, 5)',
                borderColor: 'rgb(229, 121, 5)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' đ';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw.toLocaleString('vi-VN') + ' đ';
                        }
                    }
                }
            }
        }
    });
</script>





