<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
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
</body>
</html>