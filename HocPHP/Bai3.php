<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Phép tính</title>
</head>
<body style="text-align:center; font-family:Arial;">
    <h2 style="color:blue;">PHÉP TÍNH TRÊN HAI SỐ</h2>

    <form action="ketquapheptinh.php" method="post">
        <p>
            <b style="color:red;">Chọn phép tính:</b>
            <input type="radio" name="pheptinh" value="Cộng" checked> Cộng
            <input type="radio" name="pheptinh" value="Trừ"> Trừ
            <input type="radio" name="pheptinh" value="Nhân"> Nhân
            <input type="radio" name="pheptinh" value="Chia"> Chia
            <input type="radio" name="pheptinh" value="Nguyên tố"> Kiểm tra nguyên tố
            <input type="radio" name="pheptinh" value="Chẵn"> Kiểm tra số chẵn
        </p>

        <p>Số thứ nhất: <input type="text" name="so1" required></p>
        <p>Số thứ hai: <input type="text" name="so2"></p>

        <p><input type="submit" value="Tính"></p>
    </form>
    <form action="index.php" method="get" style="margin-top:18px;">
        <input type="submit" value="Quay lại trang chủ" style="background:#e8f0ff; border-radius:8px; border:1px solid #c9dcff; padding:8px 20px;">
    </form>
</body>
</html>
