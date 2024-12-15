<?php
session_start();

// Hapus sesi id_siswa jika ada
if (isset($_SESSION['id_siswa'])) {
    unset($_SESSION['id_siswa']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../login");
exit;
