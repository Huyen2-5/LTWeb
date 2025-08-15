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
  <title>Lập trình web - Theo dõi bài tập</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
  <style>
    :root { font-family: 'Montserrat', Arial, sans-serif; }
    body {
      margin: 0;
      background: linear-gradient(135deg, #23243a 0%, #2e2f4b 50%, #3a3b5c 100%);
      color: #e5e7eb;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .header {
      width: 100%;
      max-width: 1200px;
      margin-top: 40px;
      margin-bottom: 32px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }
    .info-left {
      position: absolute;
      left: 0;
      top: 0;
      display: flex;
      flex-direction: row;
      align-items: center;
      margin-left: 24px;
      margin-top: 4px;
      gap: 12px;
    }
    .clover {
      width: 38px;
      height: 38px;
      display: inline-block;
      margin-right: 2px;
    }
    .info-text {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }
    .name {
      font-weight: 700;
      font-size: 16px;
      color: #e5e7eb;
      letter-spacing: 1px;
      margin-bottom: 2px;
      opacity: 0.92;
    }
    .student-id {
      font-size: 13px;
      color: #b6bad6;
      font-weight: 400;
      margin-bottom: 2px;
      opacity: 0.8;
    }
    .title {
      font-family: 'Pacifico', cursive;
      font-size: 68px;
      font-weight: 700;
      letter-spacing: 2px;
      color: #b6bad6;
      text-shadow: 0 2px 18px #23243a, 0 1px 0 #e5e7eb;
      margin-bottom: 8px;
      text-align: center;
      line-height: 1.1;
      filter: drop-shadow(0 0 12px #3a3b5c);
    }
    .class-name {
      font-size: 16px;
      color: #b6bad6;
      font-weight: 400;
      text-align: center;
      margin-bottom: 2px;
      letter-spacing: 1px;
      opacity: 0.8;
    }
    .weeks-container {
      width: 100%;
      max-width: 1200px;
      display: flex;
      gap: 32px;
      justify-content: center;
      align-items: stretch;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }
    .week-box {
      background: linear-gradient(135deg, #2e2f4b 70%, #3a3b5c 100%);
      border-radius: 16px;
      border: 1px solid #b6bad6;
      box-shadow: 0 4px 24px #23243a80, 0 1px 0 #fff1;
      padding: 28px 24px 20px 24px;
      min-width: 220px;
      flex: 1 1 220px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      transition: box-shadow .18s, transform .18s, filter .18s, background .18s;
      overflow: hidden;
    }
    .week-box::before {
      content: "";
      position: absolute;
      top: -40px; left: -40px;
      width: 80px; height: 80px;
      background: radial-gradient(circle, #b6bad6 0%, transparent 70%);
      z-index: 0;
      pointer-events: none;
      transition: opacity .2s;
      opacity: 0.18;
    }
    .week-box:hover {
      box-shadow: 0 8px 32px #b6bad6a0, 0 1px 0 #fff;
      transform: translateY(-4px) scale(1.03);
      filter: brightness(1.12) saturate(1.1);
      background: linear-gradient(135deg, #3a3b5c 60%, #b6bad6 100%);
    }
    .week-box:hover::before {
      opacity: 0.32;
    }
    .week-title {
      font-size: 24px;
      font-weight: 700;
      color: #e5e7eb;
      margin-bottom: 18px;
      letter-spacing: 1px;
      text-shadow: 0 1px 6px #23243a;
      z-index: 1;
    }
    .tasks {
      display: flex;
      flex-direction: column;
      gap: 14px;
      width: 100%;
      align-items: center;
      z-index: 1;
    }
    .task-link {
      display: inline-block;
      padding: 12px 0;
      width: 90%;
      background: #23243a;
      border-radius: 8px;
      border: 1px solid #b6bad6;
      color: #e5e7eb;
      text-decoration: none;
      font-size: 18px;
      font-weight: 500;
      text-align: center;
      letter-spacing: 1px;
      box-shadow: 0 1px 8px #23243a80;
      transition: background .15s, border .15s, color .15s, filter .15s;
    }
    .task-link:hover {
      background: #3a3b5c;
      border-color: #b6bad6;
      color: #b6bad6;
      filter: brightness(1.12);
    }
    .week-empty {
      color: #b6bad6;
      font-size: 16px;
      margin-top: 6px;
      font-style: italic;
      letter-spacing: 1px;
      z-index: 1;
      opacity: 0.8;
    }
    @media (max-width: 900px) {
      .weeks-container { flex-direction: column; gap: 24px; }
      .week-box { min-width: 0; width: 100%; }
      .header { max-width: 98vw; }
      .info-left { position: static; margin-left: 0; margin-top: 0; align-items: center; }
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="info-left">
      <span class="clover">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g stroke="#b6bad6" stroke-width="2">
            <path d="M20 20 Q10 10 20 5 Q30 10 20 20 Z"/>
            <path d="M20 20 Q30 10 35 20 Q30 30 20 20 Z"/>
            <path d="M20 20 Q30 30 20 35 Q10 30 20 20 Z"/>
            <path d="M20 20 Q10 30 5 20 Q10 10 20 20 Z"/>
          </g>
        </svg>
      </span>
      <div class="info-text">
        <div class="name">Nguyễn Thị Huyên</div>
        <div class="student-id">223001739</div>
      </div>
    </div>
    <div class="title">Lập trình web</div>
    <div class="class-name">CNTT D2023A</div>
  </div>
  <div class="weeks-container">
    <div class="week-box">
      <div class="week-title">Tuần 1</div>
      <div class="tasks">
        <a class="task-link" href="Bai1.php">Bài tập 1</a>
        <a class="task-link" href="Bai2.php">Bài tập 2</a>
        <a class="task-link" href="Bai3.php">Bài tập 3</a>
      </div>
    </div>
    <div class="week-box">
      <div class="week-title">Tuần 2</div>
      <div class="week-empty">Chưa có bài tập</div>
    </div>
    <div class="week-box">
      <div class="week-title">Tuần 3</div>
      <div class="week-empty">Chưa có bài tập</div>
    </div>
    <div class="week-box">
      <div class="week-title">Tuần 4</div>
      <div class="week-empty">Chưa có bài tập</div>
    </div>
    <!-- Có thể thêm các tuần khác ở đây -->
  </div>
</body>
</html>
