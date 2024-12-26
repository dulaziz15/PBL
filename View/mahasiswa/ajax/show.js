function showAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=show&id=' + id,
        success: function(data) {
            console.log(data);
            $("#biodata-mahasiswa").append(`
                <li>Nama: ${data.nama}</li>
                <li>NIM: ${data.NIM}</li>
                <li>kelas: ${data.kelas}</li>
                <li>No Telp: ${data.telp}</li>
                <li>Tempat, Tanggal lahir: ${data.temp_lahir + ', ' + data.tgl_lahir}</li>
                <li>Alamat: ${data.alamat}</li>
            `);
            $(".keterangan-profil").append(`
                <h4>${data.nama}</h4>
                <h4>${data.NIM}</h4>
                `)
                $(".img-profile").append(`<img src="../../src/img/mahasiswa/${data.img}" alt="">`)
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}