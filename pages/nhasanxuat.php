<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nhà sản xuất</title>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>

    <?php
        //kết nối db
        include_once 'dbconnect.php';
        //câu lệnh query
        $query = "insert into nhasanxuat(nsx_ten) values (N'Xiaomi')";
        //Thực thi câu lệnh
        mysqli_query($conn,$query);
        echo "<p>Thêm thành công!</p>"
    ?>


</body>
</html>