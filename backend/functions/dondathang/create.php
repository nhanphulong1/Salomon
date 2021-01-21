<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Nhúng phần file head.php -->
    <?php include_once(__DIR__.'/../../layouts/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="/salomon/assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/salomon/assets/vendor/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css">
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            <!-- sidebar -->
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->
            </div>
            <!-- Content -->
            <div class="col-md-9">
                <?php
                //Ket noi du lieu
                include_once(__DIR__ . '/../../../dbconnect.php');
                //Cau lệnh
                $sql = <<<EOT
                    SELECT * FROM khachhang
EOT;
                $result = mysqli_query($conn,$sql);
                $kh = [];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $kh[] = array(
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_ten' => $row['kh_ten'],
                        'kh_dienthoai' => $row['kh_dienthoai'],
                        'kh_diachi' => $row['kh_diachi']
                    );
                }


                $sql1 = <<<EOT
                    SELECT * FROM hinhthucthanhtoan
EOT;
                $result = mysqli_query($conn,$sql1);
                $httt = [];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $httt[] = array(
                        'httt_ma' => $row['httt_ma'],
                        'httt_ten' => $row['httt_ten'],
                    );
                }

                $sql2 = <<<EOT
                    SELECT * FROM sanpham
EOT;
                $result = mysqli_query($conn,$sql2);
                $sp=[];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $sp[] = array(
                        'sp_ma' => $row['sp_ma'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => $row['sp_gia']
                    );
                }


                ?>
                <h2>Thêm mới đơn hàng</h2>
                <form action="" method="post" name="frmDonHang" id="frmDonHang">

                    <h4>Thông tin đơn hàng</h4>

                    <div class="form-group">
                        <label for="">Khách hàng</label>
                        <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                            <?php foreach($kh as $ct): ?>
                                <option value="<?= $ct['kh_tendangnhap'] ?>"><?= $ct['kh_ten']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Ngày lập</label>
                            <input type="date" name="dh_ngaylap" id="dh_ngaylap" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">Ngày giao</label>
                            <input type="date" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">Nơi giao</label>
                            <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Trạng thái thanh toán</label> <br>
                            <input type="radio" value="0" name="dh_trangthaithanhtoan" checked> Chưa thanh toán  
                            <input type="radio" vaule="1" name="dh_trangthaithanhtoan"> Đã thanh toán
                        </div>
                        <div class="form-group col">
                            <label for="">Hình thức thanh toán</label> <br>
                            <select name="httt_ma" id="httt_ma" class="form-control">
                            <?php foreach($httt as $ct1): ?>
                                <option value="<?= $ct1['httt_ma'] ?>"><?= $ct1['httt_ten']?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>

                    <br>
                    <h4>Thông tin chi tiết đơn hàng</h4>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Sản phẩm</label> <br>
                            <select name="sp_ma" id="sp_ma" class="form-control">
                            <?php foreach($sp as $ct): ?>
                                <option value="<?= $ct['sp_ma'] ?>" data-gia=<?= $ct['sp_gia'] ?>><?= $ct['sp_ten'].' + '.number_format($ct['sp_gia'],0,".",",").'VNĐ' ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Số lượng</label><br>
                            <input type="number" name="sp_dh_soluong" id="sp_dh_soluong" value="1" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">Thêm vào giỏ hàng</label> <br>
                            <button type="button" class="btn btn-danger" id="btnThem" name="btnThem">Thêm vào đơn hàng</button>
                        </div>
                    </div>

                    <table id="tblDonHang" class="table table-hover">
                        <thead>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" input="submit" id="btnSave" name="btnSave">Thêm đơn hàng</button>
                </form>
                <?php
                    //Thêm dữ liệu vào bảng đơn đặt hàng
                    if(isset($_POST['btnSave'])){
                        $kh_tendangnhap = $_POST['kh_tendangnhap'];
                        $dh_ngaylap = $_POST['dh_ngaylap'];
                        $dh_ngaygiao = $_POST['dh_ngaygiao'];
                        $dh_noigiao = $_POST['dh_noigiao'];
                        $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                        $httt_ma = $_POST['httt_ma'];

                        $sqlDonHang = <<<EOT
                        INSERT INTO dondathang
                        (dh_ngaylap, dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, httt_ma, kh_tendangnhap)
                        VALUES ('$dh_ngaylap', '$dh_ngaygiao', '$dh_noigiao', $dh_trangthaithanhtoan, $httt_ma, '$kh_tendangnhap')
EOT;

                        $result= mysqli_query($conn,$sqlDonHang);


                        //Thêm dữ liệu vào bảng đơn hàng - sản phẩm
                        $arr_sanpham_ma = $_POST['sp_ma1'];
                        $arr_sanpham_gia = $_POST['sp_dh_dongia'];
                        $arr_sanpham_soluong = $_POST['sp_dh_soluong'];
                        $dh_ma = $conn->insert_id;
                        for ($i=0; $i < count($arr_sanpham_ma); $i++) { 
                            $sp_ma = $arr_sanpham_ma[$i];
                            $sp_gia = $arr_sanpham_gia[$i];
                            $sp_dh_soluong = $arr_sanpham_soluong[$i];

                            //Câu lệnh Insert
                            $sqlDHSL=<<<EOT
                            INSERT INTO sanpham_dondathang
                            (sp_ma, dh_ma, sp_dh_soluong, sp_dh_dongia)
                            VALUES ($sp_ma, $dh_ma, $sp_dh_soluong, $sp_gia)
EOT;
                            //Thực thi câu lệnh
                            $result = mysqli_query($conn,$sqlDHSL);
                        }
                    }
                ?>
            </div>
            <!-- end Content -->
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/script.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- <script src="..."></script> -->
    <script src="/salomon/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script>
        $('#btnThem').click(function(){
            var sp_ma = $('#sp_ma').val();
            var sp_ten = $('#sp_ma option:selected').text();
            var sp_gia = $('#sp_ma option:selected').data('gia');
            var soluong = $('#sp_dh_soluong').val();
            var thanhtien = sp_gia * soluong;

            var htmlTemplate = '<tr>'; 
            htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_ma1[]" value="' + sp_ma + '"/></td>';
            htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
            htmlTemplate += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
            htmlTemplate += '<td>' + thanhtien + '</td>';
            htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
            htmlTemplate += '</tr>';
            
            $('#tblDonHang tbody').append(htmlTemplate);
        });
    </script>
</body>
</html>