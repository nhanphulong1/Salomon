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
        if(!isset($_GET['nsx_ma'])) echo "<script>location.href = 'index.php';</script>";
        $nsx_ma=$_GET['nsx_ma'];

        include_once(__DIR__ . '/../../../dbconnect.php');

        $caulenhSelect = "SELECT nsx_ten From nhasanxuat WHERE nsx_ma = $nsx_ma" ;

        $resultSelect = mysqli_query($conn,$caulenhSelect);
        $Selectrow = mysqli_fetch_array($resultSelect,MYSQLI_ASSOC);
    ?>

    <div class="container-fulid">
        <div class="row">
            <div class="col-md-3">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-9 content">
                <h1>Thêm nhà sản xuất</h1>
                <form action="" method="post" name="frmNhaSanXuat" id="frmNhaSanXuat">
                    <label>Nhập tên nsx:</label><br>
                    <input type="text" name="nsx_ten" class="form-control" value="<?= $Selectrow['nsx_ten'] ?>"><br>
                    <button type="submit" name="btnLuu" class="btn btn-primary">Lưu sản phẩm</button>
                </form>

                <?php
                    if(isset($_POST['btnLuu'])){
                        $ten = $_POST['nsx_ten'];

                        // Kiểm tra ràng buộc dữ liệu (Validation)
                        // Tạo biến lỗi để chứa thông báo lỗi
                        $errors = [];

                        // Validate Tên nhà sản xuất
                        // required
                        if (empty($ten)) {
                            $errors['nsx_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $ten,
                            'msg' => 'Vui lòng nhập tên nhà sản xuất'
                            ];
                        }
                        // minlength 3
                        if (!empty($ten) && strlen($ten) < 3) {
                            $errors['nsx_ten'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 3,
                            'value' => $ten,
                            'msg' => 'Tên nhà sản xuất phải có ít nhất 3 ký tự'
                            ];
                        }
                        // maxlength 50
                        if (!empty($ten) && strlen($ten) > 50) {
                            $errors['nsx_ten'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 50,
                            'value' => $ten,
                            'msg' => 'Tên nhà sản xuất không được vượt quá 50 ký tự'
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
                                UPDATE nhasanxuat
                                SET
                                    nsx_ten='$ten'
                                WHERE 
                                    nsx_ma= $nsx_ma;
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
            $("#frmNhaSanXuat").validate({
            rules: {
                nsx_ten: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                nsx_mota: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                }
            },
            messages: {
                nsx_ten: {
                    required: "Vui lòng nhập tên nhà sản xuất",
                    minlength: "Tên nhà sản xuất phải có ít nhất 3 ký tự",
                    maxlength: "Tên nhà sản xuất không được vượt quá 50 ký tự"
                },
                nsx_mota: {
                    required: "Vui lòng nhập mô tả cho nhà sản xuất",
                    minlength: "Mô tả cho nhà sản xuất phải có ít nhất 3 ký tự",
                    maxlength: "Mô tả cho nhà sản xuất không được vượt quá 255 ký tự"
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