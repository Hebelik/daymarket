<?php
session_start();
include "../koneksi.php";

// Cek login
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Day Market</title>
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

        .container {
            padding: 40px 5%;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            max-width: 800px;
            margin: auto;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #0066ff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
        }

        .user-info h2 {
            margin-bottom: 5px;
        }

        .user-info p {
            color: #666;
        }

        .menu {
            margin-top: 30px;
            display: grid;
            gap: 15px;
        }

        .menu a {
            text-decoration: none;
            background: #f2f6ff;
            padding: 15px;
            border-radius: 12px;
            font-weight: 500;
            color: #333;
            transition: 0.3s;
        }

        .menu a:hover {
            background: #0066ff;
            color: white;
        }

        .logout {
            background: #ff4d4d !important;
            color: white !important;
        }

        .logout:hover {
            background: #e60000 !important;
        }

        @media(max-width:768px){
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">

        <div class="profile-header">
            <div class="avatar">
    <?php if(!empty($user['profile_image'])){ ?>
        <img src="../uploads/profile/<?php echo $user['profile_image']; ?>" 
             style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
    <?php } else { ?>
        <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
    <?php } ?>
</div>

            <div class="user-info">
                <h2><?php echo $user['name']; ?></h2>
                <p><?php echo $user['email']; ?></p>
            </div>
        </div>

        <div class="menu">
            <a href="profile.php">✏ Edit Profil</a>
            <a href="orders.php">📦 Pesanan Saya</a>
            <a href="../index.php">🏠 Kembali ke Beranda</a>
            <a href="../logout.php" class="logout">🚪 Logout</a>
        </div>

    </div>
</div>

</body>
</html>