<?php

include_once(__DIR__.'/../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlquantitySanPham = <<<EOT
    SELECT lsp_ten,COUNT(*) AS quantity
    FROM sanpham sp JOIN loaisanpham lsp
    ON sp.lsp_ma = lsp.lsp_ma
    GROUP BY lsp_ten
EOT;

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlquantitySanPham);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $dataquantitySanPham[] = array(
        'lsp_ten' => $row['lsp_ten'],
        'quantity' => $row['quantity']
    );
}

echo json_encode($dataquantitySanPham);

?>