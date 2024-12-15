<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_absensi1 = $_POST['id_absensi1'];
$id_kelas = $_POST['id_kelas'];
$id_mapel = $_POST['id_mapel'];
$jenjang = $_POST['jenjang'];

// Lakukan validasi data
if (empty($id_absensi1) ||empty($id_kelas) || empty($id_mapel)|| empty($jenjang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE absensi1 SET id_kelas = '$id_kelas', id_mapel = '$id_mapel', jenjang = '$jenjang' WHERE id_absensi1 = '$id_absensi1'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>