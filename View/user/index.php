<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
        <?php
        if (isset($_SESSION['sukses'])) {
            echo "<h1>" . $_SESSION['sukses'] . "</h1>";
        } elseif (isset($_SESSION['error'])) {
            echo "<h1>" . $_SESSION['error'] . "</h1>";
        }
        ?>
        <a href="tambah.php" class="btn btn-tambah">Tambah</a>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                        <th>ROLE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="dataUser">

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include "../component/footer.php";
?>
<?php
unset($_SESSION['sukses']);
unset($_SESSION['error']);
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=user&sub=getAll',
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
                            <a href="../../routes/route.php?page=user&sub=edit&id=${user.user_id}" class="btn btn-edit">Edit</a>
                            <a href="../../routes/route.php?page=user&sub=hapus&id=${user.user_id}" class="btn btn-hapus">Hapus</a>
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