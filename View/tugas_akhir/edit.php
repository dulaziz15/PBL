<div class="body-main" id="modal-tambah-mahasiswa">
        <div class="card-main">
            <div class="header-card">
                <h3>Edit Dokumen Tugas Akhir</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <form action="../../routes/route.php?page=tugasakhir&sub=update&id=<?= $_GET['id'] ?>" enctype="multipart/form-data" method="POST">
                        <div class="form-modal">
                            <div class="form-input">
                                <label for="">Judul</label>
                                <input type="text" name="judul" id="judul">
                            </div>
                            <div class="form-input">
                                <label for="">File Project</label>
                                <input type="file" name="fileproject" id="fileproject">
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
    <script src="ajax/edit.js"></script>
    <script>
        editAjax(<?= $_GET['id'] ?>)
    </script>