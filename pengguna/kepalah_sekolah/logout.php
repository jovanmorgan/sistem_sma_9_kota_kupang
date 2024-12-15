<?php
session_start();

// Hapus sesi id_kepalah_sekolah jika ada
if (isset($_SESSION['id_kepalah_sekolah'])) {
    unset($_SESSION['id_kepalah_sekolah']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../login");
exit;