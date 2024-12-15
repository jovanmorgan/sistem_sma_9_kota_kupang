<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_kelas = $_POST['id_kelas'];
$id_mapel = $_POST['id_mapel'];
$jenjang = $_POST['jenjang'];

// Lakukan validasi data
if (empty($id_kelas) || empty($id_mapel)|| empty($jenjang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data guru ke dalam database
$query = "INSERT INTO absensi1 (id_kelas, id_mapel, jenjang) 
        VALUES ('$id_kelas', '$id_mapel', '$jenjang')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>