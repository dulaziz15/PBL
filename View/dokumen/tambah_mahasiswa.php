
    <div class="card-main">
        <div class="header-card">
            <h3>Tambah Dokumen Pendukung</h3>
            <hr>
        </div>
        <div class="body-card">
            <div class="container-card">
                <div class="ketentuan-file">
                    <h4>Ketentuan Upload File</h4>
                    <ul>
                        <li>Format nama file NAMA_NIM_DOKUMEN.pdf</li>
                        <li>File max 2MB</li>
                    </ul>
                </div>
                <form action="../../routes/route.php?page=dokumenpendukung&sub=addDokumen" method="POST" enctype="multipart/form-data">
                    <div class="form-modal-ta">
                        <div class="form-input">
                            <label for="">Tanda Terima PKL</label>
                            <input type="file" name="tanda_terima_pkl" accept="application/pdf" required>
                        </div>
                        <div class="form-input">
                            <label for="">Tanda Terima TA</label>
                            <input type="file" name="tanda_terima_ta" accept="application/pdf" required>
                        </div>
                        <div class="form-input">
                            <label for="">Bebas Kompen</label>
                            <input type="file" name="bebas_kompen" id="fileproject" accept="application/pdf" required>
                        </div><br>
                        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
                        <div class="form-input-submit">
                            <input class="btn btn-submit" type="submit" value="Tambah">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>