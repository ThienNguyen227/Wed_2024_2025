<?php
    $html_management_user_order ='';
    $i = 1;
    foreach ($info_order as $io) 
    {
        $bill_id = $io["bill_id"];
        $total_price = $io["total_price"];
        $html_management_user_order .='<tr class="text-center align-middle">
                                        <td>'.$i.'</td>
                                        <td>'.$bill_id.'</td>
                                        <td></td>
                                        <td>'.$total_price.'</td>
                                        <td></td>
                                    </tr>';
        $i++;
    }
?>

<div class="main">

    <!-- Bảng shos list đơn hàng của khách hàng-->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle bg-white shadow-sm rounded">
            <thead class="table-warning text-center align-middle">
                <tr>
                    <th scope="col"><i class="bi bi-hash me-1"></i>STT</th>
                    <th scope="col"><i class="bi bi-person-vcard me-1"></i>Mã đơn hàng</th>
                    <th scope="col"><i class="bi bi-person-lines-fill me-1"></i>Sản phẩm</th>
                    <th scope="col"><i class="bi bi-telephone me-1"></i>Tổng đơn giá</th>
                    <th scope="col"><i class="bi bi-envelope me-1"></i>Ngày đặt</th>
                </tr>
            </thead>

            <tbody>
               <?=$html_management_user_order;?> 
            </tbody>
        </table>
    </div>
</div>