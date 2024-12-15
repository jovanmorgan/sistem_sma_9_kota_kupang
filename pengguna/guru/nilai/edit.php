<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_nilai = $_POST['id_nilai'];
$tanggal = $_POST['tanggal'];
$nilai_pengetahuan = $_POST['nilai_pengetahuan'];
$nilai_ketrampilan = $_POST['nilai_ketrampilan'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];

// Lakukan validasi data
if (empty($id_nilai) || empty($tanggal) || empty($nilai_pengetahuan) || empty($nilai_ketrampilan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk memperbarui data di tabel nilai
$query = "UPDATE nilai SET tanggal='$tanggal', nilai_pengetahuan='$nilai_pengetahuan', nilai_ketrampilan='$nilai_ketrampilan', id_tahun_ajar='$id_tahun_ajar' WHERE id_nilai='$id_nilai'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>