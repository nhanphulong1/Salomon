<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Thanh toán</h2>
    <?php session_start(); ?>
    <?php 
        if(isset($_SESSION['tendangnhap']))
            echo('Thanh toán bla bla .....');
        else{
        echo("Vui lòng đăng nhập để thanh toán!");
        sleep(2000);
        echo('<script>location.href = "dangnhap.php"; </script>');
        }
    ?>
</body>
</html>