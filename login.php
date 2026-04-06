<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Day Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="background"></div>

<div class="container">

    <div class="card">

        <div class="logo">
            <img src="assets/images/wordmark.png" alt="Day Market">
            <p class="tagline">Fresh Finds, Every Day.</p>
        </div>

        <h2>MASUK</h2>

        <form action="proses_login.php" method="POST">
            <div class="input-group">
                <label>Username/email</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn-primary">OK</button>
        </form>

        <p class="small-text">Belum punya akun?</p>
        <a href="register.php" class="btn-secondary">Register</a>

    </div>

</div>

</body>
</html>
