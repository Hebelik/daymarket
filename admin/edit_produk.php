<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    die("Harus login dulu!");
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data produk
$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

// Proses update
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];

    $update = "UPDATE products SET name='$nama', price='$harga' WHERE id='$id'";

    if (mysqli_query($conn, $update)) {
        header("Location: products.php");
    } else {
        echo "Gagal update!";
    }
}
?>

<h2>Edit Produk</h2>

<form method="POST">
    <input type="text" name="nama" value="<?php echo $data['name']; ?>" required><br><br>
    <input type="number" name="harga" value="<?php echo $data['price']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>