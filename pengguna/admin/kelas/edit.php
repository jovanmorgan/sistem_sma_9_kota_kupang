<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_kelas = $_POST['id_kelas'];
$kelas = $_POST['kelas'];

// Lakukan validasi data
if (empty($kelas)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan kelas pada kelas
$check_query = "SELECT * FROM kelas WHERE kelas = '$kelas' AND id_kelas != '$id_kelas'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "data_kelas_sudah_ada";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE kelas SET kelas = '$kelas' WHERE id_kelas = '$id_kelas'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>