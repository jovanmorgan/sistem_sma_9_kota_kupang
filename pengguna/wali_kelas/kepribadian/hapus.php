<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id_kepribadian = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_kepribadian)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data kepribadian berdasarkan ID
$query_delete_kepribadian = "DELETE FROM kepribadian WHERE id_kepribadian = '$id_kepribadian'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_kepribadian)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);