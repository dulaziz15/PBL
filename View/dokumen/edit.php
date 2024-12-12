<div class="body-main" id="modal-tambah-dokumen">
    <div class="card-main">
        <div class="header-card">
            <h3>Edit Dokumen Pendukung</h3>
            <hr>
        </div>
        <div class="body-card">
            <div class="container-card">
                <form action="../../routes/route.php?page=dokumenpendukung&sub=updateDokumen&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-modal">
                        <div class="form-input">
                            <label for="">Upload Dokumen</label>
                            <input type="file" name="tanda_terima_pkl" accept="application/pdf">
                        </div>
                        <div class="form-input">
                            <label for="">Bagian</label>
                            <select name="bagian" id="dataTugasAkhir">
                                <option value="tanda_terima_pkl">Tanda Terima PKL</option>
                                <option value="tanda_terima_ta">Tanda Terima TA</option>
                                <option value="bebas_kompen">Bebas Kompen</option>
                            </select>
                        </div>
                        <div class="form-input-submit">
                            <input class="btn btn-submit" type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>