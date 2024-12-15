<?php
session_start();

// Hapus sesi id_guru jika ada
if (isset($_SESSION['id_guru'])) {
    unset($_SESSION['id_guru']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../login");
exit;