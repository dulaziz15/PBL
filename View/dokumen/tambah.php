<div class="body-main" id="modal-tambah-dokumen">
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
                    <div class="form-modal">
                        <div class="form-input">
                            <label for="">Tanda Terima PKL</label>
                            <input type="file" name="tanda_terima_pkl" accept="application/pdf">
                        </div>
                        <div class="form-input">
                            <label for="">Tanda Terima TA</label>
                            <input type="file" name="tanda_terima_ta" accept="application/pdf">
                        </div>
                        <div class="form-input">
                            <label for="">Bebas Kompen</label>
                            <input type="file" name="bebas_kompen" id="fileproject" accept="application/pdf">
                        </div>
                        <div class="form-input">
                            <label for="">Tugas Akhir</label>
                            <select name="tugas_akhir" id="dataTugasAkhir">

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
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getAll',
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(ta => {
                    tableContent += `
                        <option value="${ta.tugas_akhir_id}:${ta.NIM}">${ta.nama + " judul :  " + ta.judul}</option>
                    `;
                });
                $('#dataTugasAkhir').append(tableContent);
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>