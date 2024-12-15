<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id_keterangan = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data keterangan berdasarkan ID
$query_delete_keterangan = "DELETE FROM keterangan WHERE id_keterangan = '$id_keterangan'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_keterangan)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);