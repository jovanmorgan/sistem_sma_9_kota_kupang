<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$kelas = $_POST['kelas'];

// Lakukan validasi data
if (empty($kelas)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan kelas pada kelas
$check_query = "SELECT * FROM kelas WHERE kelas = '$kelas'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "data_kelas_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data guru ke dalam database
$query = "INSERT INTO kelas (kelas) 
        VALUES ('$kelas')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
