<?php
session_start();

// Pastikan session 'id_wali_kelas' sudah ter-set
if (!isset($_SESSION['id_wali_kelas'])) {
    // Redirect atau berikan respons sesuai kebutuhan jika session tidak tersedia
    exit("Session 'id_wali_kelas' tidak tersedia.");
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
$id_wali_kelas = $_SESSION['id_wali_kelas'];
$select_query = "SELECT fp FROM wali_kelas WHERE id_wali_kelas = '$id_wali_kelas'";
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

// Update nama gambar di tabel wali_kelas berdasarkan id_wali_kelas
$update_query = "UPDATE wali_kelas SET fp = '$filename' WHERE id_wali_kelas = '$id_wali_kelas'";
$update_result = mysqli_query($koneksi, $update_query);

if ($update_result) {
    // Berhasil menyimpan gambar dan update nama gambar di tabel wali_kelas
    echo "Gambar berhasil diupdate.";
} else {
    // Gagal melakukan update
    echo "Gagal mengupdate gambar.";
}

// Tutup koneksi database
mysqli_close($koneksi);
