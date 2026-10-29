<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten_hang_hoa'];
    $gia = $_POST['gia_ban'];
    $soluong = $_POST['so_luong_ton'];

    // DÙNG PREPARED STATEMENT KHI INSERT
    $stmt = $pdo->prepare("INSERT INTO hang_hoa (ten_hang_hoa, gia_ban, so_luong_ton) VALUES (?, ?, ?)");
    $stmt->execute([$ten, $gia, $soluong]);
    
    header("Location: index.php"); // Xong thì quay về trang chủ
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Thêm Sản Phẩm</title></head>
<body>
    <h2>Thêm Sản Phẩm Mới</h2>
    <form method="POST">
        <p>Tên SP: <input type="text" name="ten_hang_hoa" required></p>
        <p>Giá bán: <input type="number" name="gia_ban" required></p>
        <p>Số lượng: <input type="number" name="so_luong_ton" required></p>
        <button type="submit">Lưu</button>
        <a href="index.php">Quay lại</a>
    </form>
</body>
</html>