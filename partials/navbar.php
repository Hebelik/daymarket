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