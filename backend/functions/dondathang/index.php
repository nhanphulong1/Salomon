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
                <h1>Danh sách nhà sản xuất</h1>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
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

                    //Lấy ra dữ liệu
                    $ds_dondathang =[];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $ds_dondathang[] = array(
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
                <table id="tbdonhang" class="table table-hover">
                      <thead>
                        <tr>
                            <th>Mã đơn khách hàng</th>
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Ngày giao</th>
                            <th>Nơi giao</th>
                            <th>Hình thức thanh toán</th>
                            <th>Tổng thanh toán</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Hành động</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($ds_dondathang as $row): ?>
                            <tr>
                                <td class="text-center"><?= $row['dh_ma'] ?></td>
                                <td><?= $row['kh_ten'] ?></td>
                                <td><?= $row['dh_ngaylap'] ?></td>
                                <td><?= $row['dh_ngaygiao'] ?></td>
                                <td><?= $row['dh_noigiao'] ?></td>
                                <td>
                                <span class="badge badge-pill badge-primary"><?= $row['httt_ten'] ?></span>
                                </td>
                                <td class="text-right"><?= $row['Tong'] ?> VNĐ</td>
                                <td>
                                    <?php if($row['dh_trangthaithanhtoan'] == 0): ?>
                                        <span class="badge badge-pill badge-danger">Chưa xử lý</span>
                                    <?php else: ?>
                                        <span class="badge badge-pill badge-success">Đã xử lý</span>
                                    <?php endif; ?>
                                </td>
                                <td><a href="./print.php?dh_ma=<?= $row['dh_ma'] ?>" class="btn btn-info">In</a></td>
                            </tr>
                        <?php endforeach; ?>
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
    <!-- <script src="..."></script> -->
    <script src="/salomon/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script>
        $(function(){
            $('#tbdonhang').DataTable({

                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>
</html>