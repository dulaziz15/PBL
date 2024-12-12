function updateAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=user&sub=getOne&id=' + id,
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
}