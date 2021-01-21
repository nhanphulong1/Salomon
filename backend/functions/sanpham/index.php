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
                    SELECT * FROM sanpham sp
                    JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma
                    JOIN nhasanxuat nsx ON sp.nsx_ma = nsx.nsx_ma
                    LEFT JOIN khuyenmai km ON sp.km_ma = km.km_ma
EOT;
                    //Thực thi câu lệnh
                    $result = mysqli_query($conn,$caulenh);

                    //Lấy ra dữ liệu
                    $ds_sanpham =[];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $km_tomtat = '<span class="badge badge-danger">Không</span>';
                        if (!empty($row['km_ten'])) {
                            // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
                            $km_tomtat = sprintf(
                                "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                                $row['km_ten'],
                                $row['km_noidung'],
                                // Sử dụng hàm date($format, $timestamp) để chuyển đổi ngày thành định dạng Việt Nam (ngày/tháng/năm)
                                // Do hàm date() nhận vào là đối tượng thời gian, chúng ta cần sử dụng hàm strtotime() 
                                // để chuyển đổi từ chuỗi có định dạng 'yyyy-mm-dd' trong MYSQL thành đối tượng ngày tháng
                                date('d/m/Y', strtotime($row['km_tungay'])),    //vd: '2019-04-25'
                                date('d/m/Y', strtotime($row['km_denngay']))
                            );  //vd: '2019-05-10'
                        }
                        $ds_sanpham[] = array(
                          'sp_ma' => $row['sp_ma'],
                          'sp_ten' => $row['sp_ten'],
                          'sp_gia' => number_format($row['sp_gia'],2,".",",").' VND',
                          'sp_giacu' => number_format($row['sp_giacu'],2,".",",").' VND',
                          'sp_mota_ngan' => $row['sp_mota_ngan'],
                          'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                          'sp_ngaycapnhat' => date('d/m/Y H:i:s', strtotime($row['sp_ngaycapnhat'])),
                          'sp_soluong' => number_format($row['sp_soluong'],0,".","."),
                          'lsp_ma' => $row['lsp_ma'],
                          'nsx_ma' => $row['nsx_ma'],
                          'km_ma' => $row['km_ma'],
                          'lsp_ten' => $row['lsp_ten'],
                          'nsx_ten' => $row['nsx_ten'],
                          'km_tomtat' => $km_tomtat,
                        );
                      }
                ?>

                <table id="tbsanpham" border='1' width="100%" class="table table-bordered table-hover mt-2">
                    <thead>
                        <tr>
                            <th>Mã Sản phẩm</th>
                            <th>Tên Sản phẩm</th>
                            <th>Giá</th>
                            <th>Giá cũ</th>
                            <th>Mô tả</th>
                            <th>Ngày cập nhật</th>
                            <th>Số lượng</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhà sản xuất</th>
                            <th>Khuyến mãi</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ds_sanpham as $sp):?>
                    <tr>
                        <td><?= $sp['sp_ma'] ?></td>
                        <td><?= $sp['sp_ten'] ?></td>
                        <td><?= $sp['sp_gia'] ?></td>
                        <td><?= $sp['sp_giacu'] ?></td>
                        <td><?= $sp['sp_mota_ngan'] ?></td>
                        <td><?= $sp['sp_ngaycapnhat'] ?></td>
                        <td><?= $sp['sp_soluong'] ?></td>
                        <td><?= $sp['lsp_ten'] ?></td>
                        <td><?= $sp['nsx_ten'] ?></td>
                        <td><?= $sp['km_tomtat'] ?></td>
                        <td><a href="edit.php?sp_ma=<?= $sp['sp_ma'] ?>" class="btn btn-warning">
                            <span data-feather="edit"></span>Sửa</a>
                        </td>
                        <td>
                            <a href="delete.php?sp_ma=<?= $sp['sp_ma'] ?>" class="btn btn-danger">
                                <span data-feather="delete"></span> Xóa
                            </a>
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
    <script src="/salomon/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script>
        $(function(){
            $('#tbsanpham').DataTable({

                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>
</html>