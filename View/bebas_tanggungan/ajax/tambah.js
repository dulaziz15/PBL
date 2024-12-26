$.ajax({
    type: 'GET',
    url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getAllVerify',
    success: function(data) {
        if (Array.isArray(data)) {
            let tableContent = '';
            data.forEach(tugas_akhir => {
                tableContent += `
                        <option value="${tugas_akhir.tugas_akhir_id}">${tugas_akhir.nama}</option>
                    `;
            });
            $('#list-tugas-akhir').html(tableContent);
        } else {
            console.error("Expected an array but received:", data);
        }
    },
    error: function(xhr, status, error) {
        console.error("AJAX request failed:", status, error);
    }
});