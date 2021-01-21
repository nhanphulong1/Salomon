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
                ?>

                <h2>Đăng nhập</h2>
                <form action="" name="frmDangNhap" id="frmDangNhap" method="post">
                    <div class="form-group">
                        <label for="">Tên đăng nhâp: </label>
                        <input type="text" name="tendangnhap" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mật Khẩu: </label>
                        <input type="text" name="matkhau" class="form-control">
                    </div>
                    <button type="submit" name="btnDangNhap" class="btn btn-info">Đăng nhập</button>
                </form>
            </div>
            <?php 
                if(isset($_POST['btnDangNhap'])){
                    $tendangnhap = addslashes($_POST['tendangnhap']);
                    $matkhau = addslashes($_POST['matkhau']);
                    $sqlDangNhap = <<<EOT
                    SELECT *
                    FROM khachhang
                    WHERE kh_tendangnhap = '$tendangnhap' AND kh_matkhau = '$matkhau'
EOT;
                    $result = mysqli_query($conn,$sqlDangNhap);
                    echo $sqlDangNhap;
                    if(mysqli_num_rows($result)>0){
                        echo mysqli_num_rows($result);
                        echo "Đăng nhập thành công!";
                    }else{
                        echo "Đăng nhập thất bại";
                    }
                }
            
            ?>
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
</body>
</html>