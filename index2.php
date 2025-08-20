<?php
session_start();

if (isset($_GET['reset'])) {
    if (isset($_SESSION['user_data']['file_url'])) {
        $file = __DIR__ . '/' . $_SESSION['user_data']['file_url'];
        if (is_file($file)) @unlink($file);
    }
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
    header('Location: index2.php');
    exit;
}

$payForOptions = [
    '15K Category', '35K Category', '55K Category', '75K category',
    '116K Category', 'Shuttle One Way', 'Shuttle Two Ways',
    'Training Cap Merchandise', 'Compressport T-Shirt Merchandise', 'Buf Merchandise', 'Other'
];

function old($key, $default=''){
    if (isset($_POST[$key])) return htmlspecialchars($_POST[$key]);
    return htmlspecialchars($default);
}
function oldArray($key){
    if (isset($_POST[$key]) && is_array($_POST[$key])) return $_POST[$key];
    return [];
}

$errors = [];

// Xử lý POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $invoice_id = trim($_POST['invoice_id'] ?? '');
    $pay_for = $_POST['pay_for'] ?? [];
    $notes = trim($_POST['notes'] ?? '');

    // Validate
    if ($first_name === '') $errors[] = "First Name không được để trống.";
    if ($last_name === '') $errors[] = "Last Name không được để trống.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ.";
    if ($invoice_id === '') $errors[] = "Invoice ID không được để trống.";
    if (empty($pay_for)) $errors[] = "Bạn phải chọn ít nhất một mục Pay For.";

    // Validate file
    $file_url = '';
    if (!isset($_FILES['receipt']) || $_FILES['receipt']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "Bạn phải upload ảnh biên nhận.";
    } else {
        if ($_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['receipt'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif'];
            if (!in_array($ext, $allowed)) {
                $errors[] = "File ảnh không đúng định dạng.";
            } elseif ($file['size'] > 10*1024*1024) {
                $errors[] = "File ảnh vượt quá 10MB.";
            } else {
                $upload_dir = __DIR__.'/uploads/';
                if (!is_dir($upload_dir)) mkdir($upload_dir,0777,true);
                $new_name = uniqid('receipt_').'.'.$ext;
                $target = $upload_dir.$new_name;
                if (move_uploaded_file($file['tmp_name'],$target)) {
                    $file_url = 'uploads/'.$new_name;
                } else {
                    $errors[] = "Upload ảnh thất bại.";
                }
            }
        } else {
            $errors[] = "Lỗi khi upload ảnh.";
        }
    }

    if (empty($errors)) {
        $_SESSION['user_data'] = [
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'invoice_id'=>$invoice_id,
            'pay_for'=>$pay_for,
            'notes'=>$notes,
            'file_url'=>$file_url
        ];
        header('Location: result.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Payment Form</title>
<style>
:root { --radius:16px; --gap:16px; --pad:20px; --border:#e5e7eb; --text:#111827; --muted:#6b7280; }
*{box-sizing:border-box;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
body{background:linear-gradient(135deg, #23243a 0%, #2e2f4b 50%, #3a3b5c 100%);margin:0;padding:24px;color:var(--text)}
.card{max-width:900px;margin:0 auto;background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:0 4px 16px rgba(0,0,0,.04)}
.head{padding:28px;border-bottom:1px solid var(--border);font-size:28px;font-weight:700;background:linear-gradient(135deg, #2e2f4b 70%, #3a3b5c 100%);color:#e5e7eb;}
.body{padding:var(--pad)}
.row{display:grid;grid-template-columns:1fr 1fr;gap:var(--gap)}
.group{margin-bottom:16px}
label{display:block;font-weight:600;margin-bottom:6px}
input[type=text],input[type=email],textarea{width:100%;padding:12px;border:1px solid var(--border);border-radius:10px;font-size:15px}
textarea{min-height:120px;resize:vertical}
.chk-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px 24px}
.upload{padding:18px;border:2px dashed #d1d5db;border-radius:12px;text-align:center}
.muted{color:var(--muted);font-size:12px}
.btns{display:flex;gap:12px;margin-top:10px}
.btn{padding:12px 18px;border-radius:12px;border:0;background:#111827;color:#fff;font-weight:700;cursor:pointer}
.btn.secondary{background:#e5e7eb;color:#111827}
.errors{background:#fee2e2;border:1px solid #fecaca;color:#991b1b;padding:12px;border-radius:12px;margin-bottom:14px}
</style>
</head>
<body>
<div class="card">
    <div class="head">Payment Receipt Upload Form</div>
    <div class="body">
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <strong>Vui lòng sửa các lỗi sau:</strong>
                <ul>
                    <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data" novalidate>
            <div class="row">
                <div class="group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?= old('first_name') ?>" required>
                </div>
                <div class="group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?= old('last_name') ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= old('email') ?>" required>
                </div>
                <div class="group">
                    <label>Invoice ID</label>
                    <input type="text" name="invoice_id" value="<?= old('invoice_id') ?>" required>
                </div>
            </div>

            <div class="group">
                <label>Pay For</label>
                <div class="chk-grid">
                    <?php
                    $selected = oldArray('pay_for');
                    foreach ($payForOptions as $opt):
                        $checked = in_array($opt,$selected)?'checked':'';
                    ?>
                        <label><input type="checkbox" name="pay_for[]" value="<?= htmlspecialchars($opt) ?>" <?= $checked ?>> <?= htmlspecialchars($opt) ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="group">
                <label>Please upload your payment receipt.</label>
                <div class="upload">
                    <input type="file" name="receipt" accept=".jpg,.jpeg,.png,.gif" required>
                    <div class="muted">jpg, jpeg, png, gif (10MB max.)</div>
                </div>
            </div>

            <div class="group">
                <label>Additional Information</label>
                <textarea name="notes"><?= old('notes') ?></textarea>
            </div>

            <div class="btns">
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
