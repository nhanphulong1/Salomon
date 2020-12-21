<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fulid">
        <div class="row">
            <div class="col-md-3">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php';) ?>
            </div>
            <div class="col-md-9 content">
                <h1>Danh sách sản phẩm</h1>
                <?php 
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $caulenh = 'SELECT * FROM sanpham sp JOIN loaisanpham lsp ON sp.lsp_ma=lsp.lsp_ma JOIN nhasanxuat nsx ON sp.nsx_ma = nsx.nsx_ma LEFT JOIN khuyenmai km ON km.km_ma = sp.km_ma ';
                    $result = mysqli_query($conn,$caulenh);

                    $ds_sanpham = []
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $ds_sanpham[] = array(
                            'sp_ma' => $row['sp_ma'],
                        );
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end Footer -->
    
    <!-- Nhúng file SCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/script.php'); ?>
</body>
</html>