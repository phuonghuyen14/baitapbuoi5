<?php
require 'db.php';
$id = $_GET['id'] ?? 0;

// 1. Lấy thông tin sản phẩm cũ để hiển thị ra form
$stmt = $pdo->prepare("SELECT * FROM hang_hoa WHERE ma_hang_hoa = ?");
$stmt->execute([$id]);
$sp = $stmt->fetch();

if (!$sp) { die("Không tìm thấy sản phẩm!"); }

// 2. Xử lý cập nhật khi bấm nút
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten_hang_hoa'];
    $gia = $_POST['gia_ban'];
    $soluong = $_POST['so_luong_ton'];

    $stmt = $pdo->prepare("UPDATE hang_hoa SET ten_hang_hoa=?, gia_ban=?, so_luong_ton=? WHERE ma_hang_hoa=?");
    $stmt->execute([$ten, $gia, $soluong, $id]);
    
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Sửa Sản Phẩm</title></head>
<body>
    <h2>Sửa Sản Phẩm</h2>
    <form method="POST">
        <p>Tên SP: <input type="text" name="ten_hang_hoa" value="<?= htmlspecialchars($sp['ten_hang_hoa']) ?>" required></p>
        <p>Giá bán: <input type="number" name="gia_ban" value="<?= $sp['gia_ban'] ?>" required></p>
        <p>Số lượng: <input type="number" name="so_luong_ton" value="<?= $sp['so_luong_ton'] ?>" required></p>
        <button type="submit">Cập nhật</button>
        <a href="index.php">Quay lại</a>
    </form>
</body>
</html>