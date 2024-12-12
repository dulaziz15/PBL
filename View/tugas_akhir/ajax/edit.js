function editAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOne&id=' + id,
        success: function(data) {
            console.log(data);
            $("#judul").val(data.judul);
        }
    });
}