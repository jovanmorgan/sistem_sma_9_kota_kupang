<?php
session_start();

// Pastikan session 'id_kepalah_sekolah' sudah ter-set
if (!isset($_SESSION['id_kepalah_sekolah'])) {
    // Redirect atau berikan respons sesuai kebutuhan jika session tidak tersedia
    exit("Session 'id_kepalah_sekolah' tidak tersedia.");
}

include '../../../koneksi.php';

// Folder tempat menyimpan gambar
$target_dir = "../data_fp/";

// Mendapatkan nama file gambar
$image = $_POST['imageBase64'];

// Menyimpan gambar ke folder data_fp
list($type, $image) = explode(';', $image);
list(, $image) = explode(',', $image);
$image = base64_decode($image);
$filename = uniqid() . '.png'; // Membuat nama unik untuk gambar
$file = $target_dir . $filename;
file_put_contents($file, $image);

// Mengambil nama foto profile sebelumnya
$id_kepalah_sekolah = $_SESSION['id_kepalah_sekolah'];
$select_query = "SELECT fp FROM kepalah_sekolah WHERE id_kepalah_sekolah = '$id_kepalah_sekolah'";
$select_result = mysqli_query($koneksi, $select_query);

// Jika foto profile sebelumnya ditemukan, hapus file tersebut
if (mysqli_num_rows($select_result) > 0) {
    $row = mysqli_fetch_assoc($select_result);
    $previous_image = $row['fp'];
    $previous_file = $target_dir . $previous_image;
    if (file_exists($previous_file) && is_file($previous_file)) {
        unlink($previous_file); // Hapus file gambar sebelumnya jika ada dan merupakan file
    }
}

// Update nama gambar di tabel kepalah_sekolah berdasarkan id_kepalah_sekolah
$update_query = "UPDATE kepalah_sekolah SET fp = '$filename' WHERE id_kepalah_sekolah = '$id_kepalah_sekolah'";
$update_result = mysqli_query($koneksi, $update_query);

if ($update_result) {
    // Berhasil menyimpan gambar dan update nama gambar di tabel kepalah_sekolah
    echo "Gambar berhasil diupdate.";
} else {
    // Gagal melakukan update
    echo "Gagal mengupdate gambar.";
}

// Tutup koneksi database
mysqli_close($koneksi);