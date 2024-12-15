<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_mapel = $_POST['id_mapel'];
$id_guru = $_POST['id_guru'];
$id_kelas = $_POST['id_kelas'];
$hari = $_POST['hari'];
$jam_mengajar = $_POST['jam_mengajar'];
$jam_pulang = $_POST['jam_pulang'];
$tanggal = $_POST['tanggal'];

// Lakukan validasi data
if (empty($id_mapel) || empty($id_guru) || empty($id_kelas) || empty($hari) || empty($jam_mengajar) || empty($jam_pulang) || empty($tanggal)) {
    echo "data_tidak_lengkap";
    exit();
}

$query = "INSERT INTO jadwal_kbm (id_mapel, id_guru, id_kelas, hari, jam_mengajar, jam_pulang, tanggal) 
        VALUES ('$id_mapel', '$id_guru', '$id_kelas', '$hari', '$jam_mengajar', '$jam_pulang', '$tanggal')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
