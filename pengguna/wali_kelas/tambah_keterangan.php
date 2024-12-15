<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_wali_kelas'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman guru.php seperti biasa

$id_mapel = isset($_GET['id_mapel']) ? $_GET['id_mapel'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$type_nilai = isset($_GET['type_nilai']) ? $_GET['type_nilai'] : '';
$id_siswa = isset($_GET['id_siswa']) ? $_GET['id_siswa'] : '';
$id_tahun_ajar = isset($_GET['id_tahun_ajar']) ? $_GET['id_tahun_ajar'] : '';

// Gunakan data yang diambil sesuai kebutuhan, misalnya untuk query database atau menampilkan data b
?>
<!DOCTYPE html>
<html lang="en">

<?php
include '../proses/head.php';
?>

<body translate="no" class="white-content">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper badge-info">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <img src="../../img/logo.png" width="50px" alt="" style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative"
                        style="font-size: 14px; font-weight: bold; font-style: italic; right: 10px; color: #ffffff;">
                        SLBN KOTA KUPANG
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="./wali_kelas">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./wali_kelas_data_siswa">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa</p>
                        </a>
                    </li>
                    <li>
                        <a href="./wali_kelas_data_absensi">
                            <i class="tim-icons icon-calendar-60"></i>
                            <p>Absensi</p>
                        </a>
                    </li>
                    <li>
                        <a href="./wali_kelas_data_repot">
                            <i class="tim-icons icon-chart-bar-32"></i>
                            <p>Raport siswa</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./wali_kelas_data_keterangan">
                            <i class="fa fa-info-circle"></i>
                            <p>Keterangan</p>
                        </a>
                    </li>
                    <li>
                        <a href="./wali_kelas_data_kepribadian">
                            <i class="fa fa-user-circle"></i>
                            <p>Kepribadian</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./wali_kelas_data_Repot">
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard Admin</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal"
                                    data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../../koneksi.php';

                                        // Periksa apakah session id_wali_kelas telah diset
                                        if (isset($_SESSION['id_wali_kelas'])) {
                                            $id_wali_kelas = $_SESSION['id_wali_kelas'];

                                            // Query SQL untuk mengambil data guru berdasarkan id_wali_kelas dari session
                                            $query = "SELECT * FROM wali_kelas WHERE id_wali_kelas = '$id_wali_kelas'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data wali_kelas
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data wali_kelas sebagai array asosiatif
                                                    $guru = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($wali_kelas['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $guru['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $guru['id_wali_kelas']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data guru
                                                    echo "Tidak ada data wali kelas.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data wali_kelas: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_wali_kelas tidak diset
                                            echo "Session id_wali_kelas tidak tersedia.";
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
                                    <li class="nav-link"><a href="foto_profile"
                                            class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog"
                aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="GET">
                            <div class="modal-header">
                                <input type="text" name="search_query" class="form-control" id="inlineFormInputGroup"
                                    placeholder="SEARCH">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Data Tamabh -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahGuruLabel"
                aria-hidden="true">
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
                            <form id="form_tambah" action="kepribadian/tambah.php" method="POST"
                                enctype="multipart/form-data">
                                <input type="hidden" id="id_siswa" name="id_siswa" value="<?php echo $id_siswa; ?>">
                                <input type="hidden" id="id_tahun_ajar" name="id_tahun_ajar"
                                    value="<?php echo $id_tahun_ajar; ?>">
                                <input type="hidden" id="semester" name="semester" value="<?php echo $semester; ?>">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan:</label>
                                    <textarea class="form-control" id="keterangan-tambah" name="keterangan"
                                        required></textarea>
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
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
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
                            <form id="form_edit" action="kepribadian/edit.php" method="POST"
                                enctype="multipart/form-data">
                                <!-- Menambahkan input tersembunyi untuk menyimpan id_video saat mengedit -->
                                <input type="hidden" id="id_keterangan-edit" name="id_keterangan">
                                <input type="hidden" id="id_siswa" name="id_siswa" value="<?php echo $id_siswa; ?>">
                                <input type="hidden" id="id_tahun_ajar" name="id_tahun_ajar"
                                    value="<?php echo $id_tahun_ajar; ?>">
                                <input type="hidden" id="semester" name="semester" value="<?php echo $semester; ?>">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan:</label>
                                    <textarea class="form-control" id="keterangan-edit" name="keterangan"
                                        required></textarea>
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
            <script>
                function openEditModal(id_keterangan, keterangan) {
                    // Isi data ke dalam form edit
                    document.getElementById('id_keterangan-edit').value = id_keterangan;
                    document.getElementById('keterangan-edit').value = keterangan;
                    $('#editModal').modal('show');
                }
            </script>
            <!-- End Navbar -->
            <?php
            // Koneksi ke database
            include '../../koneksi.php';

            // Query SQL untuk mengambil data dari tabel siswa
            $query_siswa = "SELECT * FROM siswa";
            $result_siswa = mysqli_query($koneksi, $query_siswa);

            if ($result_siswa) {
                $siswa_data = mysqli_fetch_all($result_siswa, MYSQLI_ASSOC);
            } else {
                echo "Gagal mengambil data siswa dari database";
                $siswa_data = [];
            }

            // Query untuk mengambil data tahun ajar berdasarkan id_tahun_ajar
            $query_tahun_ajar = "SELECT * FROM tahun_ajar WHERE id_tahun_ajar = '$id_tahun_ajar'";
            $result_tahun_ajar = mysqli_query($koneksi, $query_tahun_ajar);

            if ($result_tahun_ajar) {
                $tahun_ajar_data = mysqli_fetch_assoc($result_tahun_ajar);

                // Gabungkan tahun_ajar_awal dan tahun_ajar_akhir menjadi satu string
                $tahun_ajar = $tahun_ajar_data['tahun_ajar_awal'] . '/' . $tahun_ajar_data['tahun_ajar_akhir'];
            } else {
                echo "Gagal mengambil data tahun ajar dari database";
                $tahun_ajar_data = [];
                $tahun_ajar = ''; // Jika tidak ada data tahun ajar, atur nilai kosong
            }

            // Query SQL untuk menampilkan data keterangan berdasarkan kelas dan jenjang yang dipilih
            $query = "SELECT * FROM keterangan";

            if (!empty($id_siswa) && !empty($id_tahun_ajar) && !empty($semester)) {
                $query .= " WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar' AND semester = '$semester'";
            }

            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

            if (!empty($search_query)) {
                $query .= " AND (kerajinan LIKE '%$search_query%' OR kerapian LIKE '%$search_query%' OR keterampilan LIKE '%$search_query%')";
            }

            $query .= " ORDER BY id_keterangan DESC";
            $result = mysqli_query($koneksi, $query);

            ?>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row mb-3">
                                        <div class="col-md-12 ml-auto mr-auto text-center mt-3">
                                            <h2 class="card-title-custom">Data Keterangan
                                            </h2>
                                            <p class="category">Klik untuk menambah data atau kembali</p>
                                            <div class="col-lg-8 ml-auto mr-auto">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-md-4">
                                                        <a href="wali_kelas_data_keterangan.php?id_kelas=<?php echo $id_kelas; ?>&jenjang=<?php echo $jenjang; ?>&semester=<?php echo $semester; ?>&id_siswa=<?php echo $id_siswa; ?>&id_tahun_ajar=<?php echo $id_tahun_ajar; ?>"
                                                            class=" btn btn-secondary btn-block">Kembali</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="btn btn-primary btn-block" data-toggle="modal"
                                                            data-target="#modalTambah">Tambah Data</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Input untuk siswa -->
                                            <div class="select-custom">
                                                <label for="siswa">Siswa:</label>
                                                <input type="text" id="siswa" class="form-control"
                                                    value="<?php echo $siswa_data[array_search($id_siswa, array_column($siswa_data, 'id_siswa'))]['nama']; ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Input untuk tahun ajar -->
                                            <div class="select-custom">
                                                <label for="tahun_ajar">Tahun Ajar:</label>
                                                <input type="text" id="tahun_ajar" class="form-control"
                                                    value="<?php echo $tahun_ajar; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk semester -->
                                            <div class="select-custom">
                                                <label for="semester">Semester:</label>
                                                <select id="data_semester" class="form-control">
                                                    <option value="" disabled selected>Pilih Semester</option>
                                                    <option value="Ganjil" <?php if ($semester == 'Ganjil')
                                                                                echo 'selected'; ?>>Ganjil
                                                    </option>
                                                    <option value="Genap" <?php if ($semester == 'Genap')
                                                                                echo 'selected'; ?>>Genap
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('data_semester').addEventListener('change', function() {
                                                reloadPageWithSelection();
                                            });

                                            function reloadPageWithSelection() {
                                                var semester = document.getElementById('data_semester').value;
                                                var id_tahun_ajar = document.getElementById('tahun_ajar')
                                                    .value; // Ambil tambah_keterangan tahun ajaran yang dipilih

                                                // Ambil id_siswa dari URL
                                                var urlParams = new URLSearchParams(window.location.search);
                                                var id_siswa = urlParams.get('id_siswa');

                                                // Ubah URL saat melakukan reload halaman dengan memasukkan id_tahun_ajar, semester, dan id_siswa
                                                window.location.href =
                                                    `tambah_keterangan.php?id_mapel=<?php echo $id_mapel; ?>&id_kelas=<?php echo $id_kelas; ?>&jenjang=<?php echo $jenjang; ?>&semester=${semester}&type_nilai=<?php echo $type_nilai; ?>&id_tahun_ajar=<?php echo $id_tahun_ajar; ?>&id_siswa=${id_siswa}`;
                                            }
                                        </script>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="dataTable">
                                        <thead class="text-primary">
                                            <tr>
                                                <th class="text-center" style="white-space: nowrap;">Nomor</th>
                                                <th class="text-center" style="white-space: nowrap;">Keterangan</th>
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
                                                    echo "<td class='text-center'>" . $row['keterangan'] . "</td>";
                                                    echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_keterangan'] . "\",
                                                        \"" . $row['keterangan'] . "\"
                                                    )'>Edit</button>
                                                    </td>";
                                                    echo "<td class='text-center'>
                                                <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_keterangan'] . "\")'>Hapus</button>
                                            </td>";
                                                    echo "</tr>";

                                                    $counter++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'><h3>Tidak ada data keterangan yang sesuai dengan kriteria</h3></td></tr>";
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

            <?php
            // Tutup koneksi ke database
            mysqli_close($koneksi);
            ?>
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
                xhr.open('POST', 'keterangan/tambah.php', true);
                xhr.onload = function() {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Berhasil!", "Data berhasil ditambahkan", "success");
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#modalTambah').modal('hide');
                            // Muat ulang tabel
                            loadTable();
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_sudah_ada') {
                            swal("Maxsimal 1 Data",
                                "Data untuk siswa ini pada semester dan tahun ajaran tersebut sudah ada",
                                "info");
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
                xhr.open('POST', 'keterangan/edit.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data berhasil diedit", "success");
                            loadTable();
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#editModal').modal('hide');
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap",
                                "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!",
                                "Data username sudah digunakan silakan gunakan username lain",
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
                        loding.style.display = 'flex';

                        xhr.open('POST', 'keterangan/hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            loding.style.display = 'none';

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Suksess!", "Data berhasil diedit", "success");
                                    loadTable();
                                    // Reset form setelah berhasil
                                    form.reset();
                                    // Tutup modal setelah berhasil
                                    $('#editModal').modal('hide');
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
                'keterangan/load_table.php?id_mapel=<?php echo $id_mapel; ?>&id_kelas=<?php echo $id_kelas; ?>&jenjang=<?php echo $jenjang; ?>&semester=<?php echo $semester; ?>&type_nilai=<?php echo $type_nilai; ?>&id_siswa=<?php echo $id_siswa; ?>&id_tahun_ajar=<?php echo $id_tahun_ajar; ?>',
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