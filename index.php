<?php
include "koneksi.php";
session_start();

$query = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Day Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, #e6f2ff, #f5faff);
        }

        /* NAVBAR */
        .navbar {
            background: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .logo img {
            height: 45px;
        }

        .nav-right a {
            text-decoration: none;
            margin-left: 20px;
            color: #333;
            font-weight: 500;
        }

        .nav-right a:hover {
            color: #0066ff;
        }

        /* SEARCH */
        .search-box {
            padding: 20px 5%;
        }

        .search-box input {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        /* BANNER */
        .banner {
            padding: 0 5%;
            margin-bottom: 40px;
        }

        .banner img {
            width: 100%;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* PRODUK */
        .container {
            padding: 0 5% 60px;
        }

        .title-section {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #222;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
        }

        .card h4 {
            margin: 12px 0 5px;
            font-size: 16px;
            color: #222;
        }

        .price {
            color: #0066ff;
            font-weight: bold;
            font-size: 15px;
        }

        /* FOOTER */
        /* FOOTER MODERN */
.footer {
    background: #0d1b3d;
    color: white;
    margin-top: 60px;
    padding-top: 50px;
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    padding: 0 5%;
}

.footer-col h4 {
    margin-bottom: 15px;
}

.footer-col p {
    font-size: 14px;
    line-height: 1.6;
    color: #cbd6ff;
}

.footer-col a {
    display: block;
    color: #cbd6ff;
    text-decoration: none;
    margin-bottom: 8px;
    font-size: 14px;
    transition: 0.3s;
}

.footer-col a:hover {
    color: #ffffff;
}

.footer-bottom {
    text-align: center;
    padding: 20px;
    margin-top: 40px;
    border-top: 1px solid rgba(255,255,255,0.1);
    font-size: 13px;
    color: #cbd6ff;
}


        @media(max-width:768px){
            .navbar {
                flex-direction: column;
                gap: 10px;
            }
        }

        .profile-menu {
    position: relative;
    display: inline-block;
}

.profile-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-weight: 500;
}

.avatar-small {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: #0066ff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 45px;
    background: white;
    min-width: 180px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    overflow: hidden;
    z-index: 100;
}

.dropdown a {
    display: block;
    padding: 12px 15px;
    text-decoration: none;
    color: #333;
    font-size: 14px;
}

.dropdown a:hover {
    background: #f2f6ff;
}

.dropdown .logout {
    color: #ff4d4d;
}
    </style>
</head>

<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">
        <img src="assets/images/wordmark.png">
    </div>

    <div class="nav-right">
        <?php if(isset($_SESSION['user_id'])) { ?>

            <div class="profile-menu">
                <div class="profile-trigger" onclick="toggleDropdown()">
                    
                    <?php
                    include "koneksi.php";
                    $queryUser = mysqli_query($conn, "SELECT profile_image FROM users WHERE id='".$_SESSION['user_id']."'");
                    $dataUser = mysqli_fetch_assoc($queryUser);
                    ?>

                    <div class="avatar-small">
                        <?php if(!empty($dataUser['profile_image'])){ ?>
                            <img src="uploads/profile/<?php echo $dataUser['profile_image']; ?>" 
                                 style="width:35px; height:35px; border-radius:50%; object-fit:cover;">
                        <?php } else { ?>
                            <?php echo strtoupper(substr($_SESSION['user_name'],0,1)); ?>
                        <?php } ?>
                    </div>

                    <span><?php echo $_SESSION['user_name']; ?></span>
                </div>

                <div class="dropdown" id="dropdownMenu">
                    <a href="akun/dashboard.php">Dashboard</a>
                    <a href="akun/profile.php">Edit Profil</a>
                    <a href="akun/orders.php">Pesanan Saya</a>
                    <a href="logout.php" class="logout">Logout</a>
                </div>
            </div>

        <?php } else { ?>

            <a href="login.php">Login</a>
            <a href="register.php">Register</a>

        <?php } ?>
    </div>
</div>

<!-- SEARCH -->
<div class="search-box">
    <input type="text" placeholder="Cari produk di Day Market...">
</div>

<!-- BANNER -->
<div class="banner">
    <img src="assets/images/banner.jpg">
</div>

<!-- PRODUK -->
<div class="container">
    <div class="title-section">Produk Terbaru</div>

    <div class="product-grid">
        <?php while($row = mysqli_fetch_assoc($query)) { ?>
            <div class="card">
                <img src="uploads/<?php echo $row['image']; ?>">
                <h4><?php echo $row['name']; ?></h4>
                <div class="price">Rp<?php echo number_format($row['price']); ?></div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">

        <div class="footer-col">
            <img src="assets/images/wordmark.png" style="height:40px; margin-bottom:15px;">
            <p>Day Market adalah marketplace modern yang menyediakan berbagai kebutuhan harian dengan kualitas terbaik dan harga terjangkau.</p>
        </div>

        <div class="footer-col">
            <h4>Navigasi</h4>
            <a href="index.php">Beranda</a>
            <a href="#">Kategori</a>
            <a href="#">Promo</a>
            <a href="#">Tentang Kami</a>
        </div>

        <div class="footer-col">
            <h4>Bantuan</h4>
            <a href="#">Cara Belanja</a>
            <a href="#">Metode Pembayaran</a>
            <a href="#">Pengiriman</a>
            <a href="#">FAQ</a>
        </div>

        <div class="footer-col">
            <h4>Kontak</h4>
            <p>Email: support@daymarket.com</p>
            <p>Phone: +62 812 3456 7890</p>
        </div>

    </div>

    <div class="footer-bottom">
        © <?php echo date("Y"); ?> Day Market. All rights reserved.
    </div>
</footer>

<script>
function toggleDropdown(){
    var menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

window.onclick = function(event){
    if(!event.target.closest('.profile-menu')){
        document.getElementById("dropdownMenu").style.display = "none";
    }
}
</script>

</body>
</html>
