<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_siswa = $_POST['id_siswa'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_kelas = $_POST['id_kelas'];
$id_kebutuhan_khusus = $_POST['id_kebutuhan_khusus'];
$alamat = $_POST['alamat'];
$jenjang = $_POST['jenjang'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];

// Lakukan validasi data
if (empty($id_tahun_ajar) || empty($id_siswa) || empty($nis) || empty($nama) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($username) || empty($password) || empty($id_kelas) || empty($id_kebutuhan_khusus) || empty($jenjang) || empty($alamat)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan username pada guru
$check_query = "SELECT * FROM guru WHERE username = '$username'";
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
$check_query_siswa = "SELECT * FROM siswa WHERE username = '$username' AND id_siswa != '$id_siswa'";
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

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y', strtotime($tanggal_lahir));

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE siswa SET nama = '$nama', nis = '$nis', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_formatted', username = '$username', password = '$password', id_kelas = '$id_kelas', id_kebutuhan_khusus = '$id_kebutuhan_khusus', alamat = '$alamat', jenjang = '$jenjang', id_kelas = '$id_kelas' WHERE id_siswa = '$id_siswa'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>