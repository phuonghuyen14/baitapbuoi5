<?php
require 'db.php';

// KIỂM TRA PHƯƠNG THỨC POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $stmt = $pdo->prepare("DELETE FROM hang_hoa WHERE ma_hang_hoa = ?");
    $stmt->execute([$id]);
}

header("Location: index.php"); // Xong thì quay về trang chủ
exit;
?>