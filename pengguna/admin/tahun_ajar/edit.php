<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_tahun_ajar = $_POST['id_tahun_ajar'];
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

$check_query_awal = "SELECT * FROM tahun_ajar WHERE tahun_ajar_awal = '$tahun_ajar_awal' AND id_tahun_ajar != '$id_tahun_ajar'";
$check_result_awal = mysqli_query($koneksi, $check_query_awal);

if (mysqli_num_rows($check_result_awal) > 0) {
    echo "tahun_ajar_awal_sudah_ada";
    exit();
}

$check_query_akhir = "SELECT * FROM tahun_ajar WHERE tahun_ajar_akhir = '$tahun_ajar_akhir' AND id_tahun_ajar != '$id_tahun_ajar'";
$check_result_akhir = mysqli_query($koneksi, $check_query_akhir);

if (mysqli_num_rows($check_result_akhir) > 0) {
    echo "tahun_ajar_akhir_sudah_ada";
    exit();
}

// Buat query SQL untuk memperbarui data tahun ajaran
$query = "UPDATE tahun_ajar SET tahun_ajar_awal = '$tahun_ajar_awal', tahun_ajar_akhir = '$tahun_ajar_akhir' WHERE id_tahun_ajar = '$id_tahun_ajar'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>