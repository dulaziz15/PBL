<div class="body-main" id="modal-tambah-mahasiswa">
    <div class="card-main">
        <div class="header-card">
            <h3>Biodata Mahasiswa</h3>
            <hr>
        </div>
        <div class="body-card">
            <div class="container-card">
                <div class="biodata-mahasiswa">
                    <div class="foto-profil">
                        <div class="img-profile">

                        </div>
                        <div class="keterangan-profil">

                        </div>
                        <div class="kontak">

                        </div>
                    </div>
                    <div class="data-profil">
                        <div class="data-biodata">
                            <h3>Informasi Mahasiswa</h3>
                            <ul id="biodata-mahasiswa">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="ajax/show.js"></script>
<script>
    showAjax(<?= $_GET['id'] ?>);
</script>