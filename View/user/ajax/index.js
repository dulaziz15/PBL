function indexAjax() {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=user&sub=getAll',
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(user => {
                    tableContent += `
                        <tr>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.password}</td>
                        <td>
                            ${user.role == 1 ? "Super Admin" : (user.role == 2 ? "Mahasiswa" : (user.role == 3 ? "Admin Jurusan" : (user.role == 4 ? "Admin Prodi" : "")))}
                        </td>
                        <td>
                            <a href="update.php?id=${user.user_id}" rel="modal:open" class="modal-btn btn btn-edit"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                            <a href="../../routes/route.php?page=user&sub=hapus&id=${user.user_id}" onclick=" return confirm('Apakah Anda yakini ingin menghapus user dengan email ${user.email} ?')" class="btn btn-hapus"><i class="fa-solid fa-trash"></i>Hapus</a>
                        </td>
                        </tr>
                    `;
                });
                $('#dataUser').html(tableContent);
                $('table').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: true,
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ entri per halaman",
                        info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                        infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                        infoFiltered: "(disaring dari _MAX_ total entri)",
                        rowReorder: {
                            selector: 'td:nth-child(2)'
                        }
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