<?php
include '../koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$nomor_telepon = $_POST['nomor_telepon'];
$username = $_POST['username'];
$password = $_POST['password'];
$alamat = $_POST['alamat'];

// Lakukan validasi data
if (empty($nama) || empty($nip) || empty($jenis_kelamin) || empty($nomor_telepon) || empty($username) || empty($password) || empty($alamat)) {
    echo "data_tidak_lengkap";
    exit();
}


// Buat query SQL untuk menambahkan data guru ke dalam database
$query = "INSERT INTO guru (nama, nip, jenis_kelamin, nomor_telepon, username, password, alamat) 
        VALUES ('$nama', '$nip', '$jenis_kelamin', '$nomor_telepon', '$username', '$password', '$alamat')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
