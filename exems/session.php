<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Học Session</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
        session_start();
        $_SESSION['tendangnhap']='daovannhan';
        $_SESSION['matkhau']='123456';
        $_SESSION['fullname']='Đào Văn Nhân';
    ?>
    <h1>PHP SESSION</h1>
</body>
</html>