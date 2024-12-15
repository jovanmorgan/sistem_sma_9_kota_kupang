<?php
// Lakukan koneksi ke database
include '../../../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $id_siswa = $_POST['id_siswa'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
    if (empty($nama) || empty($username) || empty($password)) {
        echo "data tidak lengkap";
        exit();
    }
    // Cek apakah username sudah ada di database
    $check_query = "SELECT * FROM guru WHERE username = '$username'";
    $result = mysqli_query($koneksi, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "username_sudah_ada"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }

    // Cek apakah username sudah ada di database
    $check_query_siswa = "SELECT * FROM siswa WHERE username = '$username' AND id_siswa != '$id_siswa'";
    $result_siswa = mysqli_query($koneksi, $check_query_siswa);
    if (mysqli_num_rows($result_siswa) > 0) {
        echo "username_sudah_ada"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }
  // Cek apakah username sudah ada di database
  $check_query_admin = "SELECT * FROM admin WHERE username = '$username'";
  $result_admin = mysqli_query($koneksi, $check_query_admin);
  if (mysqli_num_rows($result_admin) > 0) {
      echo "username_sudah_ada"; // Kirim respon "error_email_exists" jika email sudah terdaftar
      exit();
  }
    // Cek apakah username sudah ada di database
    $check_query_wali_kelas = "SELECT * FROM wali_kelas WHERE username = '$username'";
    $result_wali_kelas = mysqli_query($koneksi, $check_query_wali_kelas);
    if (mysqli_num_rows($result_wali_kelas) > 0) {
        echo "username_sudah_ada"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }
    // Query SQL untuk update data foto profile
    $query = "UPDATE siswa SET username='$username', password='$password', nama='$nama' WHERE id_siswa='$id_siswa'";

    // Lakukan proses update data foto profile di database
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses update data foto profile: " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, berikan respons yang sesuai
    echo "Invalid request method";
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);