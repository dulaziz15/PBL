function showTaAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=arsip&sub=getOne&id=' + id,
        success: function(data) {
            console.log(data);
            $(".pdf-arsip").append(`<span>${data.NIM + '.pdf'}</span><br><embed src="../../src/bebas_tanggungan/${data.NIM}/${data.NIM}.pdf" />`)
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}