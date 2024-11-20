function getAll() {
$.ajax({
    type: 'GET',
    url: '/Pbl/routes/route.php?page=tugasakhir&sub=getAll',
    success: function(data) {
        console.log(data);
        if (Array.isArray(data)) {
            let tableContent = '';
            data.forEach(tugas_akhir => {
                tableContent += `
                <tr>
                <td>${tugas_akhir.nama}</td>
                <td>${tugas_akhir.NIM}</td>
                <td>${tugas_akhir.judul}</td>
                <td>
                    <a class="status status-verify">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Verify</span>
                    </a>
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
        } else {
            console.error("Expected an array but received:", data);
        }
    },
    error: function(xhr, status, error) {
        console.error("AJAX request failed:", status, error);
    }
});
}