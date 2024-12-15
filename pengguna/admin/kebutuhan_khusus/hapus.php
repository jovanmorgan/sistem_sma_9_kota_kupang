<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id)) {
    echo "data_tidak_lengkap";
    exit();
}

$query_delete = "DELETE FROM kebutuhan_khusus WHERE id_kebutuhan_khusus = '$id'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
