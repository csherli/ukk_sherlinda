<?php
// Data koleksi pribadi (contoh data)
// $personal_collection = [
//     [
//         'kategori' => 'psikologi',
//         'judul' => 'Psikologi Politik',
//         'penulis' => 'WHINDA YUSTISIA, MOH. ABDUL HAKIM, RAHMAN ARDI',
//         'penerbit' => 'Pbk',
//         'tahun_terbit' => 2021,
//         'deskripsi' => 'Jika pada umumnya analisis perilaku politik di Indonesia lebih banyak dilihat dari perspektif makro, seperti sistem politik dan partai politik, buku ini menghadirkan pembahasan dari sudut pandang mikro. Mencakup pembahasan tentang peran kepribadian, kognisi, afeksi, emosi, dan sikap pada masyarakat awam maupun elite politik dalam berbagai konteks politik (kepemimpinan politik, pemilihan umum, konflik antarkelompok, dan terorisme)'
//     ],
//     [
//         'kategori' => 'Teknologi',
//         'judul' => 'Pengantar Akuntansi Konsep Dasar Akuntansi',
//         'penulis' => 'Wati Aris Astuti, S.E.,M.Si., Ak., Ca.',
//         'penerbit' => 'informatika',
//         'tahun_terbit' => 2022,
//         'deskripsi' => 'Buku Pengantar Akuntansi dengan Konsep Dasar Akuntansi dikhususkan untuk para mahasiswa/l baik program diploma atau sarjana, teknisi akuntansi maupun non akuntansi, masyarakat umum dan semua pihak yang ingin belajar Akuntansi. Pengantar Akuntansi merupakan salah satu mata kuliah yang ada di fakultas ekonomi dan bisnis di program studi akuntansi. '
//     ]
//         'kategori' => 'Teknik Dasar Bermain Olahraga Pentanque',
//         'judul' => 'olahraga',
//         'penulis' => 'RAMDAN PELANA DKK',
//         'penerbit' => 'RajaGrafindo Persada',
//         'tahun_terbit' => 2020,
//         'deskripsi' => 'Petanque dalam bahasa Prancis atau pay/tah~k atau petong) awalnya merupakan permainan tradisional asal negara Prancis yang merupakan pengembangan dari permainan zaman Yunani Kuno sekitar abad ke-6 SM,

//     ]
// ];

// $query = mysqli_query($koneksi, "SELECT*FROM koleksi_pribadi LEFT JOIN user ON user.id_user = koleksi_pribadi.id_user LEFT JOIN buku ON buku.id_buku = koleksi_pribadi.id_buku");

$id_user = $_SESSION['user']['id_user'];
$query = mysqli_query($koneksi, "SELECT*FROM koleksi_pribadi LEFT JOIN user ON user.id_user = koleksi_pribadi.id_user LEFT JOIN buku ON buku.id_buku = koleksi_pribadi.id_buku WHERE koleksi_pribadi.id_user = '$id_user'");

$row = [];

while ($result = mysqli_fetch_array($query)) {
    $row[] = $result;
}


?>

<h1 class="mt-4">Koleksi Pribadi</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <a href="?page=koleksi_tambah" class="btn btn-primary">+ Tambah Data</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>No</th>
                        <!-- <th>Nama Kategori</th> -->
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>


                    </tr>
                    <?php
                    $i = 1;
                    foreach ($row as $book) {
                    ?>
                        <tr><?php
                            // Misalkan ada variabel $isAdmin yang menunjukkan apakah pengguna adalah admin atau tidak
                            $isAdmin = true; // Anda harus menggantinya dengan logika autentikasi yang sesungguhnya

                            foreach ($row as $book) {
                            ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $book['judul'] ; ?></td>
                            <td><?php echo $book['penulis'] ; ?></td>
                            <td><?php echo $book['penerbit'] ; ?></td>
                            <td><?php echo $book['tahun_terbit']; ?></td>
                            <td><?php echo $book['deskripsi']; ?></td>
                            <!-- Cek apakah pengguna adalah admin -->
                            <?php if ($isAdmin) : ?>
                                <td>
                                    <a onclick="return confirm('Apakah anda yakin menghapus data ini?');" href="?page=koleksi_hapus&&id=<?php echo $book['id_koleksi']; ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php
                            }
                    ?>

                    </tr>
                <?php
                    }
                ?>
                </table>
            </div>
        </div>
    </div>
</div>