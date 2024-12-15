<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_jadwal_kbm = $_POST['id_jadwal_kbm'];
$id_mapel = $_POST['id_mapel'];
$id_guru = $_POST['id_guru'];
$id_kelas = $_POST['id_kelas'];
$hari = $_POST['hari'];
$jam_mengajar = $_POST['jam_mengajar'];
$jam_pulang = $_POST['jam_pulang'];
$tanggal = $_POST['tanggal'];

// Lakukan validasi data
if (empty($id_jadwal_kbm) ||empty($id_mapel) || empty($id_guru) || empty($id_kelas) || empty($hari) || empty($jam_mengajar) || empty($jam_pulang) || empty($tanggal)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE jadwal_kbm SET id_mapel = '$id_mapel', id_guru = '$id_guru', id_kelas = '$id_kelas', hari = '$hari', jam_mengajar = '$jam_mengajar', jam_pulang = '$jam_pulang', tanggal = '$tanggal' WHERE id_jadwal_kbm = '$id_jadwal_kbm'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>