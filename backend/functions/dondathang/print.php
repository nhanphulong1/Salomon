<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Salomon/assets/vendor/paper-css/paper.css">

    <style>@page { size: A4 }</style>

    <title>In hóa đơn</title>
</head>
<body class="A4">

    <?php
    //Ket noi du lieu
    include_once(__DIR__ . '/../../../dbconnect.php');
    //Cau lenh
    $caulenh = <<<EOT
    SELECT ddh.dh_ma,ddh.dh_ngaylap,ddh.dh_ngaygiao,ddh.dh_noigiao,ddh.dh_trangthaithanhtoan,
    kh.kh_ten,
    tt.httt_ten,
    (sp.sp_dh_soluong * sp.sp_dh_dongia) AS Tong
    FROM dondathang ddh
    JOIN khachhang kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
    JOIN hinhthucthanhtoan tt ON tt.httt_ma = ddh.httt_ma
    JOIN sanpham_dondathang sp ON sp.dh_ma = ddh.dh_ma
    GROUP BY ddh.dh_ma            
EOT;
    //Thực thi câu lệnh
    $result = mysqli_query($conn,$caulenh);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $ds_dondathang = array(
            'dh_ma' => $row['dh_ma'],
            'kh_ten' => $row['kh_ten'],
            'dh_ngaylap' => date('d/m/Y H:i:s',strtotime($row['dh_ngaylap'])),
            'dh_ngaygiao' => date('d/m/Y H:i:s',strtotime($row['dh_ngaygiao'])),
            'dh_noigiao' => $row['dh_noigiao'],
            'dh_trangthaithanhtoan' =>  $row['dh_trangthaithanhtoan'],
            'httt_ten' => $row['httt_ten'],
            'Tong' => number_format($row['Tong'],0,".",",") 
        );
    }
    
    ?>
    <section class="sheet padding-10mm">
        <table border="0" width="100%" cellspacing="0">
            <tr>
                <td style="width:150px;"><img src="/Salomon/assets/uploads/default.png" width="150px" alt="Logo công ty"></td>
                <td style="text-align: center;">Công Ty SALOMON</td>
            </tr>
        </table>
        <b style="font-size: 20px; margin: 20px 5px; display:block;"><em><u>Thông tin khách hàng</u></em></b>
        <table border="0" width="100%" cellspacing="0">
            <tr>
                <td width="250px" height="30px">Tên khách hàng:</td>
                <td><?= $ds_dondathang['kh_ten'] ?></td>
            </tr>
            <tr>
                <td width="250px" height="30px">Ngày lập:</td>
                <td><?= $ds_dondathang['dh_ngaylap'] ?></td>
            </tr>
            <tr>
                <td width="250px" height="30px">Hình thức thanh toán:</td>
                <td><?= $ds_dondathang['httt_ten']?></td>
            </tr>
            <tr>
                <td width="250px" height="30px">Tổng tiền:</td>
                <td><?= $ds_dondathang['Tong'] ?> VNĐ</td>
            </tr>
        </table>

        <b style="font-size: 20px; margin: 20px 5px; display:block;"><em><u>Thông tin chi tiết</u></em></b>
        <table border="1" width="100%" cellspacing="0">
            <tr>
                <td width="250px" height="30px">Tên khách hàng:</td>
                <td><?= $ds_dondathang['kh_ten'] ?></td>
            </tr>
            <tr>
                <td width="250px" height="30px">Ngày lập:</td>
                <td><?= $ds_dondathang['dh_ngaylap'] ?></td>
            </tr>
            <tr>
                <td width="250px" height="30px">Hình thức thanh toán:</td>
                <td><?= $ds_dondathang['httt_ten']?></td>
            </tr>
            <tr>
                <td width="250px" height="30px">Tổng tiền:</td>
                <td><?= $ds_dondathang['Tong'] ?> VNĐ</td>
            </tr>
        </table>
    </section>
</body>
</html>