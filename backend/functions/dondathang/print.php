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
    $dh_ma =$_GET['dh_ma'];
    //Cau lenh
    $caulenh = <<<EOT
    SELECT ddh.dh_ma,ddh.dh_ngaylap,ddh.dh_ngaygiao,ddh.dh_noigiao,ddh.dh_trangthaithanhtoan,
    kh.kh_ten,
    tt.httt_ten,
    SUM(sp.sp_dh_soluong * sp.sp_dh_dongia) AS Tong
    FROM dondathang ddh
    JOIN khachhang kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
    JOIN hinhthucthanhtoan tt ON tt.httt_ma = ddh.httt_ma
    JOIN sanpham_dondathang sp ON sp.dh_ma = ddh.dh_ma
    WHERE ddh.dh_ma=$dh_ma
    GROUP BY ddh.dh_ma            
EOT;
    //Thực thi câu lệnh
    $result = mysqli_query($conn,$caulenh);
    $ds_dondathang = [];
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // echo($result['kh_ten']);
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


    //-----------------------------------------------------------------------------
    $sqlSelect = <<<EOT
    SELECT sp.sp_ten,
        nsx.nsx_ten,
        lsp.lsp_ten,
        spdh.sp_dh_soluong,spdh.sp_dh_dongia,(spdh.sp_dh_soluong * spdh.sp_dh_dongia) tongtien
    FROM sanpham_dondathang spdh
    JOIN sanpham sp ON spdh.sp_ma=sp.sp_ma
    JOIN nhasanxuat nsx ON nsx.nsx_ma = sp.nsx_ma
    JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma
    WHERE spdh.dh_ma = $dh_ma
EOT;

    $result1 = mysqli_query($conn,$sqlSelect);
    $ds_chitiet = [];
    while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
        $ds_chitiet[] = array(
            'sp_ten' => $row['sp_ten'],
            'nsx_ten' => $row['nsx_ten'],
            'lsp_ten' => $row['lsp_ten'],
            'sp_dh_soluong' => $row['sp_dh_soluong'],
            'sp_dh_dongia' => number_format($row['sp_dh_dongia'],0,".",",").'vnđ',
            'tongtien' => number_format($row['tongtien'],0,".",",").'vnđ',
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



        <b style="font-size: 20px; margin: 20px 5px; display:block;"><em><u>Chi tiết đơn hàng</u></em></b>
        <table border="1" width="100%" cellspacing="0">
            <tr>
                <td>STT</td>
                <td>Sản phẩm</td>
                <td>Số lượng</td>
                <td>Đơn giá</td>
                <td>Thành tiền</td>
            </tr>
            <?php $stt=1; ?>
            <?php foreach($ds_chitiet as $ct): ?>
                <tr>
                    <td><?= $stt ?></td>
                    <td>
                        <b><?= $ct['sp_ten'] ?></b><br>
                        <?= $ct['lsp_ten'] ?><br>
                        <?= $ct['nsx_ten'] ?>
                    </td>
                    <td><?= $ct['sp_dh_soluong'] ?></td>
                    <td style="text-align: right"><?= $ct['sp_dh_dongia'] ?></td>
                    <td style="text-align: right"><?= $ct['tongtien'] ?></td>
                </tr>
            <?php $stt++; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan='4' style="text-align: right">Tổng thành tiền:</td>
                <td style="text-align: right"><?= $ds_dondathang['Tong']?>VNĐ</td>
            </tr>
        </table>
    </section>
</body>
</html>