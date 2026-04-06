<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Day Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/daymarket/css/style.css">
</head>
<body>

<div class="background"></div>

<div class="container">

    <div class="card">

        <div class="logo">
            <img src="assets/images/wordmark.png" alt="Day Market">
            <p class="tagline">Fresh Finds, Every Day.</p>
        </div>

        <h2>REGISTER</h2>

        <form action="proses_register.php" method="POST">

            <div class="input-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password (min 8 karakter)" required>
                <span class="toggle-password" onclick="togglePassword('password', this)">👁</span>
            </div>

           <div class="input-group">
               <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
               <span class="toggle-password" onclick="togglePassword('confirm_password', this)">👁</span>
           </div>


            <button type="submit" class="btn-primary">Daftar</button>

        </form>

        <p class="small-text">Sudah punya akun?</p>
        <a href="login.php" class="btn-secondary">Login</a>

    </div>

</div>

<script>
function togglePassword(fieldId, element) {
    const field = document.getElementById(fieldId);

    if (field.type === "password") {
        field.type = "text";
        element.textContent = "🙈";
    } else {
        field.type = "password";
        element.textContent = "👁";
    }
}

// Tampilkan eye hanya jika ada isi
document.querySelectorAll('input[type="password"]').forEach(input => {
    const icon = input.nextElementSibling;

    input.addEventListener("input", function() {
        if (this.value.length > 0) {
            icon.style.display = "block";
        } else {
            icon.style.display = "none";
            this.type = "password";
            icon.textContent = "👁";
        }
    });
});
</script>

</body>
</html>
