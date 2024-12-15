<?php
include '../../../koneksi.php';

// Ambil id_absensi1 dan jenjang dari parameter URL
$id_absensi1 = isset($_GET['id_absensi1']) ? $_GET['id_absensi1'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

// Tambahkan log debug
error_log("ID Absensi1: " . $id_absensi1);
error_log("Jenjang: " . $jenjang);

// Pastikan id_absensi1 tidak kosong
if (empty($id_absensi1)) {
    echo json_encode(array("error" => "ID Absensi1 tidak ditemukan"));
    exit();
}

// Query untuk mendapatkan data absensi1, kelas, dan mapel
$query = "SELECT absensi1.*, kelas.kelas AS nama_kelas, mapel.nama_mapel AS nama_mapel
          FROM absensi1
          LEFT JOIN mapel ON absensi1.id_mapel = mapel.id_mapel 
          LEFT JOIN kelas ON absensi1.id_kelas = kelas.id_kelas
          WHERE absensi1.id_absensi1 = '$id_absensi1'";

$result = mysqli_query($koneksi, $query);

// Cek jika query berhasil dieksekusi
if ($result && $row = mysqli_fetch_assoc($result)) {
    $id_kelas = $row['id_kelas'];
    $jenjang = $row['jenjang'];

    // Query untuk mendapatkan data siswa
    $query_siswa = "SELECT id_siswa, nama FROM siswa WHERE id_kelas = '$id_kelas' AND jenjang = '$jenjang'";
    $result_siswa = $koneksi->query($query_siswa);

    $siswa_data = array();
    if ($result_siswa) {
        while ($row_siswa = $result_siswa->fetch_assoc()) {
            $siswa_data[] = $row_siswa;
        }
        $result_siswa->free();
    } else {
        echo json_encode(array("error" => "Gagal mengeksekusi query siswa: " . $koneksi->error));
        exit();
    }

    // Tambahkan log debug
    error_log("Data Siswa: " . json_encode($siswa_data));

    echo json_encode($siswa_data);
} else {
    echo json_encode(array("error" => "Gagal mengeksekusi query absensi1: " . mysqli_error($koneksi)));
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
