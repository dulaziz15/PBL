<h1>Tambah Dokumen Pendukung</h1>
<form action="../../routes/route.php?page=dokumenpendukung&sub=addDokumen" method="post" enctype="multipart/form-data">
    <label for="tanda_terima_ta">Tanda Terima TA</label><br>
    <input type="file" name="tanda_terima_ta" id="" accept="application/pdf"><br>
    <label for="tanda_terima_pkl">Tanda Terima PKL</label><br>
    <input type="file" name="tanda_terima_pkl" id="" accept="application/pdf"><br>
    <label for="bebas_kompen">Bebas Kompen</label><br>
    <input type="file" name="bebas_kompen" id="" accept="application/pdf"><br>
    <input type="hidden" name="tugas_akhir" id="dataTugasAkhir">
    <input type="submit" value="Tambah">
</form>