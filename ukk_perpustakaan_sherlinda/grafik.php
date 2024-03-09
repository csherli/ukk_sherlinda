<!DOCTYPE html>
<html>
<head>
    <title>Grafik Peminjaman Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
// Koneksi ke database (sesuaikan dengan detail koneksi Anda)
$host = 'localhost'; // Host database
$user = 'root'; // Username database
$password = ''; // Password database
$database = 'ukk_perpustakaan_sherlinda'; // Nama database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data peminjaman buku
$query = "SELECT tanggal_peminjaman, COUNT(*) as total_peminjaman FROM peminjaman GROUP BY tanggal_peminjaman";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data
$tanggal_peminjaman = [];
$total_peminjaman = [];

while ($row = mysqli_fetch_assoc($result)) {
    $tanggal_peminjaman[] = $row['tanggal_peminjaman'];
    $total_peminjaman[] = $row['total_peminjaman'];
}
?>
<style>
    @media(max-width: 720px) { 
        .chart-container  {
            min-height: 100vh; 
        };
    };
</style>
<div class="x_panel">
    <div class="x_title">
        <h2>Grafik Peminjaman</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content d-flex justify-content-center">
        <div class="chart-container row justify-content-around my-5" style="position: relative; height:40vh; width:80vw">
            <canvas id="myChart"></canvas>
            <canvas id="myPie"></canvas>
        </div>
    </div>
</div>
<!-- Grafik -->
<canvas id="myChart" width="40" height="40"></canvas>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($tanggal_peminjaman); ?>,
            datasets: [{
                label: 'Total Peminjaman Buku',
                data: <?php echo json_encode($total_peminjaman); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
