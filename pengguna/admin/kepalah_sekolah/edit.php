<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_kepalah_sekolah = $_POST['id_kepalah_sekolah'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($nama) || empty($username) || empty($password)) {
    echo "data_tidak_lengkap";
    exit();
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
$check_query_kepalah_sekolah = "SELECT * FROM kepalah_sekolah WHERE username = '$username' AND id_kepalah_sekolah != '$id_kepalah_sekolah'";
$check_result_kepalah_sekolah = mysqli_query($koneksi, $check_query_kepalah_sekolah);

if (mysqli_num_rows($check_result_kepalah_sekolah) > 0) {
    echo "data_username_sudah_ada";
    exit();
}


// Buat query SQL untuk mengupdate data
$query_update = "UPDATE kepalah_sekolah SET nama = '$nama', username = '$username', password = '$password' WHERE id_kepalah_sekolah = '$id_kepalah_sekolah'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>