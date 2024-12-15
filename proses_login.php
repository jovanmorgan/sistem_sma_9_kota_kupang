<?php
include 'koneksi.php';


function checkUserType($username)
{
    global $koneksi;
    $query_admin = "SELECT * FROM admin WHERE username = '$username'";
    $query_guru = "SELECT * FROM guru WHERE username = '$username'";
    $query_wali_kelas = "SELECT * FROM wali_kelas WHERE username = '$username'";
    $query_siswa = "SELECT * FROM siswa WHERE username = '$username'";
    $query_kepalah_sekolah = "SELECT * FROM kepalah_sekolah WHERE username = '$username'";

    $result_admin = mysqli_query($koneksi, $query_admin);
    $result_guru = mysqli_query($koneksi, $query_guru);
    $result_wali_kelas = mysqli_query($koneksi, $query_wali_kelas);
    $result_siswa = mysqli_query($koneksi, $query_siswa);
    $result_kepalah_sekolah = mysqli_query($koneksi, $query_kepalah_sekolah);

    if (mysqli_num_rows($result_admin) > 0) {
        return "admin";
    } elseif (mysqli_num_rows($result_guru) > 0) {
        return "guru";
    } elseif (mysqli_num_rows($result_wali_kelas) > 0) {
        return "wali_kelas";
    } elseif (mysqli_num_rows($result_siswa) > 0) {
        return "siswa";
    } elseif (mysqli_num_rows($result_kepalah_sekolah) > 0) {
        return "kepalah_sekolah";
    } else {
        return "not_found";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
if (empty($username) && empty($password)) {
    echo "tidak_ada_data";
    exit();
} 
if (empty($username)) {
    echo "username_tidak_ada";
    exit();
} 

if (empty($password)) {
    echo "password_tidak_ada";
    exit();
} 


    $userType = checkUserType($username);
    if ($userType !== "not_found") {
        $query_user = "SELECT * FROM $userType WHERE username = '$username'";
        $result_user = mysqli_query($koneksi, $query_user);

        if (mysqli_num_rows($result_user) > 0) {
            $row = mysqli_fetch_assoc($result_user);
            $hashed_password = $row['password'];

            if ($password === $hashed_password) {

                // Process login for other user types
                session_start();
                $_SESSION['username'] = $username;

                switch ($userType) {
                    case "admin":
                        $_SESSION['id_admin'] = $row['id_admin'];
                        break;
                    case "guru":
                        $_SESSION['id_guru'] = $row['id_guru'];
                        $id_guru = $row['id_guru'];
                        break;
                    case "wali_kelas":
                        $_SESSION['id_wali_kelas'] = $row['id_wali_kelas'];
                        break;
                    case "siswa":
                        $_SESSION['id_siswa'] = $row['id_siswa'];
                        break;
                    case "kepalah_sekolah":
                        $_SESSION['id_kepalah_sekolah'] = $row['id_kepalah_sekolah'];
                        break;
                    default:
                        break;
                }

                // Success response
                switch ($userType) {
                    case "admin":
                        echo "success:" . $username . ":" . $userType . ":" . "pengguna/admin/admin";
                        break;
                    case "guru":
                        echo "success:" . $username . ":" . $userType . ":" . "pengguna/guru/guru";
                        break;
                    case "wali_kelas":
                        echo "success:" . $username . ":" . $userType . ":" . "pengguna/wali_kelas/wali_kelas";
                        break;
                    case "siswa":
                        echo "success:" . $username . ":" . $userType . ":" . "pengguna/siswa/siswa";
                        break;
                    case "kepalah_sekolah":
                        echo "success:" . $username . ":" . $userType . ":" . "pengguna/kepalah_sekolah/kepalah_sekolah";
                        break;
                    default:
                        echo "success:" . $username . ":" . $userType . ":" . "login";
                        break;
                }
            } else {
                echo "error_password";
            }
        } else {
            echo "error_username";
        }
    } else {
        echo "error_username";
    }
}