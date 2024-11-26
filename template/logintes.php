<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="logo">
                <img src="../src/img/logopoltek.png" alt="Logo Poltek" />
            </div>
            <!-- Judul Form -->
            <h2>BEBAS TANGGUNGAN TA</h2>

            <!-- Pesan Error/Logout -->
            <h3 class="error"><?= isset($_SESSION['error']) ? $_SESSION['error'] : "" ?></h3>
            <h3 class="logout"><?= isset($_SESSION['logout']) ? $_SESSION['logout'] : "" ?></h3>

            <!-- Form -->
            <form action="./../routes/route.php?page=proses_login" method="post">
                <input type="number" name="nim" placeholder="USERNAME" required>
                <input type="password" name="password" id="password" placeholder="PASSWORD" required>

                <div class="options">
                    <label>
                        <input type="checkbox" id="showPassword">
                        <span>Tampilkan Password</span>
                    </label>
                    <span>Buat Akun <a href="link_ke_halaman_pendaftaran">Di sini!</a></span>
                </div>

                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            var passwordInput = document.getElementById('password');
            if (this.checked) {
                passwordInput.type = 'text'; // Ubah tipe menjadi text
            } else {
                passwordInput.type = 'password'; // Kembalikan tipe menjadi password
            }
        });
    </script>
</body>

</html>