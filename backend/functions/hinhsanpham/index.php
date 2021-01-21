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
                <h1>Danh sách Sản phẩm</h1>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <?php
                    //Ket noi du lieu
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    //Cau lenh
                    $caulenh = <<<EOT
                    SELECT * FROM hinhsanpham hsp
                    JOIN sanpham sp ON hsp.sp_ma=sp.sp_ma
EOT;
                    //Thực thi câu lệnh
                    $result = mysqli_query($conn,$caulenh);

                    //Lấy ra dữ liệu
                    $ds_sanpham =[];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $ds_hinhsanpham[] = array(
                          'sp_ten' => $row['sp_ten'],
                          'hsp_tentaptin' => $row['hsp_tentaptin'],
                          'hsp_ma' => $row['hsp_ma'],
                        );
                      }
                ?>

                <table id="tbhinhsanpham" border='1' width="100%" class="table table-bordered table-hover mt-2">
                    <thead>
                        <tr>
                            <th>MÃ</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình đại diện</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ds_hinhsanpham as $hsp):?>
                    <tr>
                        <td><?= $hsp['hsp_ma'] ?></td>
                        <td><?= $hsp['sp_ten'] ?></td>
                        <td>
                            <img src="/Salomon/assets/uploads/<?= $hsp['hsp_tentaptin'] ?>" width="50px" height="50px">
                        </td>
                        <td>
                            <a href="edit.php?hsp_ma=<?=$hsp['hsp_ma']; ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete.php?hsp_ma=<?=$hsp['hsp_ma']; ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
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
</body>
</html>