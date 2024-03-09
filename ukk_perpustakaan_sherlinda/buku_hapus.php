<?php 
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku=$id");
?>
<script>
	alert('Buku Ini Tidak Dapat dihapus,Karena Sedang Dipinjam');
	location.href = "index.php?page=buku";
</script>