<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun</title>
    <link rel="stylesheet" href="../src/css/login&Regis.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="logo">
                <img src="../src/img/logopoltek.png" alt="Logo Poltek" />
            </div>
            <!-- Judul Form -->
            <h2>PENDAFTARAN AKUN</h2>

            <!-- Pesan Error/Logout -->
            <h3 class="error"><?= isset($_SESSION['error']) ? $_SESSION['error'] : "" ?></h3>
            <h3 class="logout"><?= isset($_SESSION['logout']) ? $_SESSION['logout'] : "" ?></h3>

            <!-- Form -->
            <div class="form-container">
                <form action="./../routes/route.php?page=proses_register" method="post">
                    <input type="number" name="username" placeholder="USERNAME" required>
                    <input type="email" name="email" placeholder="EMAIL" required>
                    <input type="password" name="password" id="password" placeholder="PASSWORD" required>

                    <div class="options">
                        <label class="checkbox-label">
                            <input type="checkbox" id="showPassword">
                            Tampilkan Password
                        </label>
                    </div>

                    <button type="submit">DAFTAR</button>
                </form>
            </div>
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