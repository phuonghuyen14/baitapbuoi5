<?php
require 'db.php'; 

// 1. XỬ LÝ TÌM KIẾM BẰNG PREPARED STATEMENT
$keyword = $_GET['keyword'] ?? '';
if ($keyword) {
    $stmt = $pdo->prepare("SELECT * FROM hang_hoa WHERE ten_hang_hoa LIKE ?");
    $stmt->execute(["%$keyword%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM hang_hoa");
}
$hang_hoas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Hàng Hóa - Cá Nhân</title>
    <style>
        table { border-collapse: collapse; width: 80%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Danh sách Hàng Hóa</h2>
    
    <!-- FORM TÌM KIẾM -->
    <form method="GET" action="index.php">
        <input type="text" name="keyword" placeholder="Nhập tên sản phẩm..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Tìm kiếm</button>
        <a href="index.php">Hủy tìm</a>
    </form>
    <br>
    <a href="them.php">+ Thêm sản phẩm mới</a>
    <br><br>
    
    <table>
        <tr>
            <th>Mã</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá Bán</th>
            <th>Số Lượng</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($hang_hoas as $sp): ?>
        <tr>
            <td><?= $sp['ma_hang_hoa'] ?></td>
            <td><?= htmlspecialchars($sp['ten_hang_hoa']) ?></td>
            <td><?= number_format($sp['gia_ban']) ?> đ</td>
            <td><?= $sp['so_luong_ton'] ?></td>
            <td>
                <a href="sua.php?id=<?= $sp['ma_hang_hoa'] ?>">Sửa</a> | 
                
                <!-- YÊU CẦU: XÓA BẰNG POST (Không dùng link <a>) -->
                <form method="POST" action="xoa.php" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                    <input type="hidden" name="id" value="<?= $sp['ma_hang_hoa'] ?>">
                    <button type="submit">Xóa</button>
                </form>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>