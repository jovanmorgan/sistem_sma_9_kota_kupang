<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_kepribadian = $_POST['id_kepribadian'];
$id_siswa = $_POST['id_siswa'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];
$semester = $_POST['semester'];
$kerajinan = $_POST['kerajinan'];
$kerapian = $_POST['kerapian'];
$keterampilan = $_POST['keterampilan'];

// Lakukan validasi data
if (empty($id_siswa) || empty($id_tahun_ajar) || empty($semester) || empty($kerajinan) || empty($kerapian) || empty($keterampilan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk memperbarui data di tabel kepribadian
$query = "UPDATE kepribadian SET id_siswa='$id_siswa', id_tahun_ajar='$id_tahun_ajar', semester='$semester', kerajinan='$kerajinan', kerapian='$kerapian', keterampilan='$keterampilan' WHERE id_kepribadian='$id_kepribadian'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>