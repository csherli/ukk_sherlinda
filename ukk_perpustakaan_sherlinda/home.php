<?php
require_once 'graph.php';

$senin = date('Y-m-d', strtotime('monday this week'));
$minggu = date('Y-m-d', strtotime('sunday this week'));

$row = graph($senin, $minggu);

?>
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
</ol>
<div class="row">
<?php
  if  ($_SESSION['user']['level'] != 'peminjam') :
    ?> 
    <div class="col-xl-3 col-md-6">
    <div class="card text-black mb-4" style=background-color:pink>
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM kategori"));
                ?>
                Total Kategori Buku</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-black stretched-link" href="?page=kategori">View Details</a>
                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
    <div class="card text-black mb-4" style=background-color:pink>
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM buku"));
                ?>
                Total Buku</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-black stretched-link" href="?page=buku">View Details</a>
                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="col-xl-3 col-md-6">
    <div class="card text-black mb-4" style=background-color:pink>
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM ulasan"));
                ?>
                Total Ulasan</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-black stretched-link" href="?page=ulasan">View Details</a>
                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php
  if  ($_SESSION['user']['level'] == 'peminjam') :
    ?> 
    <div class="col-xl-3 col-md-6">
    <div class="card text-black mb-4" style=background-color:pink>
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM koleksi_pribadi"));
                ?>
                Total Koleksi pribadi</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-black stretched-link" href="?page=koleksi_pribadi">View Details</a>
                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
  </div>
  <?php endif;?>
<?php
  if  ($_SESSION['user']['level'] != 'peminjam') :
    ?> 
<div class="col-xl-3 col-md-6">
<div class="card text-black mb-4" style=background-color:pink>
        <div class="card-body">
            <?php
            echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM user"));
            ?>
            Total User</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        </div>
    </div>
</div>
<?php endif;?>
<div class="row">
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
<?php
  if  ($_SESSION['user']['level'] != 'peminjam') :
    ?> 
<div class="x_panel">
    <div class="x_title">
        <h2>Grafik Peminjaman</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <!-- <a class="close-link"><i class="fa fa-close"></i></a> -->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content d-flex justify-content-center">
        <div class="chart-container row justify-content-around my-5" style="position: relative; height:40vh; width:80vw">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<?php endif;?>
<!-- Grafik -->
<!-- <canvas id="myChart" width="40" height="40"></canvas> -->

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
                          
                        </div>
</script>