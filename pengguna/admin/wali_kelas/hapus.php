<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id_wali_kelas = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_wali_kelas)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data berdasarkan ID
$query_delete = "DELETE FROM wali_kelas WHERE id_wali_kelas = '$id_wali_kelas'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
