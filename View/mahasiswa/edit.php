    <div class="body-main" id="modal-show-mahasiswa">
        <div class="card-main">
            <div class="header-card">
                <h3>Edit Mahasiswa</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <form action="../../routes/route.php?page=mahasiswa&sub=updateMahasiswa&id=<?= $_GET['id'] ?>" method="POST">
                        <div class="form-modal-mahasiswa">
                            <div class="form-input">
                                <label for="">NIM</label>
                                <input type="number" name="nim" id="nim" required>
                            </div>
                            <div class="form-input">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="nama" required>
                            </div>
                            <div class="form-input">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas" id="kelas" required>
                            </div>
                            <div class="form-input">
                                <label for="">Telepon</label>
                                <input type="number" name="telp" id="telp" required>
                            </div>
                            <div class="form-input">
                                <label for="">Tempat Lahir</label>
                                <input type="text" name="temp_lahir" id="temp_lahir" required>
                            </div>
                            <div class="form-input">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" required>
                            </div>
                            <div class="form-input">
                                <label for="">Alamat</label>
                                <input type="text" name="alamat" id="alamat" required>
                            </div>
                            <div class="form-input">
                                <label for="">Gambar</label>
                                <input type="file" name="img" id="img">
                            </div>
                            <div class="form-input">
                                <label for="">User</label>
                                <select name="user_id" id="dataUser" required>

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
    <script src="ajax/edit.js"></script>
    <script>
        editAjax(<?= $_GET['id'] ?>)
    </script>