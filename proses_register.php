<?php
include "koneksi.php";

if(isset($_POST['name'])){

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm  = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    if(strlen($password) < 8){
    echo "<script>
            alert('Password minimal memiliki 8 karakter');
            window.history.back();
          </script>";
    exit;
    }

    // Cek password sama atau tidak
    if($password != $confirm){
        echo "<script>alert('Password tidak sama!'); window.history.back();</script>";
        exit;
    }

    // Hash password
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek email sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Email sudah terdaftar!'); window.history.back();</script>";
        exit;
    }

    // Insert ke database
    $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) 
                VALUES ('$name', '$email', '$hash_password')");

    if($insert){
        echo "<script>alert('Register berhasil!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Register gagal!');</script>";
    }
}
?>
