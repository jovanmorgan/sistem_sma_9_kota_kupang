<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$nomor_telepon = $_POST['nomor_telepon'];
$username = $_POST['username'];
$password = $_POST['password'];
$alamat = $_POST['alamat'];
$jenjang = $_POST['jenjang'];

// Lakukan validasi data
if (empty($nama) || empty($nip) || empty($jenis_kelamin) || empty($jenjang) || empty($nomor_telepon) || empty($username) || empty($password) || empty($alamat)) {
    echo "data_tidak_lengkap";
    exit();
}


// Ganti "0" dengan "62" pada nomor telepon jika dimulai dengan "0"
if (substr($nomor_telepon, 0, 1) === '0') {
    $nomor_telepon = '62' . substr($nomor_telepon, 1);
}

// pengecekan username pada admin
$check_query = "SELECT * FROM admin WHERE username = '$username'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// pengecekan username pada guru
$check_query_guru = "SELECT * FROM guru WHERE username = '$username'";
$check_result_guru = mysqli_query($koneksi, $check_query_guru);

if (mysqli_num_rows($check_result_guru) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// pengecekan username pada wali_kelas
$check_query_wali_kelas = "SELECT * FROM wali_kelas WHERE username = '$username'";
$check_result_wali_kelas = mysqli_query($koneksi, $check_query_wali_kelas);

if (mysqli_num_rows($check_result_wali_kelas) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// pengecekan username pada siswa
$check_query_siswa = "SELECT * FROM siswa WHERE username = '$username'";
$check_result_siswa = mysqli_query($koneksi, $check_query_siswa);

if (mysqli_num_rows($check_result_siswa) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// pengecekan username pada kepalah_sekolah
$check_query_kepalah_sekolah = "SELECT * FROM kepalah_sekolah WHERE username = '$username'";
$check_result_kepalah_sekolah = mysqli_query($koneksi, $check_query_kepalah_sekolah);

if (mysqli_num_rows($check_result_kepalah_sekolah) > 0) {
    echo "data_username_sudah_ada";
    exit();
}


// Buat query SQL untuk menambahkan data guru ke dalam database
$query = "INSERT INTO guru (nama, nip, jenis_kelamin, nomor_telepon, username, password, alamat, jenjang) 
        VALUES ('$nama', '$nip', '$jenis_kelamin', '$nomor_telepon', '$username', '$password', '$alamat', '$jenjang')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
