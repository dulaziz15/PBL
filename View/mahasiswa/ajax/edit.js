function editAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=getWithUser&id=' + id,
        success: function(data) {
            // console.log(data);
            $("#nim").val(data.NIM);
            $("#nama").val(data.nama);
            $("#kelas").val(data.kelas);
            $("#telp").val(data.telp);
            $("#temp_lahir").val(data.temp_lahir);
            $("#tgl_lahir").val(data.tgl_lahir);
            $("#alamat").val(data.alamat);
            $("#dataUser").append(`<option value="${data.user_id}" selected>${data.email}</option>`);
            $.ajax({
                type: 'GET',
                url: '/Pbl/routes/route.php?page=mahasiswa&sub=getUser',
                success: function(data) {
                    if (Array.isArray(data)) {
                        let tableContent = '';
                        data.forEach(user => {
                            tableContent += `
                        <option value="${user.user_id}">${user.email}
                    `;
                        });
                        $('#dataUser').append(tableContent);
                    } else {
                        console.error("Expected an array but received:", data);
                    }
                }
            })
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}