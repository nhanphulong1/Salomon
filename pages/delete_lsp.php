<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm loại sản phẩm</title>
</head>
<body>
    <h1>Cập nhật loại sản phẩm</h1>
    <form name="frmThem" id="frmThem" action="" method="post">
        <label>Mã loại sản phẩm:</label><input type="text" name="lsp_ma"><br>
        <button type="submit" name="btnLuu">Xóa</button>
    </form>

    <?php
        if(isset($_POST['btnLuu'])){
            $ma = $_POST['lsp_ma'];
            include_once 'dbconnect.php';
            $query = <<<EOT
            DELETE FROM loaisanpham 
            WHERE lsp_ma=$ma
EOT;
            //Thực thi câu lệnh
            mysqli_query($conn,$query);
            echo "<p>Xóa thành công!</p>";
        }
    ?>
</body>
</html>