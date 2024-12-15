<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_siswa = $_POST['id_siswa'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];
$semester = $_POST['semester'];
$keterangan = $_POST['keterangan'];

// Lakukan validasi data
if (empty($id_siswa) || empty($id_tahun_ajar) || empty($semester) || empty($keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Cek apakah data sudah ada
$query_check = "SELECT * FROM keterangan WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar' AND semester = '$semester'";
$result_check = mysqli_query($koneksi, $query_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "data_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data ke dalam tabel keterangan
$query = "INSERT INTO keterangan (id_siswa, id_tahun_ajar, semester, keterangan) 
            VALUES ('$id_siswa', '$id_tahun_ajar', '$semester', '$keterangan')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>