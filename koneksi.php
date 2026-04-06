<?php
$conn = mysqli_connect("localhost", "root", "", "ecommerce_daymarket");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
