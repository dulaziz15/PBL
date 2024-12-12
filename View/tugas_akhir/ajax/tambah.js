function tambahAjax() {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=getAll',
        success: function (data) {
            // console.log(data);
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(mahasiswa => {
                    tableContent += `
                        <option value="${mahasiswa.mahasiswa_id}:${mahasiswa.NIM}">${mahasiswa.nama}</option>
                    `;
                });
                $('#dataMahasiswa').append(tableContent);
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
    $(document).ready(function () {
        $("select").select2();
    });
}