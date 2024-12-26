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
<script src="ajax/show_ta.js"></script>
<script>
    showTaAjax(<?= $_GET['id'] ?>)
</script>