<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$jenis_kebutuhan_khusus = $_POST['jenis_kebutuhan_khusus'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($jenis_kebutuhan_khusus) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

$check_query = "SELECT * FROM kebutuhan_khusus WHERE jenis_kebutuhan_khusus = '$jenis_kebutuhan_khusus'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "data_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data guru ke dalam database
$query = "INSERT INTO kebutuhan_khusus (jenis_kebutuhan_khusus, deskripsi) 
        VALUES ('$jenis_kebutuhan_khusus', '$deskripsi')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>