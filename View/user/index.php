<?php
    include '../component/header.php';
    if(isset($_SESSION['sukses'])) {
        echo "<h1>" . $_SESSION['sukses'] . "</h1>";
    } elseif (isset($_SESSION['error'])) {
        echo "<h1>" . $_SESSION['error'] . "</h1>";
    }
?>
<a href="tambah.php">Add User</a>
<h1>Manage User</h1>
<table border="1">
    <thead>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Action</th>
    </thead>
    <tbody id="dataUser">
    </tbody>
</table>
<?php
    unset($_SESSION['sukses']);
    unset($_SESSION['error']);
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/PBL/routes/route.php?page=user&sub=getAll', 
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(user => {
                    tableContent += `
                        <tr>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.password}</td>
                        <td>
                            ${user.role == 1 ? "Super Admin" : (user.role == 2 ? "Mahasiswa" : (user.role == 3 ? "Admin Jurusan" : (user.role == 4 ? "Admin Prodi" : "")))}
                        </td>
                        <td>
                            <a href="../../routes/route.php?page=user&sub=edit&id=${user.user_id}">Edit</a>
                            <a href="../../routes/route.php?page=user&sub=hapus&id=${user.user_id}">Hapus</a>
                        </td>
                        </tr>
                    `;
                });
                $('#dataUser').html(tableContent);
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>