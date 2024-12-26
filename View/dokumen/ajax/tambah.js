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