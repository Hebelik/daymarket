<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);

$profile_image = $user['profile_image'];

if(!empty($_FILES['profile_image']['name'])){

    $file = $_FILES['profile_image']['name'];
    $tmp = $_FILES['profile_image']['tmp_name'];
    $size = $_FILES['profile_image']['size'];

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png'];
    $max_size = 10 * 1024 * 1024; // 10MB

    if(in_array($ext, $allowed) && $size <= $max_size){

        $new_name = "profile_" . time() . "." . $ext;

        move_uploaded_file($tmp, "../uploads/profile/" . $new_name);

        // hapus foto lama kalau ada
        if(!empty($user['profile_image'])){
            unlink("../uploads/profile/" . $user['profile_image']);
        }

        $profile_image = $new_name;

    } else {
        echo "<script>alert('File harus JPG/PNG dan maksimal 2MB');</script>";
    }
}

if(isset($_POST['update'])){

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Jika user ingin ganti password
    if(!empty($old_password) || !empty($new_password)){

        if(strlen($new_password) < 8){
            echo "<script>alert('Password baru minimal 8 karakter!');</script>";
        }
        elseif(!password_verify($old_password, $user['password'])){
            echo "<script>alert('Password lama salah!');</script>";
        }
        else{
            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$hashed', profile_image='$profile_image' WHERE id='$user_id'");
            echo "<script>alert('Profil & password berhasil diperbarui!'); window.location='dashboard.php';</script>";
            exit;
        }

    } else {

        mysqli_query($conn, "UPDATE users SET name='$name', email='$email', profile_image='$profile_image' WHERE id='$user_id'");
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='dashboard.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil - Day Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background: linear-gradient(to bottom, #e6f2ff, #f5faff);
}

.container{
    padding:40px 5%;
}

.card{
    background:white;
    padding:30px;
    border-radius:18px;
    max-width:600px;
    margin:auto;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
}

h2{
    margin-bottom:20px;
}

.input-group{
    margin-bottom:15px;
}

input{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}

button{
    width:100%;
    padding:12px;
    background:#0066ff;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    margin-top:10px;
}

button:hover{
    background:#004ecc;
}

.back{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#555;
}
</style>
</head>

<body>

<div class="container">
<div class="card">

<h2>Edit Profil</h2>

<form method="POST" enctype="multipart/form-data">

<div class="input-group">
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
</div>

<div class="input-group">
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
</div>

<div class="input-group">
    <label>Foto Profil</label><br><br>

    <?php if(!empty($user['profile_image'])){ ?>
        <img src="../uploads/profile/<?php echo $user['profile_image']; ?>" 
             width="100" 
             style="border-radius:50%; margin-bottom:10px;">
    <?php } ?>

    <input type="file" name="profile_image" accept="image/*">
</div>

<hr style="margin:20px 0;">

<p style="margin-bottom:10px; font-weight:500;">Ganti Password (Opsional)</p>

<div class="input-group">
    <input type="password" name="old_password" placeholder="Password Lama">
</div>

<div class="input-group">
    <input type="password" name="new_password" placeholder="Password Baru (min 8 karakter)">
</div>

<button type="submit" name="update">Simpan Perubahan</button>

</form>

<a href="dashboard.php" class="back">← Kembali ke Dashboard</a>

</div>
</div>

</body>
</html>