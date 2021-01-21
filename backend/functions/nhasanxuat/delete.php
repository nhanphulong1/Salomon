<?php 
    include_once (__DIR__ . '/../../../dbconnect.php');

    if(!isset($_GET['nsx_ma'])) echo "<script>location.href = 'index.php';</script>";
    $nsx_ma=$_GET['nsx_ma'];

    $caulenh = "DELETE FROM nhasanxuat WHERE nsx_ma=$nsx_ma";
    $result = mysqli_query($conn,$caulenh);
    echo "<script>location.href = 'index.php';</script>";
?>