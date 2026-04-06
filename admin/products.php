<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    die("Harus login dulu!");
}

$query = mysqli_query($conn, "SELECT * FROM products");

while($p = mysqli_fetch_assoc($query)) {
    echo $p['name'] . " | Rp " . $p['price'];

    echo " | 
    <a href='edit_produk.php?id=".$p['id']."'>Edit</a> 
    | 
    <a href='hapus_produk.php?id=".$p['id']."' 
       onclick=\"return confirm('Yakin mau hapus?')\">
       Hapus
    </a><br>";
}
?>

<br>
<a href="tambah_produk.php">Tambah Produk</a>