<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$tahun_ajar_awal = $_POST['tahun_ajar_awal'];
$tahun_ajar_akhir = $_POST['tahun_ajar_akhir'];

// Lakukan validasi
if (empty($tahun_ajar_awal) || empty($tahun_ajar_akhir)) {
    echo "data_tidak_lengkap";
    exit();
}

if ($tahun_ajar_awal >= $tahun_ajar_akhir) {
    echo "tahun_ajar_awal_harus_kurang";
    exit();
}

$check_query = "SELECT * FROM tahun_ajar WHERE tahun_ajar_awal = '$tahun_ajar_awal'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "tahun_ajar_awal_sudah_ada";
    exit();
}

$check_query = "SELECT * FROM tahun_ajar WHERE tahun_ajar_akhir = '$tahun_ajar_akhir'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "tahun_ajar_akhir_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan tahun ajaran ke dalam database
$query = "INSERT INTO tahun_ajar (tahun_ajar_awal, tahun_ajar_akhir) VALUES ('$tahun_ajar_awal', '$tahun_ajar_akhir')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>