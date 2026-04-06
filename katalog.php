<?php
session_start();
include "koneksi.php";

// Fitur pencarian
$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search%' ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Katalog Produk - Day Market</title>
<style>
body{
    font-family: 'Segoe UI', sans-serif;
    margin:0;
    background:#f4f6fb;
}

/* HEADER */
.header{
    background:#0d1b3d;
    padding:15px 5%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
}

.header a{
    color:white;
    text-decoration:none;
    margin-left:15px;
}

/* SEARCH */
.search-box{
    text-align:center;
    margin:40px 0;
}

.search-box input{
    padding:10px;
    width:250px;
    border-radius:5px;
    border:1px solid #ccc;
}

.search-box button{
    padding:10px 15px;
    background:#ff6600;
    border:none;
    color:white;
    border-radius:5px;
    cursor:pointer;
}

/* GRID PRODUK */
.product-container{
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap:25px;
    padding:0 5% 60px;
}

.product-card{
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    transition:0.3s;
}

.product-card:hover{
    transform:translateY(-5px);
}

.product-card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.product-info{
    padding:15px;
}

.product-info h3{
    margin:0 0 10px;
    font-size:16px;
}

.price{
    color:#ff6600;
    font-weight:bold;
    margin-bottom:10px;
}

.btn-detail{
    display:block;
    text-align:center;
    background:#0d1b3d;
    color:white;
    padding:8px;
    border-radius:5px;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="header">
    <h2>Day Market</h2>
    <div>
        <a href="index.php">Beranda</a>
        <a href="katalog.php">Katalog</a>
    </div>
</div>

<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Cari produk..." value="<?php echo $search; ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<div class="product-container">

<?php while($product = mysqli_fetch_assoc($query)) { ?>

    <div class="product-card">
        <img src="uploads/<?php echo $product['image']; ?>">
        <div class="product-info">
            <h3><?php echo $product['name']; ?></h3>
            <div class="price">Rp <?php echo number_format($product['price'],0,',','.'); ?></div>
            <a href="detail.php?id=<?php echo $product['id']; ?>" class="btn-detail">Lihat Detail</a>>
        </div>
    </div>

<?php } ?>

</div>

</body>
</html>