<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
        <a href="javascript: history.go(-1)" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
        <div class="card-main">
            <div class="header-card">
                <h3>Update User</h3>
                <hr>
            </div>
            <div class="body-card">
                <form action="../../routes/route.php?page=user&sub=update&id=<?= $_GET['id'] ?>" method="POST">
                    <div class="form-container">
                        <div class="form-input">
                            <label for="">Username</label>
                            <input type="number" name="username" placeholder="username" id="username">
                        </div>
                        <div class="form-input">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="email" id="email">
                        </div>
                        <div class="form-input">
                            <label for="">Password</label>
                            <input type="text" name="password" placeholder="password" id="password">
                        </div>
                        <div class="form-input">
                            <label for="">Role</label>
                            <select name="role" id="role">
                                <option value="1">Super Admin</option>
                                <option value="2">Mahasiswa</option>
                                <option value="3">Admin Jurusan</option>
                                <option value="4">Admin Prodi</option>
                            </select>
                        </div>
                        <div class="">
                            <input class="btn btn-tambah" type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "../component/footer.php";
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=user&sub=getOne&id=' + <?= $_GET['id'] ?>,
        success: function(user) {
            $("#username").val(user.username);
            $("#email").val(user.email);
            $("#password").val(user.password);
            $("#role").append(`<option value="${user.role}" selected>${user.role == 1 ? "Super Admin" : (user.role == 2 ? "Mahasiswa" : (user.role == 3 ? "Admin Jurusan" : (user.role == 4 ? "Admin Prodi" : "")))}</option>`);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>