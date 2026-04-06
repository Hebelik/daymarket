<?php
require_once '../config.php';

// Proses tambah produk

if (isset($_POST['submit'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO products (name, price) 
              VALUES ('$nama', '$harga')";

if (mysqli_query($conn, $query)) {
    header("Location: products.php");
    exit;
} else {
    echo "Gagal menambahkan produk!";
}
}
?>

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama Produk" required><br><br>
    
    <input type="number" name="harga" placeholder="Harga" required><br><br>

    <textarea name="deskripsi" placeholder="Deskripsi (gunakan format: ## Subjudul)" rows="5"></textarea><br><br>

    <input type="file" name="gambar" accept="image/*" required><br><br>
    
    <button type="submit" name="submit">Tambah</button>
</form>