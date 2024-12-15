<?php
include '../../../koneksi.php';

// Terima ID jadwal_kbm yang akan dihapus dari formulir HTML
$id_jadwal_kbm = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_jadwal_kbm)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data jadwal_kbm berdasarkan ID
$query_delete_jadwal_kbm = "DELETE FROM jadwal_kbm WHERE id_jadwal_kbm = '$id_jadwal_kbm'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_jadwal_kbm)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
