<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_siswa = $_POST['id_siswa'];
$id_tahun_ajar = $_POST['id_tahun_ajar'];
$semester = $_POST['semester'];
$kerajinan = $_POST['kerajinan'];
$kerapian = $_POST['kerapian'];
$keterampilan = $_POST['keterampilan'];

// Lakukan validasi data
if (empty($id_siswa) || empty($id_tahun_ajar) || empty($semester) || empty($kerajinan) || empty($kerapian) || empty($keterampilan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Cek apakah data sudah ada
$query_check = "SELECT * FROM kepribadian WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar' AND semester = '$semester'";
$result_check = mysqli_query($koneksi, $query_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "data_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data ke dalam tabel kepribadian
$query = "INSERT INTO kepribadian (id_siswa, id_tahun_ajar, semester, kerajinan, kerapian, keterampilan) 
            VALUES ('$id_siswa', '$id_tahun_ajar', '$semester', '$kerajinan', '$kerapian', '$keterampilan')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>