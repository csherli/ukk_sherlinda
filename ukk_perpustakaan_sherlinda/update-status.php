<?php 
require_once "koneksi.php";

$n = 'dikembalikan';
$id = $_GET["id"];

$query = mysqli_query($koneksi, "UPDATE peminjaman SET status_peminjaman='$n' WHERE id_peminjaman='$id'");


if($query){
    exit(header("location:index.php?page=laporan"));
}