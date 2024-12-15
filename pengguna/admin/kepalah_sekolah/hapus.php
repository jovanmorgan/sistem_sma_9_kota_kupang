<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id_kepalah_sekolah = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_kepalah_sekolah)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data berdasarkan ID
$query_delete = "DELETE FROM kepalah_sekolah WHERE id_kepalah_sekolah = '$id_kepalah_sekolah'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
