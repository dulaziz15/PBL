<div class="body-main" id="modal-tambah-dokumen">
    <div class="card-main">
        <div class="header-card">
            <h3>Show Tugas Akhir</h3>
            <hr>
        </div>
        <div class="body-card">
            <div class="container-card">
                <div class="pdf-arsip">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=arsip&sub=getOne&id=' + <?= $_GET['id'] ?>,
        success: function(data) {
            console.log(data);
            $(".pdf-arsip").append(`<span>${data.NIM + '.pdf'}</span><br><embed src="../../src/bebas_tanggungan/${data.NIM}/${data.NIM}.pdf" />`)
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>