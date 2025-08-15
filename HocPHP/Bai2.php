<?php
// Tạo dữ liệu giả (100 sách)
$books = [];
for ($i = 1; $i <= 100; $i++) {
    $books[] = [
        'tensach' => "Tensach$i",
        'noidung' => "Noidung$i"
    ];
}

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$books_page = array_slice($books, $offset, $limit);
$total_pages = ceil(count($books) / $limit);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách sách</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f7f7f8;
        }
        table { border-collapse: collapse; width: 600px; margin-bottom: 30px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a {
            padding: 4px 8px;
            text-decoration: none;
            border: 1px solid #ccc;
            margin: 0 2px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 style="text-align:center;">Danh sách </h2>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên sách</th>
                <th>Nội dung sách</th>
            </tr>
            <?php foreach ($books_page as $index => $book): ?>
            <tr>
                <td><?php echo $offset + $index + 1; ?></td>
                <td><?php echo $book['tensach']; ?></td>
                <td><?php echo $book['noidung']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
        <div style="text-align:center; margin-top:24px;">
            <a href="index.php" style="
                display:inline-block;
                padding:10px 24px;
                border-radius:8px;
                background:#e8f0ff;
                border:1px solid #c9dcff;
                color:#333;
                text-decoration:none;
                font-size:16px;
                transition:background .15s;
            " onmouseover="this.style.background='#d0e4ff'" onmouseout="this.style.background='#e8f0ff'">
                Quay lại trang chủ
            </a>
        </div>
    </div>
</body>
</html>