<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_guru'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman guru.php seperti biasa

// Ambil data dari URL menggunakan metode GET
$id_mapel = isset($_GET['id_mapel']) ? $_GET['id_mapel'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$type_nilai = isset($_GET['type_nilai']) ? $_GET['type_nilai'] : '';
$id_siswa = isset($_GET['id_siswa']) ? $_GET['id_siswa'] : '';
$id_tahun_ajar = isset($_GET['id_tahun_ajar']) ? $_GET['id_tahun_ajar'] : '';

// Gunakan data yang diambil sesuai kebutuhan, misalnya untuk query database atau menampilkan data
?>
<!DOCTYPE html>
<html lang="en">

<?php
include '../proses/head.php';
?>

<body class="white-content" translate="no">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper badge-info">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <img src="../../img/logo.png" width="50px" alt="" style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative" style="font-size: 14px; font-weight: bold; font-style: italic; right: 10px; color: #ffffff;">
                        SLBN KOTA KUPANG
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="./guru">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_guru">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_walikelas">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>walikelas</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_kepalah_sekolah">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Kepala Sekolah</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_siswa">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_kelas">
                            <i class="tim-icons icon-components"></i>
                            <p>Kelas</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_kebutuhan_khusus">
                            <i class="tim-icons icon-heart-2"></i>
                            <p>Kebutuhan Khusus</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_tahun_ajar">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Tahun Ajar</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_mapel">
                            <i class="tim-icons icon-book-bookmark"></i>
                            <p>Mapel</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_jadwa_kbm">
                            <i class="tim-icons icon-calendar-60"></i>
                            <p>Jadwal KBM</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_berita">
                            <i class="tim-icons icon-volume-98"></i>
                            <p>Berita</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./guru_data_nilai">
                            <i class="tim-icons icon-atom"></i>
                            <p>Nilai</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_repot">
                            <i class="tim-icons icon-chart-bar-32"></i>
                            <p>Raport siswa</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./guru_data_Repot">
                            <i class="tim-icons icon-chart-bar-32"></i>
                            <p>Raport siswa</p>
                        </a>
                    </li>
                    <br>
                    <br>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard guru</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../../koneksi.php';

                                        // Periksa apakah session id_guru telah diset
                                        if (isset($_SESSION['id_guru'])) {
                                            $id_guru = $_SESSION['id_guru'];

                                            // Query SQL untuk mengambil data guru berdasarkan id_guru dari session
                                            $query = "SELECT * FROM guru WHERE id_guru = '$id_guru'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data guru
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data guru sebagai array asosiatif
                                                    $guru = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($guru['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $guru['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $guru['id_guru']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data guru
                                                    echo "Tidak ada data guru.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data guru: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_guru tidak diset
                                            echo "Session id_guru tidak tersedia.";
                                        }

                                        // Tutup koneksi ke database
                                        mysqli_close($koneksi);
                                        ?>

                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        Log out
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a href="foto_profile" class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="GET">
                            <div class="modal-header">
                                <input type="text" name="search_query" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->

            <!-- Modal Tambah Data Tamabh -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahGuruLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahGuruLabel">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan data tambah -->
                            <form id="form_tambah" action="nilai/tambah.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="id_mapel" name="id_mapel" value="<?php echo $id_mapel; ?>">
                                <input type="hidden" id="id_siswa" name="id_siswa" value="<?php echo $id_siswa; ?>">
                                <input type="hidden" id="id_tahun_ajar" name="id_tahun_ajar" value="<?php echo $id_tahun_ajar; ?>">
                                <input type="hidden" id="semester" name="semester" value="<?php echo $semester; ?>">
                                <input type="hidden" id="type_nilai" name="type_nilai" value="<?php echo $type_nilai; ?>">

                                <div class="form-group">
                                    <label for="nama_tanggalmapeltanggal">Tanggal :</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_pengetahuan">Nilai Pengetahuan :</label>
                                    <input type="number" class="form-control" placeholder="Silakan masukan nilai pengetahuan" id="nilai_pengetahuan" name="nilai_pengetahuan" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_ketrampilan">Nilai Ketrampilan :</label>
                                    <input type="number" class="form-control" placeholder="Silakan masukan nilai ketrampilan" id="nilai_ketrampilan" name="nilai_ketrampilan" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="addEditVideoForm">Save
                                        changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="font-size: 150%;">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan atau mengedit data video -->
                            <form id="form_edit" action="nilai/edit.php" method="POST" enctype="multipart/form-data">
                                <!-- Menambahkan input tersembunyi untuk menyimpan id_video saat mengedit -->
                                <input type="hidden" id="id_mapel" name="id_mapel" value="<?php echo $id_mapel; ?>">
                                <input type="hidden" id="id_siswa" name="id_siswa" value="<?php echo $id_siswa; ?>">
                                <input type="hidden" id="id_tahun_ajar" name="id_tahun_ajar" value="<?php echo $id_tahun_ajar; ?>">
                                <input type="hidden" id="semester" name="semester" value="<?php echo $semester; ?>">
                                <input type="hidden" id="type_nilai" name="type_nilai" value="<?php echo $type_nilai; ?>">
                                <input type="hidden" id="editid_nilai" name="id_nilai">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal :</label>
                                    <input type="date" class="form-control" id="edit-tanggal" name="tanggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_pengetahuan">Nilai Pengetahuan :</label>
                                    <input type="number" class="form-control" placeholder="Silakan masukan nilai pengetahuan" id="edit-nilai_pengetahuan" name="nilai_pengetahuan" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_ketrampilan">Nilai Ketrampilan :</label>
                                    <input type="number" class="form-control" placeholder="Silakan masukan nilai ketrampilan" id="edit-nilai_ketrampilan" name="nilai_ketrampilan" required>
                                </div>
                                <script>
                                    function openEditModal(id_nilai, tanggal, np, nk) {
                                        // Isi data ke dalam form edit
                                        document.getElementById('editid_nilai').value = id_nilai;
                                        document.getElementById('edit-tanggal').value = tanggal;
                                        document.getElementById('edit-nilai_pengetahuan').value = np;
                                        document.getElementById('edit-nilai_ketrampilan').value = nk;
                                        $('#editModal').modal('show');
                                    }
                                </script>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="addEditVideoForm">Save
                                        changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Lakukan koneksi ke database
            include '../../koneksi.php';

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
            <div class="content">
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
                                                    <a href="detail_nilai.php?id_mapel=<?php echo $id_mapel; ?>&id_kelas=<?php echo $id_kelas; ?>&jenjang=<?php echo $jenjang; ?>&semester=<?php echo $semester; ?>&type_nilai=<?php echo $type_nilai; ?>&id_siswa=<?php echo $id_siswa; ?>&id_tahun_ajar=<?php echo $id_tahun_ajar; ?>" class=" btn btn-secondary btn-block">Kembali</a>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
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
                                                <input type="text" id="mapel" class="form-control" value="<?php echo $mapel_data[array_search($id_mapel, array_column($mapel_data, 'id_mapel'))]['nama_mapel']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Input untuk kelas -->
                                            <div class="select-custom">
                                                <label for="kelas">Kelas:</label>
                                                <input type="text" id="kelas" class="form-control" value="<?php echo $kelas_data[array_search($id_kelas, array_column($kelas_data, 'id_kelas'))]['kelas']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Input untuk jenjang -->
                                            <div class="select-custom">
                                                <label for="jenjang">Jenjang:</label>
                                                <input type="text" id="jenjang" class="form-control" value="<?php echo $jenjang; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Input untuk semester -->
                                            <div class="select-custom">
                                                <label for="semester">Semester:</label>
                                                <input type="text" id="semester" class="form-control" value="<?php echo $semester; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center mt-4">
                                            <!-- Input untuk siswa -->
                                            <div class="select-custom">
                                                <label for="siswa">Siswa:</label>
                                                <input type="text" id="siswa" class="form-control" value="<?php echo $siswa_data[array_search($id_siswa, array_column($siswa_data, 'id_siswa'))]['nama']; ?>" disabled>
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
                                    <table class="table tablesorter" id="dataTable">
                                        <thead class="text-primary">
                                            <tr>
                                                <th class="text-center" style="white-space: nowrap;">Nomor</th>
                                                <th class="text-center" style="white-space: nowrap;">Tanggal
                                                </th>
                                                <th class="text-center" style="white-space: nowrap;">Nilai Pengetahuan
                                                </th>
                                                <th class="text-center" style="white-space: nowrap;">Nilai Ketrampilan
                                                </th>
                                                <th class="text-center" style="white-space: nowrap;">Edit
                                                </th>
                                                <th class="text-center" style="white-space: nowrap;">Hapus
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
                                                    echo "<td class='text-center'>
        <button class='btn btn-primary btn-sm' onclick='openEditModal(
            \"" . $row['id_nilai'] . "\",
            \"" . $row['tanggal'] . "\",
            \"" . $row['nilai_pengetahuan'] . "\",
            \"" . $row['nilai_ketrampilan'] . "\"
        )'>Edit</button>
           </td>";
                                                    echo "<td class='text-center'>
           <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_nilai'] . "\")'>Hapus</button>
       </td>";
                                                    echo "</tr>";

                                                    // Increment nomor urut
                                                    $counter++;
                                                }
                                            } else {
                                                // Tampilkan pesan jika tidak ada data yang ditemukan
                                                echo "<tr><td colspan='5' class='text-center'><h3>Data Nilai Belum Ada</h3></td></tr>";
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

            <style>
                .button-like {
                    display: inline-block;
                    padding: 7px 20px;
                    background-color: #007bff;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    cursor: default;
                    color: #fff;
                }
            </style>
            <footer class="footer">
                <div class="container-fluid">
                    <ul class="nav">

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                About Us
                            </a>
                        </li>

                    </ul>
                    <div class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Dibuat Oleh Ronal
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--=============== LOADING ===============-->
    <div class="loading">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const loding = document.querySelector('.loading');

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_tambah').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'nilai/tambah.php', true);
                xhr.onload = function() {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#modalTambah').modal('hide');
                            swal({
                                title: "Berhasil!",
                                text: "Data berhasil ditambahkan",
                                icon: "success"
                            }).then((value) => {
                                if (value) {
                                    // Refresh halaman setelah berhasil
                                    window.location.reload();
                                }
                            });
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (response === 'tahun_ajaran_tidak_ditemukan') {
                            swal("Username Salah!",
                                "Data ajaran sekarang belum ditambahkan kedalam data tahun ajaran",
                                "error");
                        } else {
                            swal("Error", "Gagal menambahkan data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        // logika untuk mengedit data info
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_edit').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'nilai/edit.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#editModal').modal('hide');
                            swal({
                                title: "Suksess!",
                                text: "Data berhasil diedit",
                                icon: "success"
                            }).then((value) => {
                                if (value) {

                                    // Reload halaman
                                    window.location.reload();
                                }
                            });
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap",
                                "error");
                        } else if (response === 'tahun_ajaran_tidak_ditemukan') {
                            swal("Username Salah!",
                                "Data ajaran sekarang belum ditambahkan kedalam data tahun ajaran",
                                "error");
                        } else {
                            swal("Error", "Gagal mengedit data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        // logika untuk menghapus data video
        function hapus(id) {
            swal({
                    title: "Apakah Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: ["Batal", "Ya, hapus!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika pengguna mengonfirmasi untuk menghapus
                        var xhr = new XMLHttpRequest();

                        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                        var loading = document.getElementById('loading');
                        if (loading) {
                            loading.style.display = 'flex';
                        }

                        xhr.open('POST', 'nilai/hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            if (loading) {
                                loading.style.display = 'none';
                            }

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Sukses!", "Data info berhasil dihapus.", "success")
                                        .then(() => {
                                            // Reload halaman
                                            window.location.reload();
                                        });
                                } else {
                                    swal("Error", "Gagal menghapus data info.", "error");
                                }
                            } else {
                                swal("Error", "Terjadi kesalahan saat mengirim data.", "error");
                            }
                        };
                        xhr.send("id=" + id);
                    } else {
                        // Jika pengguna membatalkan penghapusan
                        swal("Penghapusan dibatalkan", {
                            icon: "info",
                        });
                    }
                });
        }


        function loadTable() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('dataTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET',
                'nilai/load_table.php?id_mapel=<?php echo $id_mapel; ?>&id_kelas=<?php echo $id_kelas; ?>&jenjang=<?php echo $jenjang; ?>&semester=<?php echo $semester; ?>&type_nilai=<?php echo $type_nilai; ?>',
                true);
            xhrTable.send();
        }
    </script>

    <!--   Core JS Files   -->
    <script src="../../assets/js/core/jquery.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="../../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');
                $navbar = $('.navbar');
                $main_panel = $('.main-panel');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;
                white_color = false;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



                $('.fixed-plugin a').click(function(event) {
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data', new_color);
                    }

                    if ($main_panel.length != 0) {
                        $main_panel.attr('data', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data', new_color);
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        blackDashboard.showSidebarMessage('Sidebar mini activated...');
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });

                $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (white_color == true) {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').removeClass('white-content');
                        }, 900);
                        white_color = false;
                    } else {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').addClass('white-content');
                        }, 900);

                        white_color = true;
                    }


                });

                $('.light-badge').click(function() {
                    $('body').addClass('white-content');
                });

                $('.dark-badge').click(function() {
                    $('body').removeClass('white-content');
                });
            });
        });
    </script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "black-dashboard-free"
            });
    </script>
</body>

</html>