<?php 
require_once "koneksi.php";


if(isset($_POST['buat'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $alamat = $_POST['alamat'];
    $nama = $_POST['nama'];
    $no_telpon = $_POST['no_telpon'];
    $level = ['peminjam'];

    mysqli_query($koneksi, "INSERT INTO user (username, password, email, nama_lengkap, alamat, no_telpon, level) VALUES ('$username', '$pass', '$email', '$nama', '$alamat', '$no_telpon', ')");
}

$query = mysqli_query($koneksi, "SELECT * FROM user");

$row = [];

while($result = mysqli_fetch_array($query)){
    $row[] = $result;
}

?>

<div class="x_panel">
    <!-- Header -->
    <div class="x_title">
        <h2>Data User</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- \Header -->

    <!-- Content -->
   

    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah User
                </button>
                <div class="card-box table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach($row as $rows) : ?>
                                <tr>
                                    <td><?= $rows["username"] ?></td>
                                    <td><?= $rows["email"] ?></td>
                                    <td><?= $rows["nama_lengkap"] ?></td>
                                    <td><?= $rows["alamat"] ?></td>
                                    <td><?= $rows["no_telpon"] ?></td>
                                    <td><?= $rows["level"] ?></td>
                                    <td>
                                        <a class="btn btn-danger rounded" href="?page=user_hapus&id=<?= $rows["id_user"] ?>" onclick="return confirm('Hapus <?= $rows['username'] ?>?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- \Content -->

</div>




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="pass" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="no_telpon" placeholder="No Telpon" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="level" placeholder="level" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="buat">Buat</button>
        </div>
    </form>
    </div>
  </div>
</div>