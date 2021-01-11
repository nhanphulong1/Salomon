<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php session_start(); ?>
    <h2>Đăng nhập</h2>
    <?php if(!isset($_SESSION['tendangnhap'])): ?>
        <form action="" method="post" name='frmDangNhap'>
            <label for="txtusername">Tên đăng nhập:</label><br>
            <input type="text" name="txtusername" id="txtusername"><br>
            <label for="txtpassword">Mật khẩu:</label><br>
            <input type="password" name="txtpassword" id="txtpassword"><br>
            <button type="submit" name='btnLuu'>Đăng nhập</button>
        </form>
    <?php else: ?>
        <h3>Bạn đã đăng nhập!! Vui lòng nhấn vào <a href="#">đây</a> để quay về trang chủ.</h3>
        <a href="dangxuat.php">Đăng xuất</a>
    <?php endif ?>


    <?php
        if (isset($_POST['btnLuu'])) {
            $user = $_POST['txtusername'];
            $pass = $_POST['txtpassword'];

            if($user == 'admin' && $pass=='123456'){
                echo('Đăng nhập thành công!!');

                $_SESSION['tendangnhap']=$user;
            }else{
                echo('Đăng nhập thất bại!!');
            }
        }
    ?>
</body>
</html>