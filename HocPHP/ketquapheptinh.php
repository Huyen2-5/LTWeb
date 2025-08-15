<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kết quả phép tính</title>
</head>
<body style="text-align:center; font-family:Arial;">
    <h2 style="color:blue;">PHÉP TÍNH TRÊN HAI SỐ</h2>

    <?php
    require 'functions.php'; // File chứa các hàm tính toán

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $so1 = $_POST["so1"];
        $so2 = isset($_POST["so2"]) ? $_POST["so2"] : "";
        $pheptinh = $_POST["pheptinh"];
        $ketqua = "";

        switch ($pheptinh) {
            case "Cộng":
                $ketqua = tinh_tong($so1, $so2);
                break;
            case "Trừ":
                $ketqua = tinh_hieu($so1, $so2);
                break;
            case "Nhân":
                $ketqua = tinh_tich($so1, $so2);
                break;
            case "Chia":
                $ketqua = tinh_thuong($so1, $so2);
                break;
            case "Nguyên tố":
                $ketqua = la_nguyen_to($so1) ? "$so1 là số nguyên tố" : "$so1 không phải số nguyên tố";
                break;
            case "Chẵn":
                $ketqua = la_so_chan($so1) ? "$so1 là số chẵn" : "$so1 là số lẻ";
                break;
        }

        echo "<p><b style='color:red;'>Chọn phép tính:</b> $pheptinh</p>";
        echo "<p>Số 1: <input type='text' value='$so1' readonly></p>";
        if ($pheptinh != "Nguyên tố" && $pheptinh != "Chẵn") {
            echo "<p>Số 2: <input type='text' value='$so2' readonly></p>";
        }
        echo "<p>Kết quả: <input type='text' value='$ketqua' readonly></p>";

        // Nút quay lại bài 3
        echo "<form action='Bai3.php' method='get' style='margin-bottom:16px;'>
                <input type='submit' value='Quay lại trang trước'>
              </form>";
        // Nút quay lại trang chủ
        echo "<form action='index.php' method='get'>
                <input type='submit' value='Quay lại trang chủ' style='background:#e8f0ff; border-radius:8px; border:1px solid #c9dcff; padding:8px 20px; margin-top:8px;'>
              </form>";
    }
    ?>
</body>
</html>
