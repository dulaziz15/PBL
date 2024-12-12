function showAjax(id, role) {
    $(document).ready(function () {
        $("#button-add-catatan").click(function () {
            $("#form-catatan").slideToggle("slow");
        });
    });

    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneDokumen&id=' + id,
        success: function (data) {
            $("#data").html(`<p>${data.judul}</p>`);
            $(".pdf").append(`<span>${data.nama_file}</span><br><embed src="../../src/bebas_tanggungan/${data.NIM}/${data.nama_file}" />`)
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });

    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getCatatanTA&id=' + id,
        success: function (data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(catatan => {
                    tableContent += `
                            <div class="catatan-body">
                                <div class="text">
                                    ${catatan.catatan}
                                </div>
                                <div class="status-catatan">
                                    <div><span>Status Catatan</span></div>
                                        <a style="margin: 10px;" class="status ${catatan.status_catatan_ta == 'Approved' ? 'status-verify' : catatan.status_catatan_ta == 'Pending' ? 'status-revisi' : 'status-submit'}">
                                                    <i class="fa-solid ${catatan.status_catatan_ta == 'Approved' ? 'fa-circle-check' : catatan.status_catatan_ta == 'Pending' ? 'fa-pen-to-square' : 'fa-paper-plane'}"></i>
                                                        <span>${catatan.status_catatan_ta == 'Approved' ? 'Verifiy' : catatan.status_catatan_ta == 'Pending' ? 'Revisi' : 'Pengajuan'}</span>
                                                </a>
                                <div class="form-catatan tambah-catatan">
                                <form method="post" style="display: none;" class="form-catatan" id="form-edit-catatan-${catatan.catatan_id}">
                                    <input type="text" placeholder="catatan" name="catatan" id="edit-catatan-${catatan.catatan_id}"><br>
                                    <input type="submit" value="Update" class="btn btn-submit" onclick="updateCatatan(${catatan.catatan_id})"><br>
                                </form>
                                </div>
                                    <div class="verifikasi-catatan">
                                        <div class="catatan-admin">
                                            <a onclick="VerifyCatatan(${catatan.catatan_id})" class="btn btn-verifikasi" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:none;"' : ''} ">
                                                <i class="fa-solid fa-circle-check"></i>
                                                <span>Verifikasi</span>
                                            </a>
                                            <a onclick="EditCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:none;"' : ''} ">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a onclick="HapusCatatan(${catatan.catatan_id})" class="btn btn-hapus" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:block;"' : ''} ">
                                                <i class="fa-solid fa-trash"></i>
                                                <span>Hapus</span>
                                            </a>
                                        </div>
                                        <div class="catatan-mahasiswa">
                                            <a onclick="PengajuanCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:none;"' : ''} ">
                                                <i class="fa-solid fa-paper-plane"></i>
                                                <span>Pengajuan</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `;
                });
                $('.card-catatan').append(tableContent);
                if (role == 2) {
                    $('.catatan-admin').css('display', 'none');
                } else {
                    $('.catatan-mahasiswa').css('display', 'none');
                }
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}

function VerifyCatatan(id) {
    $.post("/Pbl/routes/route.php?page=tugasakhir&sub=verifikasiCatatan&id=" + id, {
        id: id
    },
        function (data, status) {
            alert("Proses verifikasi berhasil!");
            window.location.reload();
        });
}

function updateCatatan(id) {
    $.post("/Pbl/routes/route.php?page=tugasakhir&sub=updateCatatan&id=" + id, {
        id: id,
        catatan: $('#edit-catatan-' + id).val()
    },
        function (data, status) {
            alert("Proses Update berhasil!");
            window.location.reload();
        });
}

function PengajuanCatatan(id) {
    $.post("/Pbl/routes/route.php?page=tugasakhir&sub=pengajuanCatatan&id=" + id, {
        id: id
    },
        function (data, status) {
            alert("Proses Pengajuan berhasil!");
            window.location.reload();
        });
}

function HapusCatatan(id) {
    $.post("/Pbl/routes/route.php?page=tugasakhir&sub=hapusCatatan&id=" + id, {
        id: id
    },
        function (data, status) {
            alert("Proses Hapus berhasil!");
            window.location.reload();
        });
}

function EditCatatan(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneCatatan&id=' + id,
        success: function (data) {
            $(document).ready(function () {
                $("#form-edit-catatan-" + id).slideToggle("slow");
            });
            $('#edit-catatan-' + data.catatan_id).val(data.catatan);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}