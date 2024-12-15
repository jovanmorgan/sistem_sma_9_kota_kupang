<?php
include '../../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Terima data dari formulir HTML
    $id_berita = $_POST['id_berita'];
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $isi_kegiatan = $_POST['isi_kegiatan'];
    $isi = str_replace('<br>', "\n", $isi_kegiatan);
    $foto = $_FILES['foto'];

    // Lakukan validasi data
    if (empty($tanggal) || empty($judul) || empty($isi_kegiatan)) {
        echo "data_tidak_lengkap";
        exit();
    }

    // Inisialisasi variabel untuk menyimpan path foto
    $target_file = "";

    // Proses upload gambar jika ada gambar yang diunggah
    if (!empty($foto['name'])) {
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
    }

    // Buat query SQL untuk mengupdate data ke dalam database
    if (!empty($target_file)) {
        $query = "UPDATE berita SET tanggal='$tanggal', judul='$judul', isi_kegiatan='$isi', foto='$target_file' WHERE id_berita='$id_berita'";
    } else {
        $query = "UPDATE berita SET tanggal='$tanggal', judul='$judul', isi_kegiatan='$isi' WHERE id_berita='$id_berita'";
    }

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