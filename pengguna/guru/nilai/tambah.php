<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_mapel = $_POST['id_mapel'];
$id_siswa = $_POST['id_siswa'];
$semester = $_POST['semester'];
$type_nilai = $_POST['type_nilai'];
$tanggal = $_POST['tanggal'];
$nilai_pengetahuan = $_POST['nilai_pengetahuan'];
$nilai_ketrampilan = $_POST['nilai_ketrampilan'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];

// Lakukan validasi data
if (empty($id_mapel) || empty($id_siswa) || empty($semester) || empty($type_nilai) || empty($tanggal) || empty($nilai_pengetahuan) || empty($nilai_ketrampilan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data ke dalam tabel nilai
$query = "INSERT INTO nilai (id_mapel, id_siswa, semester, type_nilai, tanggal, nilai_pengetahuan, nilai_ketrampilan, id_tahun_ajar) 
          VALUES ('$id_mapel', '$id_siswa', '$semester', '$type_nilai', '$tanggal', '$nilai_pengetahuan', '$nilai_ketrampilan', '$id_tahun_ajar')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>