<?php

// Lấy tham số bài (nếu có)
$bai = isset($_GET['bai']) ? (int) $_GET['bai'] : 0;

// Nội dung demo cho từng bài (bạn có thể sửa theo ý)
function noiDungBai($bai) {
    switch ($bai) {
        case 1:
            return "<h2>Bài 1</h2><p>Đây là nội dung mẫu cho Bài 1. Bạn thay nội dung theo yêu cầu.</p>";
        case 2:
            return "<h2>Bài 2</h2><p>Đây là nội dung mẫu cho Bài 2. Bạn thay nội dung theo yêu cầu.</p>";
        case 3:
            return "<h2>Bài 3</h2><p>Đây là nội dung mẫu cho Bài 3. Bạn thay nội dung theo yêu cầu.</p>";
        default:
            return "<h2>Chọn một bài để xem</h2><p>Hãy nhấp vào Bài 1, Bài 2 hoặc Bài 3 ở bên trên.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Trang chủ</title>
  <style>
    :root { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
    body { 
      margin: 0; 
      background: #f7f7f8; 
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container { max-width: 1200px; width: 100%; margin: 32px auto; padding: 16px; }
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,.04); }
    .header { padding: 32px 40px 16px 40px; border-bottom: 1px solid #eee; }
    .title { margin: 0; font-size: 32px; text-align: center; }
    .nav { display: flex; gap: 24px; justify-content: center; margin: 24px 0 0 0; }
    .btn {
      display: inline-block; text-decoration: none; padding: 16px 32px; border: 1px solid #e5e7eb;
      border-radius: 10px; background: #fafafa; transition: transform .04s ease, background .15s ease;
      font-size: 18px;
    }
    .btn:hover { background: #f0f0f0; transform: translateY(-1px); }
    .btn.active { background: #e8f0ff; border-color: #c9dcff; }
    .content { padding: 32px 40px; }
    .footer { padding: 14px 40px; border-top: 1px solid #eee; color: #6b7280; font-size: 14px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="header">
        <h1 class="title">Trang chủ</h1>
        <nav class="nav">
          <a class="btn <?php echo $bai===1?'active':''; ?>" href="Bai1.php">Bài 1</a>
          <a class="btn <?php echo $bai===2?'active':''; ?>" href="Bai2.php">Bài 2</a>
          <a class="btn <?php echo $bai===3?'active':''; ?>" href="Bai3.php">Bài 3</a>
        </nav>
      </div>

      <div class="content">
        <?php echo noiDungBai($bai); ?>

        <?php if ($bai !== 0): ?>
          <p><a class="btn" href="trangchu.php">Quay lại trang chủ</a></p>
        <?php endif; ?>
      </div>

      <div class="footer">
      </div>
    </div>
  </div>
</body>
</html>
