<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    die("Harus login dulu!");
}
?>

<h2>Daftar Pesanan</h2>

<?php
$query = mysqli_query($conn, "SELECT * FROM orders");

while($o = mysqli_fetch_assoc($query)) {
    echo "Order ID: " . $o['id'] . " | Total: Rp " . $o['total_price'] . "<br>";
}
?>