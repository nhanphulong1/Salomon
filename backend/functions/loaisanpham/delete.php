<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    if(!isset($_GET['lsp_ma'])) echo "<script>location.href = 'index.php';</script>";
    $lsp_ma=$_GET['lsp_ma'];

    $caulenh = "DELETE FROM loaisanpham WHERE lsp_ma=$lsp_ma";
    $result = mysqli_query($conn,$caulenh);
    echo "<script>location.href = 'index.php';</script>";
?>