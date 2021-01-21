<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fulid">
        <div class="row">
            <div class="col-md-3">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                //Loại sản phẩm
                $query_sp="select * from sanpham";

                $result_sp=mysqli_query($conn,$query_sp);

                $dataSanPham = [];
                while ($rowSanPham = mysqli_fetch_array($result_sp, MYSQLI_ASSOC)) {
                    $dataSanPham[] = array(
                        'sp_ma' => $rowSanPham['sp_ma'],
                        'sp_ten' => $rowSanPham['sp_ten'],
                    );
                }
            ?>
            <div class="col-md-9 content">
                <h1>Thêm Hình Sản Phẩm</h1>
                <form action="" method="post" id="frm_InsertHinh" name="frm_InsertHinh" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Sản phẩm:</label>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                            <?php foreach ($dataSanPham as $sp): ?>
                            <option value="<?= $sp['sp_ma'] ?>"><?= $sp['sp_ten'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="preview-img-container">
                        <img src="/Salomon/assets/uploads/default.png" id="preview-img" width="200px" height="200px" />
                    </div>
                    <div class="form_group">
                        <label>Hình sản phẩm:</label>
                        <input type="file" name="hsp_tentaptin" id="hsp_tentaptin">
                    </div>
                    <div class="form_group">
                        <button type="submit" name="btn_Luu" class="btn btn-primary">Lưu Hình</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['btn_Luu'])){
            $sp_ma = $_POST['sp_ma'];
            //Kiểm tra có hình chưa
            if(isset($_FILES['hsp_tentaptin'])){
                $diachi = __DIR__ . '/../../../assets/uploads/';
                //Kiểm tra upload hình có bị lỗi
                if($_FILES['hsp_tentaptin']['error']>0){
                    echo 'Upload lỗi!!';die;
                }else{
                    $tenfile = date('YmdHis').'_'.$_FILES['hsp_tentaptin']['name'];
                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'],$diachi.$tenfile);


                }

                $sqlInsert = <<<EOT
                INSERT INTO hinhsanpham
                (hsp_tentaptin, sp_ma)
                VALUES ('$tenfile', $sp_ma)
EOT;
                mysqli_query($conn,$sqlInsert);
                echo "<script>location.href = 'index.php';</script>";
            }
        }
    ?>

    <!-- Footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end Footer -->
    
    <!-- Nhúng file SCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/script.php'); ?>
    <!-- Script riêng -->
    <script>
    // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
    const reader = new FileReader();
    const fileInput = document.getElementById("hsp_tentaptin");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
      img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
      const f = e.target.files[0];
      reader.readAsDataURL(f);
    })
  </script>
</body>
</html>