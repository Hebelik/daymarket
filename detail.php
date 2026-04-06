<?php
include "koneksi.php";
session_start();

if(!isset($_GET['id'])){
    header("Location: katalog.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($query);

if(!$product){
    echo "Produk tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $product['name']; ?> - Day Market</title>
<style>

body{
    font-family:Segoe UI;
    background:#f4f6fb;
    margin:0;
}

.container{
    max-width:1100px;
    margin:50px auto;
    background:white;
    padding:40px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    display:flex;
    gap:50px;
}

.product-image{
    flex:1;
}

.product-image img{
    width:100%;
    border-radius:15px;
}

.product-info{
    flex:1;
}

.product-info h1{
    margin-top:0;
}

.price{
    color:#ff6600;
    font-size:22px;
    font-weight:bold;
    margin:20px 0;
}

.description{
    color:#555;
    line-height:1.6;
    margin-bottom:30px;
}

.button{
    padding:12px 25px;
    background:#0d1b3d;
    color:white;
    text-decoration:none;
    border-radius:8px;
    margin-right:10px;
}

.button:hover{
    background:#142c63;
}

@media(max-width:768px){
    .container{
        flex-direction:column;
    }
}
</style>
</head>

<body>

<div class="product-container">

<?php while($product = mysqli_fetch_assoc($query)) { ?>

    <div class="product-card">
        <img src="uploads/<?php echo $product['image']; ?>">
        <div class="product-info">
            <h3><?php echo $product['name']; ?></h3>
            <div class="price">
                Rp <?php echo number_format($product['price'],0,',','.'); ?>
            </div>
            <a href="detail.php?id=<?php echo $product['id']; ?>" class="btn-detail">
                Lihat Detail
            </a>
        </div>
    </div>

<?php } ?>

</div>

</body>
</html>