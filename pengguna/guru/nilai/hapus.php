<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari formulir HTML
$id_nilai = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_nilai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data nilai berdasarkan ID
$query_delete_nilai = "DELETE FROM nilai WHERE id_nilai = '$id_nilai'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_nilai)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);