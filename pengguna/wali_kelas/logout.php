<?php
session_start();

// Hapus sesi id_wali_kelas jika ada
if (isset($_SESSION['id_wali_kelas'])) {
    unset($_SESSION['id_wali_kelas']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../login");
exit;
