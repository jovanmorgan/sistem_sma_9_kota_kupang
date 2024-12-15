<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id_mapel = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_mapel)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data mapel berdasarkan ID
$query_delete_mapel = "DELETE FROM mapel WHERE id_mapel = '$id_mapel'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_mapel)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
