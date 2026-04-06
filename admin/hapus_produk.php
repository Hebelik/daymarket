<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    die("Harus login dulu!");
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

header("Location: products.php");
?>