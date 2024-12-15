<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_mapel = $_POST['id_mapel'];
$nama_mapel = $_POST['nama_mapel'];

// Lakukan validasi data
if (empty($id_mapel) || empty($nama_mapel)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan mapel pada mapel
$check_query = "SELECT * FROM mapel WHERE nama_mapel = '$nama_mapel' AND id_mapel != '$id_mapel'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "data_mapel_sudah_ada";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE mapel SET nama_mapel = '$nama_mapel' WHERE id_mapel = '$id_mapel'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>