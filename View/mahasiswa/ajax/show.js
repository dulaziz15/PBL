function showAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=show&id=' + id,
        success: function(data) {
            console.log(data);
            $("#data").html(`<p>${data.nama}</p>`);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}