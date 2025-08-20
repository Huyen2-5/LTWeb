<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    header('Location: index2.php');
    exit;
}
$data = $_SESSION['user_data'];
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Result</title>
<style>
:root { --radius:16px; --gap:16px; --pad:20px; --border:#e5e7eb; --text:#111827; --muted:#6b7280; }
*{box-sizing:border-box;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
body{background:linear-gradient(135deg, #23243a 0%, #2e2f4b 50%, #3a3b5c 100%);margin:0;padding:24px;color:var(--text)}
.result-box{
    background:linear-gradient(135deg, #2e2f4b 70%, #3a3b5c 100%);
    border-radius:18px;
    border:1px solid #b6bad6;
    box-shadow:0 4px 24px #23243a80, 0 1px 0 #fff1;
    padding:36px 32px 28px 32px;
    min-width:340px;
    max-width:500px;
    width:100%;
    margin:32px auto 24px auto;
    color:#e5e7eb;
}
.result-box h3{margin-top:0;color:#b6bad6;}
.result-box p{font-size:17px;margin:8px 0;}
.result-box ul{margin:0 0 8px 18px;}
.result-box img{max-width:220px;border-radius:12px;margin-top:12px;border:2px solid #b6bad6;}
.btns{display:flex;gap:12px;margin-top:10px}
.btn.secondary{padding:12px 18px;border-radius:12px;border:0;background:#e5e7eb;color:#111827;text-decoration:none;font-weight:700}
</style>
</head>
<body>
<div class="result-box">
    <h3>Thông tin bạn vừa nhập</h3>
    <p><b>First Name:</b> <?= htmlspecialchars($data['first_name']) ?></p>
    <p><b>Last Name:</b> <?= htmlspecialchars($data['last_name']) ?></p>
    <p><b>Email:</b> <?= htmlspecialchars($data['email']) ?></p>
    <p><b>Invoice ID:</b> <?= htmlspecialchars($data['invoice_id']) ?></p>
    <p><b>Pay For:</b>
        <ul>
        <?php foreach($data['pay_for'] as $pf): ?>
            <li><?= htmlspecialchars($pf) ?></li>
        <?php endforeach; ?>
        </ul>
    </p>
    <p><b>Additional Information:</b> <?= nl2br(htmlspecialchars($data['notes'])) ?></p>
    <p><b>Ảnh biên nhận:</b><br>
        <?php if ($data['file_url']): ?>
            <img src="<?= htmlspecialchars($data['file_url']) ?>" alt="Receipt">
        <?php else: ?>
            <span>Bạn chưa upload ảnh</span>
        <?php endif; ?>
    </p>
    <div class="btns">
        <a class="btn secondary" href="index2.php?reset=1">Back</a>
    </div>
</div>
</body>
</html>
