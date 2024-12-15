<?php
include '../../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Terima data dari formulir HTML
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $isi_kegiatan = $_POST['isi_kegiatan'];
    $isi = str_replace('<br>', "\n", $isi_kegiatan);
    $foto = $_FILES['foto'];

    // Lakukan validasi data
    if (empty($tanggal) || empty($judul) || empty($isi_kegiatan) || empty($foto['name'])) {
        echo "data_tidak_lengkap";
        exit();
    }

    // Upload gambar
    $target_dir = "../../../img/gambar/";
    $target_file = $target_dir . basename($foto["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi apakah file adalah gambar
    $check = getimagesize($foto["tmp_name"]);
    if ($check === false) {
        echo "file_bukan_gambar";
        exit();
    }

    // Validasi tipe file gambar
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
    if (!in_array($imageFileType, $allowed_types)) {
        echo "tipe_file_tidak_diperbolehkan";
        exit();
    }

    // Pindahkan file yang diunggah ke direktori target
    if (!move_uploaded_file($foto["tmp_name"], $target_file)) {
        echo "gagal_upload";
        exit();
    }

    // Buat query SQL untuk menambahkan data ke dalam database
    $query = "INSERT INTO berita (tanggal, judul, isi_kegiatan, foto) 
              VALUES ('$tanggal', '$judul', '$isi', '$target_file')";

    // Jalankan query
    if (mysqli_query($koneksi, $query)) {
        echo "success";
    } else {
        echo "error";
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>