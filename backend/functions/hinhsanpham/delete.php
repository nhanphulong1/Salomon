<?php
    $hsp_ma = $_GET['hsp_ma'];

    include_once(__DIR__ . '/../../../dbconnect.php');

    $caulenhSelect = "SELECT * FROM hinhsanpham where hsp_ma=$hsp_ma";

    $resultSelect = mysqli_query($conn,$caulenhSelect);
    $hsp = mysqli_fetch_array($resultSelect,MYSQLI_ASSOC);

    $old_file = __DIR__ . '/../../../assets/uploads/'.$hsp['hsp_tentaptin'];

    $caulenhDelete = <<<EOT
    DELETE FROM hinhsanpham WHERE hsp_ma=$hsp_ma;
EOT;
    $resultDelete = mysqli_query($conn,$caulenhDelete);
    if($resultDelete && file_exists($old_file)){
        unlink($old_file);
    }
    echo "<script>location.href = 'index.php';</script>";
?>