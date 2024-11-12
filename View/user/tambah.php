<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
        <form action="../../routes/route.php?page=user&sub=tambahuser" method="POST">
            <input type="number" name="username" placeholder="username">
            <input type="email" name="email" placeholder="email">
            <input type="text" name="password" placeholder="password">
            <select name="role" id="">
                <option value="1">Super Admin</option>
                <option value="2">Mahasiswa</option>
                <option value="3">Admin Jurusan</option>
                <option value="4">Admin Prodi</option>
            </select>
            <input type="submit" value="Tambah">
        </form>
    </div>
</div>
<?php
include "../component/footer.php";
?>
<?php
unset($_SESSION['sukses']);
unset($_SESSION['error']);
?>