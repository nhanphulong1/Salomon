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
                
                $hsp_ma = $_GET['hsp_ma'];
                
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

                $caulenhSelect = "SELECT * FROM hinhsanpham where hsp_ma=$hsp_ma";

                $resultSelect = mysqli_query($conn,$caulenhSelect);
                $hsp = mysqli_fetch_array($resultSelect,MYSQLI_ASSOC);
                $old_file = __DIR__ . '/../../../assets/uploads/'.$hsp['hsp_tentaptin'];
            ?>
            <div class="col-md-9 content">
                <h1>Thêm Hình Sản Phẩm</h1>
                <form action="" method="post" id="frm_InsertHinh" name="frm_InsertHinh" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Sản phẩm:</label>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                            <?php foreach ($dataSanPham as $sp): ?>
                            <option value="<?= $sp['sp_ma'] ?>" <?= ($hsp['sp_ma']==$sp['sp_ma'])? 'Selected':'' ?>  ><?= $sp['sp_ten'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="preview-img-container">
                        <img src="/Salomon/assets/uploads/<?= $hsp['hsp_tentaptin'] ?>" id="preview-img" width="200px" height="200px" />
                    </div>
                    <div class="form_group">
                        <label>Hình sản phẩm:</label>
                        <input type="file" name="hsp_tentaptin" id="hsp_tentaptin">
                    </div>
                    <div id="note" class="alert alert-warning" role="alert">(*)Nếu không đổi hình thì bỏ trống!</div>
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
                    $tenfile = $hsp['hsp_tentaptin'];
                }else{
                    $tenfile = date('YmdHis').'_'.$_FILES['hsp_tentaptin']['name'];
                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'],$diachi.$tenfile);
                    if(file_exists($old_file)){
                        unlink($old_file);
                    }
                }

                $sqlInsert = <<<EOT
                UPDATE hinhsanpham
                SET
                    hsp_tentaptin='$tenfile',
                    sp_ma=$sp_ma
                WHERE hsp_ma=$hsp_ma
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