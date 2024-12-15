<?php

session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa

// Ambil data dari URL menggunakan metode GET
$id_mapel = isset($_GET['id_mapel']) ? $_GET['id_mapel'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$type_nilai = isset($_GET['type_nilai']) ? $_GET['type_nilai'] : '';
$id_siswa = isset($_GET['id_siswa']) ? $_GET['id_siswa'] : '';

// Lakukan koneksi ke database
include '../../../koneksi.php';

// Query SQL untuk mengambil data dari tabel mapel
$query_mapel = "SELECT * FROM mapel";
$result_mapel = mysqli_query($koneksi, $query_mapel);

if ($result_mapel) {
    $mapel_data = mysqli_fetch_all($result_mapel, MYSQLI_ASSOC);
} else {
    echo "Gagal mengambil data dari database";
    $mapel_data = [];
}

// Query SQL untuk mengambil data dari tabel kelas
$query_kelas = "SELECT * FROM kelas";
$result_kelas = mysqli_query($koneksi, $query_kelas);

if ($result_kelas) {
    $kelas_data = mysqli_fetch_all($result_kelas, MYSQLI_ASSOC);
} else {
    echo "Gagal mengambil data kelas dari database";
    $kelas_data = [];
}

// Query SQL untuk mengambil data dari tabel siswa
$query_siswa = "SELECT * FROM siswa";
$result_siswa = mysqli_query($koneksi, $query_siswa);

if ($result_siswa) {
    $siswa_data = mysqli_fetch_all($result_siswa, MYSQLI_ASSOC);
} else {
    echo "Gagal mengambil data siswa dari database";
    $siswa_data = [];
}

// Query SQL untuk menampilkan data siswa berdasarkan kelas dan jenjang yang dipilih
$query = "SELECT * FROM nilai";

// Jika sudah ada pilihan kelas dan jenjang, tambahkan filter WHERE
if (!empty($id_kelas) && !empty($jenjang)) {
    $query .= " WHERE id_siswa = '$id_siswa' AND semester = '$semester' AND type_nilai = '$type_nilai' AND id_mapel = '$id_mapel'";
}

// Ambil kata kunci pencarian dari URL jika ada
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan
if (!empty($search_query)) {
    $query .= " AND (tanggal LIKE '%$search_query%' OR nilai_pengetahuan LIKE '%$search_query%' OR nilai_ketrampilan LIKE '%$search_query%')";
}

// Balik urutan data untuk memunculkan yang paling baru di atas
$query .= " ORDER BY id_nilai DESC";

$result = mysqli_query($koneksi, $query);

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
<div class="content" id="dataTable">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="places-buttons">
                        <div class="row mt-3">
                            <div class="col-md-6 ml-auto mr-auto text-center">
                                <h2 class="card-title">
                                    Tambah Data <?php echo $type_nilai; ?>
                                </h2>
                                <p class="category">Klik untuk menambah data</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 ml-auto mr-auto">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-block" data-toggle="modal"
                                            data-target="#modalTambah">Tambah
                                            Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-3 ml-auto mr-auto text-center">
                                <!-- Input untuk mapel -->
                                <div class="select-custom">
                                    <label for="mapel">Mapel:</label>
                                    <input type="text" id="mapel" class="form-control"
                                        value="<?php echo $mapel_data[array_search($id_mapel, array_column($mapel_data, 'id_mapel'))]['nama_mapel']; ?>"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto mr-auto text-center">
                                <!-- Input untuk kelas -->
                                <div class="select-custom">
                                    <label for="kelas">Kelas:</label>
                                    <input type="text" id="kelas" class="form-control"
                                        value="<?php echo $kelas_data[array_search($id_kelas, array_column($kelas_data, 'id_kelas'))]['kelas']; ?>"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto mr-auto text-center">
                                <!-- Input untuk jenjang -->
                                <div class="select-custom">
                                    <label for="jenjang">Jenjang:</label>
                                    <input type="text" id="jenjang" class="form-control" value="<?php echo $jenjang; ?>"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto mr-auto text-center">
                                <!-- Input untuk semester -->
                                <div class="select-custom">
                                    <label for="semester">Semester:</label>
                                    <input type="text" id="semester" class="form-control"
                                        value="<?php echo $semester; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto mr-auto text-center mt-4">
                                <!-- Input untuk siswa -->
                                <div class="select-custom">
                                    <label for="siswa">Siswa:</label>
                                    <input type="text" id="siswa" class="form-control"
                                        value="<?php echo $siswa_data[array_search($id_siswa, array_column($siswa_data, 'id_siswa'))]['nama']; ?>"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center" style="white-space: nowrap;">Nomor</th>
                                    <th class="text-center" style="white-space: nowrap;">Tanggal
                                    </th>
                                    <th class="text-center" style="white-space: nowrap;">Pengetahuan
                                    </th>
                                    <th class="text-center" style="white-space: nowrap;">Ketrampilan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Cek jika query berhasil dieksekusi dan ada data yang ditemukan
                                if ($result && mysqli_num_rows($result) > 0) {
                                    // Variabel untuk menyimpan nomor urut
                                    $counter = 1;

                                    // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Menampilkan data ke dalam tabel HTML
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $counter . "</td>";
                                        echo "<td class='text-center'>" . $row['tanggal'] . "</td>";
                                        echo "<td class='text-center'>" . $row['nilai_pengetahuan'] . "</td>";
                                        echo "<td class='text-center'>" . $row['nilai_ketrampilan'] . "</td>";
                                        echo "</tr>";

                                        // Increment nomor urut
                                        $counter++;
                                    }
                                } else {
                                    // Tampilkan pesan jika tidak ada data yang ditemukan
                                    echo "<tr><td colspan='4' class='text-center'><h3>Data Nilai Belum Ada</h3></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>