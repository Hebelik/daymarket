<?php
include "koneksi.php";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "uploads/".$image;

    move_uploaded_file($tmp, $folder);

    mysqli_query($conn, "INSERT INTO products (name, description, price, image)
                         VALUES ('$name','$description','$price','$image')");

    echo "<script>
            alert('Produk berhasil ditambahkan!');
            window.location='katalog.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<style>
body{
    font-family:Segoe UI;
    background:#f4f6fb;
}

.form-container{
    width:400px;
    margin:60px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

input, textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    width:100%;
    padding:10px;
    background:#0d1b3d;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="form-container">
<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Nama Produk" required>
    <textarea name="description" placeholder="Deskripsi Produk" required></textarea>
    <input type="number" name="price" placeholder="Harga" required>
    <input type="file" name="image" required>
    <button type="submit" name="submit">Tambah</button>
</form>

</div>

</body>
</html>