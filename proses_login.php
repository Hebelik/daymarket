<?php
session_start();
include "koneksi.php";

if(isset($_POST['username'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek user berdasarkan email ATAU name
    $query = mysqli_query($conn, "SELECT * FROM users 
                                  WHERE email='$username' 
                                  OR name='$username'");

    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);

        // Verifikasi password hash
        if(password_verify($password, $user['password'])){

            // Simpan data ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            echo "<script>
                   alert('Login berhasil!');
                   window.location='index.php';
                 </script>";


        } else {
            echo "<script>
                    alert('Password salah!');
                    window.history.back();
                  </script>";
        }

    } else {
        echo "<script>
                alert('User tidak ditemukan!');
                window.history.back();
              </script>";
    }
}
?>
