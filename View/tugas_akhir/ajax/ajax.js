function getAll() {
$.ajax({
    type: 'GET',
    url: '/Pbl/routes/route.php?page=tugasakhir&sub=getAll',
    success: function(data) {
        if (Array.isArray(data)) {
            let tableContent = '';
            data.forEach(tugas_akhir => {
                tableContent += `
                <tr>
                <td>${tugas_akhir.nama}</td>
                <td>${tugas_akhir.NIM}</td>
                <td>${tugas_akhir.judul}</td>
                <td>
                    <div>
                    <a class="status ${tugas_akhir.status == 1 ? 'status-verify' : 'status-revisi'}">
                        <i class="fa-solid ${tugas_akhir.status == 1 ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                            <span>${tugas_akhir.status == 1 ? 'Verifiy' : 'Revisi'}</span>
                            </a>
                    </div>
                </td>
                <td>
                    <a href="show.php?id=${tugas_akhir.tugas_akhir_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                    <a href="../../routes/route.php?page=tugasakhir&sub=edit&id=${tugas_akhir.tugas_akhir_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                    <a href="../../routes/route.php?page=tugasakhir&sub=hapus&id=${tugas_akhir.tugas_akhir_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                </td>
                </tr>
            `;
            });
            $('#dataTugasAkhir').html(tableContent);
            $('table').DataTable({
                paging: true, // Menampilkan paginasi
                searching: true, // Mengaktifkan pencarian
                ordering: true, // Mengaktifkan sorting
                info: true, // Menampilkan informasi tabel
                autoWidth: true, // Menonaktifkan pengaturan otomatis lebar kolom
                responsive: true, // Menyusun ulang kolom secara responsif di perangkat mobile
            });
        } else {
            console.error("Expected an array but received:", data);
        }
    },
    error: function(xhr, status, error) {
        console.error("AJAX request failed:", status, error);
    }
});
}