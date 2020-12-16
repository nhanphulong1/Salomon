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
        <label>Tên loại sản phẩm:</label><input type="text" name="lsp_ten"><br>
        <label>Mô tả:   </label><textarea name="lsp_mota" cols="30" rows="5"></textarea><br>
        <button type="submit" name="btnLuu">Sửa</button>
    </form>

    <?php
        if(isset($_POST['btnLuu'])){
            $ma = $_POST['lsp_ma'];
            $tenlsp = $_POST['lsp_ten'];
            $mota = $_POST['lsp_mota'];
            include_once 'dbconnect.php';
            $query = <<<EOT
            UPDATE loaisanpham
            SET
                lsp_ten=N'$tenlsp',
                lsp_mota=N'$mota'
            WHERE lsp_ma='$ma'
EOT;
            //Thực thi câu lệnh
            mysqli_query($conn,$query);
            echo "<p>Sửa thành công!</p>";
        }
    ?>
</body>
</html>