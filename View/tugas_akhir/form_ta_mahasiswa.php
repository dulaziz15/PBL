<form action="../../routes/route.php?page=tugasakhir&sub=add" method="post" enctype="multipart/form-data">
    <label for="judul">JUDUL</label><br>
    <input type="text" name="judul" id="judul"><br>
    <label for="fileproject">File Project</label><br>
    <input type="file" name="fileproject" id="fileproject"><br>
    <label for="pendahuluan">Pendahuluan</label><br>
    <input type="file" name="pendahuluan" id="pendahuluan" accept="application/pdf"><br>
    <label for="abstrak">Abstrak</label><br>
    <input type="file" name="abstrak" id="abstrak" accept="application/pdf"><br>
    <label for="bab1">ISI LAPORAN</label><br>
    <input type="file" name="isi" id="bab1" accept="application/pdf"><br>
    <label for="daftarpusataka">Daftar Pustaka</label><br>
    <input type="file" name="daftarpustaka" id="daftarpustaka" id="daftarpustaka" accept="application/pdf"><br>
    <label for="lampiran">Lampiran</label><br>
    <input type="file" name="lampiran" id="lampiran" accept="application/pdf"><br>
    <input type="hidden" name="mahasiswa" id="mahasiswa_tambah_ta">
    <input type="submit" value="Tambah">
</form>