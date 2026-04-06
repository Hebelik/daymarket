<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    die("Harus login dulu!");
}
?>

<h2>Admin Dashboard</h2>

<a href="products.php">Kelola Produk</a><br>
<a href="orders.php">Lihat Pesanan</a><br>