function indexAjax() {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=getAll',
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(mahasiswa => {
                    tableContent += `
                    <tr>
                    <td>${mahasiswa.NIM}</td>
                    <td>${mahasiswa.nama}</td>
                    <td>${mahasiswa.kelas}</td>
                    <td>${mahasiswa.telp}</td>
                    <td>${mahasiswa.alamat}</td>
                    <td>
                        <a href="show.php?id=${mahasiswa.mahasiswa_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                        <a href="edit.php?id=${mahasiswa.mahasiswa_id}" rel="modal:open" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                        <a href="../../routes/route.php?page=mahasiswa&sub=hapus&id=${mahasiswa.mahasiswa_id}" onclick="return confirm('Apakah anda yakin ingin menghapus data mahasiswa dengan nama ${mahasiswa.nama} ?')" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                    </td>
                    </tr>
                `;
                });
                $('#dataMahasiswa').html(tableContent);
                $('table').DataTable({
                    paging: true, // Menampilkan paginasi
                    searching: true, // Mengaktifkan pencarian
                    ordering: true, // Mengaktifkan sorting
                    info: true, // Menampilkan informasi tabel
                    autoWidth: true, // Menonaktifkan pengaturan otomatis lebar kolom
                    responsive: true,
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    }
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