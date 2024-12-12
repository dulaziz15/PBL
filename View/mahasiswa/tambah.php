    <div class="body-main" id="modal-tambah-mahasiswa">
        <div class="card-main">
            <div class="header-card">
                <h3>Tambah Mahasiswa</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <form action="../../routes/route.php?page=mahasiswa&sub=addMahasiswa" method="POST">
                        <div class="form-modal-mahasiswa">
                            <div class="form-input">
                                <label for="">NIM</label>
                                <input type="number" name="nim">
                            </div>
                            <div class="form-input">
                                <label for="">Nama</label>
                                <input type="text" name="nama">
                            </div>
                            <div class="form-input">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas">
                            </div>
                            <div class="form-input">
                                <label for="">Telepon</label>
                                <input type="number" name="telp">
                            </div>
                            <div class="form-input">
                                <label for="">Tempat Lahir</label>
                                <input type="text" name="temp_lahir">
                            </div>
                            <div class="form-input">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir">
                            </div>
                            <div class="form-input">
                                <label for="">Alamat</label>
                                <input type="text" name="alamat">
                            </div>
                            <div class="form-input">
                                <label for="">Gambar</label>
                                <input type="file" name="img">
                            </div>
                            <div class="form-input">
                                <label for="">User</label>
                                <select name="user_id" id="dataUser">

                                </select>
                            </div>
                            <div class="form-input-submit">
                                <input class="btn btn-submit" type="submit" value="Tambah">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="ajax/tambah.js">
    </script>
    <script>
        tambahAjax();
    </script>