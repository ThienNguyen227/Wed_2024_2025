<?php
    require_once "pdo.php";
    require_once "product.php";
    require_once "global.php";

    // Nhúng Dompdf
    require_once __DIR__ . '/../dompdf/autoload.inc.php';
    use Dompdf\Dompdf;

    if (!isset($_GET['bill_id'])) {
        die("Thiếu mã hóa đơn.");
    }
    $bill_id = intval($_GET['bill_id']);

    $bill = pdo_query_one(" SELECT * 
                            FROM bill b 
                            JOIN bill_detail bd ON b.bill_id = bd.bill_id
                            WHERE b.bill_id = ?", $bill_id);

    if (!$bill) {
        die("Không tìm thấy hóa đơn.");
    }
    $details = get_detail_bill_by_bill_id($bill_id);

    // Chuẩn bị nội dung HTML
    ob_start(); // Bắt đầu lưu HTML vào bộ đệm
    ?>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        ul { list-style-type: none; padding-left: 0; }
        li { margin-bottom: 5px; }
    </style>
    <h2>HÓA ĐƠN MUA HÀNG</h2>
    <p><strong>Mã hóa đơn:</strong> <?= $bill['bill_id'] ?></p>
    <p><strong>Người nhận:</strong> <?= $bill['receiver_name'] ?></p>
    <p><strong>SĐT:</strong> <?= $bill['receiver_phone'] ?></p>
    <p><strong>Địa chỉ:</strong> <?= $bill['receiver_address'] ?></p>
    <p><strong>Thời gian đặt:</strong> <?= date("H:i - d/m/Y", strtotime($bill['created_at'])) ?></p>
    <hr>
    <h4>Chi tiết sản phẩm:</h4>
    <ul>
    <?php foreach ($details as $item): ?>
        <li><?= $item['name'] ?> - SL: <?= $item['quantity'] ?> - Giá: <?= number_format($item['price']) ?> VND</li>
    <?php endforeach; ?>
    </ul>
    <?php if ($bill['discount_code'] != ''): 
        $percent = get_voucher($bill['discount_code']);
    ?>
        <p><strong>Mã giảm:</strong> <?= $bill['discount_code'] ?> (Giảm <?= $percent['discount_percent'] ?>%)</p>
    <?php endif; ?>
    <p><strong>Tổng tiền:</strong> <?= number_format($bill['total_price']) ?> VND</p>
    <?php
    $html = ob_get_clean(); // Lấy nội dung HTML

    // Khởi tạo Dompdf và xuất ra PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Tải về file
    $dompdf->stream("hoa_don_{$bill_id}.pdf", ["Attachment" => false]); // true = tải về, false = xem trên trình duyệt
    exit;
?>
