<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_wali_kelas'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa

$id_mapel = isset($_GET['id_mapel']) ? $_GET['id_mapel'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$type_nilai = isset($_GET['type_nilai']) ? $_GET['type_nilai'] : '';
$id_siswa = isset($_GET['id_siswa']) ? $_GET['id_siswa'] : '';
$id_tahun_ajar = isset($_GET['id_tahun_ajar']) ? $_GET['id_tahun_ajar'] : '';

// Koneksi ke database
include '../../../koneksi.php';

// Query SQL untuk mengambil data dari tabel siswa
$query_siswa = "SELECT * FROM siswa";
$result_siswa = mysqli_query($koneksi, $query_siswa);

if ($result_siswa) {
    $siswa_data = mysqli_fetch_all($result_siswa, MYSQLI_ASSOC);
} else {
    echo "Gagal mengambil data siswa dari database";
    $siswa_data = [];
}

// Query SQL untuk mengambil data dari tabel tahun_ajar
$query_tahun_ajar = "SELECT * FROM tahun_ajar";
$result_tahun_ajar = mysqli_query($koneksi, $query_tahun_ajar);

if ($result_tahun_ajar) {
    $tahun_ajar_data = mysqli_fetch_all($result_tahun_ajar, MYSQLI_ASSOC);
} else {
    echo "Gagal mengambil data dari database";
    $tahun_ajar_data = [];
}

// Query SQL untuk menampilkan data kepribadian berdasarkan kelas dan jenjang yang dipilih
$query = "SELECT * FROM kepribadian";

if (!empty($id_siswa) && !empty($id_tahun_ajar) && !empty($semester)) {
    $query .= " WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar' AND semester = '$semester'";
}

$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

if (!empty($search_query)) {
    $query .= " AND (kerajinan LIKE '%$search_query%' OR kerapian LIKE '%$search_query%' OR keterampilan LIKE '%$search_query%')";
}

$query .= " ORDER BY id_kepribadian DESC";
$result = mysqli_query($koneksi, $query);

?>

<table class="table tablesorter " id="dataTable">
    <thead class="text-primary">
        <tr>
            <th class="text-center" style="white-space: nowrap;">Nomor</th>
            <th class="text-center" style="white-space: nowrap;">Kerajinan</th>
            <th class="text-center" style="white-space: nowrap;">Kerapian</th>
            <th class="text-center" style="white-space: nowrap;">Ketrampilan</th>
            <th class="text-center" style="white-space: nowrap;">Edit</th>
            <th class="text-center" style="white-space: nowrap;">Hapus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='text-center'>" . $counter . "</td>";
                echo "<td class='text-center'>" . $row['kerajinan'] . "</td>";
                echo "<td class='text-center'>" . $row['kerapian'] . "</td>";
                echo "<td class='text-center'>" . $row['keterampilan'] . "</td>";
                echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_kepribadian'] . "\",
                                                        \"" . $row['kerajinan'] . "\",
                                                        \"" . $row['kerapian'] . "\",
                                                        \"" . $row['keterampilan'] . "\"
                                                    )'>Edit</button>
                                                    </td>";
                echo "<td class='text-center'>
                                                <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_kepribadian'] . "\")'>Hapus</button>
                                            </td>";
                echo "</tr>";

                $counter++;
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'><h3>Tidak ada data kepribadian yang sesuai dengan kriteria</h3></td></tr>";
        }
        ?>

    </tbody>
</table>