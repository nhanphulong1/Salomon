<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie trong PHP | Nền tảng VN</title>
    <style>
        .theme-light {
            background: #fff;
            color: #000;
        }

        .theme-dark {
            background: #000;
            color: #fff;
        }
    </style>

    <?php
    $theme_class = 'theme-light';
    // Kiểm tra xem Người dùng có cấu hình giao diện theo ý thích không?
    if (isset($_COOKIE['theme_class'])) {
        // Lấy thông tin từ COOKIE từ Web Browser của client gởi đến
        $theme_class = isset($_COOKIE['theme_class']) ? $_COOKIE['theme_class'] : 'theme-light';
    }
    ?>
</head>

<body class="<?= $theme_class ?>">
    <h1>Cấu hình Giao diện sử dụng Cookie trong PHP</h1>

    <!-- Form Login -->
    <form name="frmLogin" method="post" action="">

        <label><input type="radio" name="theme" id="theme-1" value="theme-light" checked />Giao diện nền Sáng</label><br />
        <label><input type="radio" name="theme" id="theme-2" value="theme-dark" />Giao diện nền Tối</label><br />
        <input type="submit" name="btnSave" value="Lưu" />
    </form>

<?php 
    if(isset($_POST['btnSave'])){
        $giaodien = $_POST['theme'];
        setcookie('theme_class',$giaodien,time() + 3600,'/');
        echo '<script> location.href = "giaodien.php"; </script>';
    }
?>


</body>

</html>