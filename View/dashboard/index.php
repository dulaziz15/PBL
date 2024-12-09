<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
<div class="akun">
            Selamat Datang <?= $_SESSION['user']['email'] ?>
        </div>
    <div class="header-main">
        <h2>Dashboard</h2>
    </div>
    <div class="body-main">
        <div class="main-dashboard">

        </div>

        <!-- Statistics section -->
        <section class="statistics">
            <div class="chart-container">
                <!-- Grafik Bar -->
                <canvas class="chart" id="barChart"></canvas>
            </div>
            <div class="chart-container">
                <!-- Grafik Line -->
                <canvas class="chart" id="barChart2"></canvas>
            </div>
            <div class="chart-container">
                <!-- Grafik Line -->
                <canvas class="chart" id="barChart3"></canvas>
            </div>
        </section>

    </div>
</div>
<?php
include "../component/footer.php";
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=bebastanggungan&sub=dataDashboard',
        success: function(data) {
            let tableContent = '';
            tableContent += `
                <div class="card-dashboard">
                    <h3>Total Dokumen TA</h3>
                    <h3>${data.total_ta}</h3>
                    <div class="content-ta">
                        <div class="jumlah-ta">
                            <div class="verify">
                                <h4>Verify</h4>
                            <h4>${data.ta_approved}</h4>
                            </div>
                            <div class="revisi">
                                <h4>Revisi</h4>
                                <h4>${data.total_ta - data.ta_approved}</h4>
                            </div>
                        </div>
                        <div class="read-more">
                            <a href="">Read More <i class="fa-solid fa-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-dashboard">
                    <h3>Total Dokumen Pendukung</h3>
                    <h3>${data.total_dokumen}</h3>
                    <div class="content-ta">
                        <div class="jumlah-ta">
                            <div class="verify">
                                <h4>Verify</h4>
                            <h4>${data.dokumen_approved}</h4>
                            </div>
                            <div class="revisi">
                                <h4>Revisi</h4>
                                <h4>${data.total_dokumen - data.dokumen_approved}</h4>
                            </div>
                            </div>
                        <div class="read-more">
                            <a href="#">Read More <i class="fa-solid fa-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-dashboard">
                    <h3>Total Bebas Tanggungan</h3>
                    <h3>${data.total_bebas_tanggungan}</h3>
                    <div class="content-ta">
                        <div class="jumlah-ta">
                            <div class="verify">
                                <h4>Verify</h4>
                                <h4>${data.bebas_tanggungan_approved}</h4>
                            </div>
                            <div class="revisi">
                                <h4>Revisi</h4>
                                <h4>${data.total_bebas_tanggungan - data.bebas_tanggungan_approved}</h4>
                            </div>
                        </div>
                        <div class="read-more">
                            <a href="#">Read More <i class="fa-solid fa-circle-right"></i></a>
                        </div>
                    </div>
                </div>`;
            $('.main-dashboard').html(tableContent);
            
            const ctxBar = document.getElementById('barChart').getContext('2d');
            const barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Total', 'verify', 'Revisi'], // Label untuk setiap kategori
                    datasets: [{
                        label: 'Jumlah Dokumen TA',
                        data: [data.total_ta, data.ta_approved, data.total_ta - data.ta_approved], // Data penjualan
                        backgroundColor: '#2980B9', // Warna batang
                        borderColor: '#2980B9',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return ' ' + tooltipItem.raw.toLocaleString(); // Format angka dalam tooltip
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai dari angka 0
                            ticks: {
                                callback: function(value) {
                                    return ' ' + value.toLocaleString(); // Format angka di sumbu Y
                                }
                            }
                        }
                    }
                }
            });

            const ctxBar2 = document.getElementById('barChart2').getContext('2d');
            const barChart2 = new Chart(ctxBar2, {
                type: 'bar',
                data: {
                    labels: ['Total', 'Approved', 'Pending'], // Label untuk setiap kategori
                    datasets: [{
                        label: 'Jumlah Bebas Tanggungan',
                        data: [data.total_bebas_tanggungan, data.bebas_tanggungan_approved, data.total_bebas_tanggungan - data.bebas_tanggungan_approved], // Data penjualan
                        backgroundColor: '#04aa6d', // Warna batang
                        borderColor: '#04aa6d',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return ' ' + tooltipItem.raw.toLocaleString(); // Format angka dalam tooltip
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai dari angka 0
                            ticks: {
                                callback: function(value) {
                                    return ' ' + value.toLocaleString(); // Format angka di sumbu Y
                                }
                            }
                        }
                    }
                }
            });

            const ctxBar3 = document.getElementById('barChart3').getContext('2d');
            const barChart3 = new Chart(ctxBar3, {
                type: 'bar',
                data: {
                    labels: ['Mahasiswa', 'TA', 'Tuntas'], // Label untuk setiap kategori
                    datasets: [{
                        label: 'Recap Jumlah',
                        data: [data.total_mahasiswa, data.total_ta, data.bebas_tanggungan_approved], // Data penjualan
                        backgroundColor: '#2980B9', // Warna batang
                        borderColor: '#2980B9',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return ' ' + tooltipItem.raw.toLocaleString(); // Format angka dalam tooltip
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai dari angka 0
                            ticks: {
                                callback: function(value) {
                                    return ' ' + value.toLocaleString(); // Format angka di sumbu Y
                                }
                            }
                        }
                    }
                }
            });

        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>