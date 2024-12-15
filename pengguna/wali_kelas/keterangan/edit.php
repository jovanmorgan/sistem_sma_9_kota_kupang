<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_keterangan = $_POST['id_keterangan'];
$id_siswa = $_POST['id_siswa'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];
$semester = $_POST['semester'];
$keterangan = $_POST['keterangan'];

// Lakukan validasi data
if (empty($id_siswa) || empty($id_tahun_ajar) || empty($semester) || empty($keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk memperbarui data di tabel keterangan
$query = "UPDATE keterangan SET id_siswa='$id_siswa', id_tahun_ajar='$id_tahun_ajar', semester='$semester', keterangan='$keterangan' WHERE id_keterangan='$id_keterangan'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>