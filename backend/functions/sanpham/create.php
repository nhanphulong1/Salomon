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
                $query_lsp="select * from loaisanpham";

                $result_lsp=mysqli_query($conn,$query_lsp);

                $dataLoaiSanPham = [];
                while ($rowLoaiSanPham = mysqli_fetch_array($result_lsp, MYSQLI_ASSOC)) {
                    $dataLoaiSanPham[] = array(
                        'lsp_ma' => $rowLoaiSanPham['lsp_ma'],
                        'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                        // 'lsp_mota' => $rowLoaiSanPham['lsp_mota'],
                    );
                }

                //Nhà sản xuất
                $query_nsx="select * from nhasanxuat";

                $result_nsx=mysqli_query($conn,$query_nsx);

                $dataNhaSanXuat = [];
                while ($rowNhaSanXuat = mysqli_fetch_array($result_nsx, MYSQLI_ASSOC)) {
                    $dataNhaSanXuat[] = array(
                        'nsx_ma' => $rowNhaSanXuat['nsx_ma'],
                        'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
                        // 'lsp_mota' => $rowLoaiSanPham['lsp_mota'],
                    );
                }

                //Khuyến mãi

                $query_km="select * from khuyenmai";

                $result_km=mysqli_query($conn,$query_km);

                $dataKhuyenMai = [];
                while ($rowKhuyenMai = mysqli_fetch_array($result_nsx, MYSQLI_ASSOC)) {
                    $dataKhuyenMai[] = array(
                        'km_ma' => $rowKhuyenMai['km_ma'],
                        'km_ten' => $rowKhuyenMai['km_ten'],
                        'km_noidung' => $rowKhuyenMai['km_noidung'],
                        // 'lsp_mota' => $rowLoaiSanPham['lsp_mota'],
                    );
                }

            ?>
            <div class="col-md-9 content">
                <h1>Thêm sản phẩm mới</h1>
                <form action="" method="post" name="frmSanPham" id="frmSanPham">
                    <label>Nhập tên SP:</label><br>
                    <input type="text" name="sp_ten" class="form-control"><br>
                    <label>Nhập giá SP:</label><br>
                    <input type="number" name="sp_gia" min="0" value="0" class="form-control"><br>
                    <label>Nhập mô tả ngắn:</label><br>
                    <input type="text" name="sp_mota_ngan" class="form-control"><br>
                    <label>Nhập mô tả chi tiết:</label><br>
                    <textarea name="sp_mota_chitiet" class="form-control" rows="6"></textarea><br>
                    <label>Nhập số lượng SP:</label><br>
                    <input type="number" name="sp_soluong" min="0" value="0" class="form-control"><br>
                    <label>Nhập loại sản phẩm:</label><br>
                    <select name='lsp_ma' class="form-control">
                        <?php foreach($result_lsp as $lsp): ?>
                        <option value="<?= $lsp['lsp_ma'] ?>"><?= $lsp['lsp_ten'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <select name='nsx_ma' class="form-control">
                        <?php foreach($result_nsx as $nsx): ?>
                        <option value="<?= $nsx['nsx_ma'] ?>"><?= $nsx['nsx_ten'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <select name='km_ma' class="form-control">
                        <option value="">Không khuyến mãi...</option>
                        <?php foreach($result_km as $km): ?>
                        <option value="<?= $km['km_ma'] ?>"><?= $km['km_noidung'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <button type="submit" name="btnLuu" class="btn btn-primary">Lưu sản phẩm</button>
                </form>
                        <?php
                        if ( isset($_POST['btnLuu']) ) 
                        {
                            $sp_ten=$_POST['sp_ten'];
                            $sp_gia=$_POST['sp_gia'];
                            $sp_mota_ngan=$_POST['sp_mota_ngan'];
                            $sp_mota_chitiet=$_POST['sp_mota_chitiet'];
                            $sp_soluong=$_POST['sp_soluong'];
                            $lsp_ma=$_POST['lsp_ma'];
                            $nsx_ma=$_POST['nsx_ma'];
                            $km_ma= (empty($_POST['km_ma']) ? 'NULL':$_POST['km_ma']);
                                $caulenh = <<<EOT
                                INSERT INTO sanpham
                                (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma)
                                VALUES ('$sp_ten', $sp_gia, 0, '$sp_mota_ngan', '$sp_mota_chitiet', NOW(), $sp_soluong, $lsp_ma, $nsx_ma, $km_ma)
EOT;
                                $result = mysqli_query($conn,$caulenh);
                                echo "<script>location.href = 'index.php';</script>";
                        }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end Footer -->
    
    <!-- Nhúng file SCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/script.php'); ?>
    <!-- Script riêng -->
    <!-- <script>
        $(document).ready(function() {
            $("#frmLoaiSanPham").validate({
            rules: {
                lsp_ten: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                lsp_mota: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                }
            },
            messages: {
                lsp_ten: {
                    required: "Vui lòng nhập tên Loại sản phẩm",
                    minlength: "Tên Loại sản phẩm phải có ít nhất 3 ký tự",
                    maxlength: "Tên Loại sản phẩm không được vượt quá 50 ký tự"
                },
                lsp_mota: {
                    required: "Vui lòng nhập mô tả cho Loại sản phẩm",
                    minlength: "Mô tả cho Loại sản phẩm phải có ít nhất 3 ký tự",
                    maxlength: "Mô tả cho Loại sản phẩm không được vượt quá 255 ký tự"
                },
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Thêm class `invalid-feedback` cho field đang có lỗi
                error.addClass("invalid-feedback");
                if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
                } else {
                error.insertAfter(element);
                }
            },
            success: function(label, element) {},
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
            });
        });
    </script> -->
</body>
</html>