<?php
$host = 'localhost';
$db   = 'web_ban_hang'; // Tên database của bạn
$user = 'root';
$pass = ''; // Mặc định XAMPP để trống
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $user, $pass, $options);
?>