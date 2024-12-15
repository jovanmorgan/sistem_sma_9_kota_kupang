<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$nama_mapel = $_POST['nama_mapel'];

// Lakukan validasi data
if (empty($nama_mapel)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan mapel pada mapel
$check_query = "SELECT * FROM mapel WHERE nama_mapel = '$nama_mapel'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "data_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data guru ke dalam database
$query = "INSERT INTO mapel (nama_mapel) 
        VALUES ('$nama_mapel')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
