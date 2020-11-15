<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    
</head>
<body>
    <div>
        <h1>Đăng nhập</h1>
        <form method="POST" action="">
            <label>Tên đăng nhập:</label> <input type="text" name="user"><br>
            <label>Mật khẩu:</label> <input type="password" name="pass"><br>
            <input type="submit" name="btnLogin" value="Đăng nhập">
            <br>
            <br><br>
        </form>
    </div>
    <?php
        if(isset($_POST['btnLogin'])){
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if($user == 'admin' && $pass=='123')
                echo '<h1>Thành công</h1>';
            else
                echo '<h1>Thất bại</h1>';
        }
    ?>
</body>
</html>