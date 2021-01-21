<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dang nhap</title>
</head>
<body>
    <?php if(isset($_COOKIE['is_logged'])): ?>
        <h2>Xin chào <?= $_COOKIE['username_logged'] ?> đã quay lại!</h2>
    <?php else: ?>
    <h2>Đăng nhập</h2>
        <form action="" method="post" name='frmDangNhap'>
            <label for="txtusername">Tên đăng nhập:</label><br>
            <input type="text" name="txtusername" id="txtusername"><br>
            <label for="txtpassword">Mật khẩu:</label><br>
            <input type="password" name="txtpassword" id="txtpassword"><br>
            <input type="checkbox" name="remember_me" id="remember_me" value="1">Ghi nhớ <br>
            <button type="submit" name='btnLuu'>Đăng nhập</button>
        </form>
    <?php endif ?>
<?php
    if(isset($_POST['btnLuu'])){
        $user = $_POST['txtusername'];
        $pass = $_POST['txtpassword'];
        $remember = isset($_POST['remember_me']) ? 1:0;

        if($user == "nhan" && $pass == "123456"){
            echo "Đăng nhập thành công!";
            if($remember==1){
                // Thiết lập Cookie "Ghi nhớ đăng nhập" trong 15' ~ 3600s
                setcookie('is_logged', true, time()+ 40, '/');

                // Thiết lập Cookie "Tên username đã đăng nhập" trong 15' ~ 3600s
                setcookie("username_logged", $user, time()+40, "/","", 0);

                echo '<script> location.href = "dangnhap_cookies.php"; </script>';
            }
        }else{
            echo "Đăng nhập thất bại";
        }
    }
?>
</body>
</html>