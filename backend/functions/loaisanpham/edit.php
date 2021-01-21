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

    <?php
        if(!isset($_GET['lsp_ma'])) echo "<script>location.href = 'index.php';</script>";
        $lsp_ma=$_GET['lsp_ma'];

        include_once(__DIR__ . '/../../../dbconnect.php');

        $caulenhSelect = "SELECT lsp_ten,lsp_mota From loaisanpham WHERE lsp_ma = $lsp_ma" ;

        $resultSelect = mysqli_query($conn,$caulenhSelect);
        $Selectrow = mysqli_fetch_array($resultSelect,MYSQLI_ASSOC);
    ?>

    <div class="container-fulid">
        <div class="row">
            <div class="col-md-3">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-9 content">
                <h1>Hiệu chỉnh loại sản phẩm</h1>
                <form action="" method="post" name="frmLoaiSanPham" id="frmLoaiSanPham">
                    <label>Nhập tên LSP:</label><br>
                    <input type="text" name="lsp_ten" class="form-control" value="<?= $Selectrow['lsp_ten'] ?>"><br>
                    <label>Nhập mô tả:</label><br>
                    <textarea name="lsp_mota" class="form-control" rows="10"><?= $Selectrow['lsp_mota'] ?></textarea><br>
                    <button type="submit" name="btnLuu" class="btn btn-primary">Cập nhật sản phẩm</button>
                </form>

                <?php
                    if(isset($_POST['btnLuu'])){
                        $ten = $_POST['lsp_ten'];
                        $mota = $_POST['lsp_mota'];

                        // Kiểm tra ràng buộc dữ liệu (Validation)
                        // Tạo biến lỗi để chứa thông báo lỗi
                        $errors = [];

                        // Validate Tên loại Sản phẩm
                        // required
                        if (empty($ten)) {
                            $errors['lsp_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $ten,
                            'msg' => 'Vui lòng nhập tên Loại sản phẩm'
                            ];
                        }
                        // minlength 3
                        if (!empty($ten) && strlen($ten) < 3) {
                            $errors['lsp_ten'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 3,
                            'value' => $ten,
                            'msg' => 'Tên Loại sản phẩm phải có ít nhất 3 ký tự'
                            ];
                        }
                        // maxlength 50
                        if (!empty($ten) && strlen($ten) > 50) {
                            $errors['lsp_ten'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 50,
                            'value' => $ten,
                            'msg' => 'Tên Loại sản phẩm không được vượt quá 50 ký tự'
                            ];
                        }

                        // Validate Diễn giải
                        // required
                        if (empty($mota)) {
                            $errors['lsp_mota'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $mota,
                            'msg' => 'Vui lòng nhập mô tả Loại sản phẩm'
                            ];
                        }
                        // minlength 3
                        if (!empty($mota) && strlen($mota) < 3) {
                            $errors['lsp_mota'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 3,
                            'value' => $mota,
                            'msg' => 'Mô tả loại sản phẩm phải có ít nhất 3 ký tự'
                            ];
                        }
                        // maxlength 255
                        if (!empty($mota) && strlen($mota) > 255) {
                            $errors['lsp_mota'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 255,
                            'value' => $mota,
                            'msg' => 'Mô tả loại sản phẩm không được vượt quá 255 ký tự'
                            ];
                        }
                        }
                        ?>

                        <?php if (isset($_POST['btnLuu'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                            && isset($errors)         // Nếu biến $errors có tồn tại
                            && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
                        ) : ?>

                        <div id="errors-container" class="alert alert-danger face my-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                            <?php foreach ($errors as $fields) : ?>
                                <?php foreach ($fields as $field) : ?>
                                <li><?php echo $field['msg']; ?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php
                        if (
                            isset($_POST['btnLuu'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                            && (!isset($errors) || (empty($errors))) // Nếu biến $errors không tồn tại Hoặc giá trị của biến $errors rỗng
                          ) 
                        {

                                $caulenh = <<<EOT
                                UPDATE loaisanpham
                                SET
                                    lsp_ten='$ten',
                                    lsp_mota='$mota'
                                WHERE 
                                    lsp_ma= $lsp_ma;
EOT;

                                
                                $result = mysqli_query($conn,$caulenh);
                                if ($result) {
                                    echo "<script>alert('Cập nhật thành công'); location.href = 'index.php';</script>";
                                }
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