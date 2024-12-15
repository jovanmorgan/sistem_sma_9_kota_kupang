<?php
include '../../../koneksi.php';

// Terima data dari formulir HTML
$id_absensi2 = $_POST['id_absensi2'];
$id_absensi1 = $_POST['id_absensi1'];
$id_guru = $_POST['id_guru'];
$jam_mengajar = $_POST['jam_mengajar'];
$jam_pulang = $_POST['jam_pulang'];
$status_kehadiran = $_POST['status_kehadiran'];

// Lakukan validasi data
if (empty($id_absensi1) || empty($id_guru) || empty($jam_mengajar) || empty($jam_pulang) || empty($status_kehadiran)) {
    echo "data_tidak_lengkap";
    exit();
}

// Siapkan array untuk menyimpan data kehadiran
$hadir = [];
$sakit = [];
$ijin = [];
$alpa = [];

// Pisahkan data ke dalam array yang sesuai
foreach ($status_kehadiran as $id_siswa => $status) {
    switch ($status) {
        case 'hadir':
            $hadir[] = $id_siswa;
            break;
        case 'sakit':
            $sakit[] = $id_siswa;
            break;
        case 'ijin':
            $ijin[] = $id_siswa;
            break;
        case 'alpa':
            $alpa[] = $id_siswa;
            break;
    }
}

// Serialisasikan data array untuk disimpan ke database
$hadir = implode(',', $hadir);
$sakit = implode(',', $sakit);
$ijin = implode(',', $ijin);
$alpa = implode(',', $alpa);

// Buat variabel tanggal untuk menyimpan tanggal sekarang dalam format "tanggal-bulan-tahun"
$tanggal_sekarang = date('d-m-Y');

// Buat query SQL untuk mengupdate data guru ke dalam database
$query = "UPDATE absensi2 SET 
          id_absensi1 = '$id_absensi1', 
          id_guru = '$id_guru', 
          jam_mengajar = '$jam_mengajar', 
          jam_pulang = '$jam_pulang', 
          hadir = '$hadir', 
          sakit = '$sakit', 
          ijin = '$ijin', 
          tanggal = '$tanggal_sekarang', 
          alpa = '$alpa'
          WHERE id_absensi2 = '$id_absensi2'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>