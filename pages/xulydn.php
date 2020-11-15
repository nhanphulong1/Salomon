<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xử lý</title>
</head>
<body>
    <?php
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $fullname = $_POST['fullname'];
        echo '<h1>Chúc mừng "'.$fullname.'" đăng ký thành công!</h1>';
    ?>
</body>
</html>