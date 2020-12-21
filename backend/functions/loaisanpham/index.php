<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Nhúng phần file head.php -->
    <?php include_once(__DIR__.'/../../layouts/head.php'); ?>
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
                <h1>Danh sách loại sản phẩm</h1>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <?php
                    //Ket noi du lieu
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    //Cau lenh
                    $caulenh = 'SELECT * From loaisanpham';
                    //Thực thi câu lệnh
                    $result = mysqli_query($conn,$caulenh);

                    //Lấy ra dữ liệu
                    $ds_loaisanpham =[];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $ds_loaisanpham[] = array(
                          'lsp_ma' => $row['lsp_ma'],
                          'lsp_ten' => $row['lsp_ten'],
                          'lsp_mota' => $row['lsp_mota'],
                        );
                      }
                ?>

                <table border='1' width="100%" class="table table-bordered table-hover mt-2">
                    <tr>
                        <th>Mã LSP</th>
                        <th>Tên LSP</th>
                        <th>Mô tả LSP</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <?php foreach ($ds_loaisanpham as $lsp):?>
                    <tr>
                        <td><?= $lsp['lsp_ma'] ?></td>
                        <td><?= $lsp['lsp_ten'] ?></td>
                        <td><?= $lsp['lsp_mota'] ?></td>
                        <td><a href="edit.php?lsp_ma=<?= $lsp['lsp_ma'] ?>" class="btn btn-warning">
                            <span data-feather="edit"></span>Sửa</a>
                        </td>
                        <td>
                            <a href="delete.php?lsp_ma=<?= $lsp['lsp_ma'] ?>" class="btn btn-danger">
                                <span data-feather="delete"></span> Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach?>
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
    <!-- <script src="..."></script> -->
</body>
</html>