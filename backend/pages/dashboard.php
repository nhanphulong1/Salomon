<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Nhúng phần file head.php -->
    <?php include_once(__DIR__.'/../layouts/head.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            <!-- sidebar -->
                <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->
            </div>
            <!-- Content -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <div class="bg-primary">
                            <h1 id="baocaoSanPham_SoLuong">0</h1>
                            <p>Tổng số mặt hàng</p>
                        </div>
                        <button id="getDuLieuBaoCaoTongSoMatHang" class='btn-primary btn'>Refesh tổng sản phẩm</button>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-success">
                            <h1 id="baocaoKhachHang_SoLuong">0</h1>
                            <p>Tổng số khách hàng</p>
                        </div>
                        <button id="getDuLieuBaoCaoTongSoKhachHang" class='btn-success btn'>Refesh tổng khách hàng</button>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-warning">
                            <h1 id="baocaoGopY_SoLuong">0</h1>
                            <p>Tổng số góp ý</p>
                        </div>
                        <button id="getDuLieuBaoCaoTongSoGopY" class='btn-warning btn'>Refesh tổng góp ý</button>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-danger">
                            <h1 id="baocaoDonHang_SoLuong">0</h1>
                            <p>Tổng số đơn hàng</p>
                        </div>
                        <button id="getDuLieuBaoCaoTongSoDonHang" class='btn-danger btn'>Refesh tổng đơn hàng</button>
                    </div>
                </div>
            </div>
            <!-- end Content -->
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../layouts/script.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- <script src="..."></script> -->
    <script>
        $(document).ready(function(){
            //Tong số mặt hàng
            $('#getDuLieuBaoCaoTongSoMatHang').click(function(){
                $.ajax('/Salomon/ajax/baocao-tongsomathang-ajax.php',{
                    success: function(data){
                        var dataObj = JSON.parse(data);
                        var htmlTSMH =  dataObj[0].quantity;
                        $('#baocaoSanPham_SoLuong').html(htmlTSMH);
                    },
                    error: function() {
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#baocaoSanPham_SoLuong').html(htmlString);
                    }
                });
            })


            //Tổng số khách hàng
            $('#getDuLieuBaoCaoTongSoKhachHang').click(function(){
                $.ajax('/Salomon/ajax/baocao-tongsokhachhang-ajax.php',{
                    success: function(data){
                        var dataObj = JSON.parse(data);
                        var htmlTSMH =  dataObj[0].quantity;
                        $('#baocaoKhachHang_SoLuong').html(htmlTSMH);
                    },
                    error: function() {
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#baocaoKhachHang_SoLuong').html(htmlString);
                    }
                });
            })

            //Tổng số góp ý
            $('#getDuLieuBaoCaoTongSoGopY').click(function(){
                $.ajax('/Salomon/ajax/baocao-tongsogopy-ajax.php',{
                    success: function(data){
                        var dataObj = JSON.parse(data);
                        var htmlTSMH =  dataObj[0].quantity;
                        $('#baocaoGopY_SoLuong').html(htmlTSMH);
                    },
                    error: function() {
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#baocaoGopY_SoLuong').html(htmlString);
                    }
                });
            })

            //Tổng số đơn hàng
            $('#getDuLieuBaoCaoTongSoDonHang').click(function(){
                $.ajax('/Salomon/ajax/baocao-tongsodonhang-ajax.php',{
                    success: function(data){
                        var dataObj = JSON.parse(data);
                        var htmlTSMH =  dataObj[0].quantity;
                        $('#baocaoDonHang_SoLuong').html(htmlTSMH);
                    },
                    error: function() {
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#baocaoDonHang_SoLuong').html(htmlString);
                    }
                });
            })
        });
    </script>
</body>
</html>