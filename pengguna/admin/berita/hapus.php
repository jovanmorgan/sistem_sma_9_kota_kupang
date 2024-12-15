<?php
include '../../../koneksi.php';

// Terima ID yang akan dihapus dari permintaan
$id_berita = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_berita)) {
    echo "data_tidak_lengkap";
    exit();
}

// Query untuk mendapatkan informasi foto yang terkait dengan data yang akan dihapus
$query_get_foto = "SELECT foto FROM berita WHERE id_berita = '$id_berita'";
$result_get_foto = mysqli_query($koneksi, $query_get_foto);

if ($result_get_foto) {
    $row = mysqli_fetch_assoc($result_get_foto);
    $foto = $row['foto'];

    // Buat query SQL untuk menghapus data berita berdasarkan ID
    $query_delete_berita = "DELETE FROM berita WHERE id_berita = '$id_berita'";

    // Jalankan query untuk menghapus data
    if (mysqli_query($koneksi, $query_delete_berita)) {
        // Query untuk memeriksa apakah ada data lain yang menggunakan foto yang sama
        $query_check_foto_usage = "SELECT COUNT(*) as count FROM berita WHERE foto = '$foto'";
        $result_check_foto_usage = mysqli_query($koneksi, $query_check_foto_usage);
        $count_data = mysqli_fetch_assoc($result_check_foto_usage)['count'];

        // Jika tidak ada data lain yang menggunakan foto tersebut, hapus file foto
        if ($count_data == 0 && file_exists($foto)) {
            unlink($foto);
        }

        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>