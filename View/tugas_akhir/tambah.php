    <div class="body-main" id="modal-tambah-mahasiswa">
        <div class="card-main">
            <div class="header-card">
                <h3>Tambah Dokumen Tugas Akhir</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <div class="ketentuan-file">
                        <h4>Ketentuan Upload File</h4>
                        <ul>
                            <li>Format nama file NAMA_NIM_BAGIAN.pdf</li>
                            <li>File Project berupa zip</li>
                            <li>Pendahuluan meliputi cover</li>
                        </ul>
                    </div>
                    <form action="../../routes/route.php?page=tugasakhir&sub=add" enctype="multipart/form-data" method="POST">
                        <div class="form-modal">
                            <div class="form-input">
                                <label for="">Judul</label>
                                <input type="text" name="judul" id="judul">
                            </div>
                            <div class="form-input">
                                <label for="">File Project</label>
                                <input type="file" name="fileproject" id="fileproject">
                            </div>
                            <div class="form-input">
                                <label for="">Pendahuluan</label>
                                <input type="file" name="pendahuluan" id="pendahuluan" accept="application/pdf">
                            </div>
                            <div class="form-input">
                                <label for="">Abstrak</label>
                                <input type="file" name="abstrak" id="abstrak" accept="application/pdf">
                            </div>
                            <div class="form-input">
                                <label for="">Pembahasan</label>
                                <input type="file" name="isi" id="isi" accept="application/pdf">
                            </div>
                            <div class="form-input">
                                <label for="">Daftar Pustaka</label>
                                <input type="file" name="daftarpustaka" id="daftarpustaka" accept="application/pdf">
                            </div>
                            <div class="form-input">
                                <label for="">Lampiran</label>
                                <input type="file" name="lampiran" id="lampiran" accept="application/pdf">
                            </div>
                            <div class="form-input">
                                <label for="">Mahasiswa</label>
                                <select name="mahasiswa" id="dataMahasiswa" style="width: 300px;" class="operator">

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
    <script src="./ajax/tambah.js"></script>
    <script>
        tambahAjax()
    </script>