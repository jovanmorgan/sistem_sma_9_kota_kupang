<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa

// Ambil data dari URL menggunakan metode GET
$id_mapel = isset($_GET['id_mapel']) ? $_GET['id_mapel'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$type_nilai = isset($_GET['type_nilai']) ? $_GET['type_nilai'] : '';
$id_tahun_ajar = isset($_GET['id_tahun_ajar']) ? $_GET['id_tahun_ajar'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<?php
include '../proses/head.php';
?>

<body class="white-content" translate="no">
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
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

                                        // Periksa apakah session id_admin telah diset
                                        if (isset($_SESSION['id_admin'])) {
                                            $id_admin = $_SESSION['id_admin'];

                                            // Query SQL untuk mengambil data admin berdasarkan id_admin dari session
                                            $query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data admin
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data admin sebagai array asosiatif
                                                    $admin = mysqli_fetch_assoc($result);
                                        ?>
                                        <?php if (!empty($admin['fp'])) : ?>
                                        <img class="avatar" src="data_fp/<?php echo $admin['fp']; ?>" alt="...">
                                        <?php else : ?>
                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                        <?php endif; ?>
                                        <h5 class="title">
                                            <?php echo $admin['id_admin']; ?>
                                        </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data admin
                                                    echo "Tidak ada data admin.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data admin: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_admin tidak diset
                                            echo "Session id_admin tidak tersedia.";
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
            <!-- End Navbar -->
            <?php

            // Koneksi ke database
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

            // Query SQL untuk mengambil data dari tabel tahun_ajar
            $query_tahun_ajar = "SELECT * FROM tahun_ajar";
            $result_tahun_ajar = mysqli_query($koneksi, $query_tahun_ajar);

            if ($result_tahun_ajar) {
                $tahun_ajar_data = mysqli_fetch_all($result_tahun_ajar, MYSQLI_ASSOC);
            } else {
                echo "Gagal mengambil data dari database";
                $tahun_ajar_data = [];
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

            // Query SQL untuk menampilkan data siswa berdasarkan kelas dan jenjang yang dipilih
            $query = "SELECT siswa.*, kelas.kelas AS nama_kelas, kebutuhan_khusus.jenis_kebutuhan_khusus AS jenis_kebutuhan_khusus
          FROM siswa
          LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
          LEFT JOIN kebutuhan_khusus ON siswa.id_kebutuhan_khusus = kebutuhan_khusus.id_kebutuhan_khusus";

            if (!empty($id_kelas) && !empty($jenjang)) {
                $query .= " WHERE siswa.id_kelas = '$id_kelas' AND siswa.jenjang = '$jenjang'";
            }

            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

            if (!empty($search_query)) {
                $query .= " AND (siswa.nama LIKE '%$search_query%' OR siswa.nis LIKE '%$search_query%')";
            }

            $query .= " ORDER BY siswa.id_siswa DESC";
            $result = mysqli_query($koneksi, $query);


            ?>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row mb-3">
                                        <div class="col-md-12 ml-auto mr-auto text-center">
                                            <h2 class="card-title-custom">Data Detail Nilai <?php echo $type_nilai; ?>
                                            </h2>
                                            <p class="category-custom">Click card mata pelajaran untuk mengisi nilai</p>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk mapel -->
                                            <div class="select-custom">
                                                <label for="mapel">Mapel:</label>
                                                <select id="mapel" class="form-control">
                                                    <option value="" disabled selected>Pilih Mapel</option>
                                                    <?php foreach ($mapel_data as $mapel) : ?>
                                                    <option value="<?php echo $mapel['id_mapel']; ?>"
                                                        <?php if ($mapel['id_mapel'] == $id_mapel) echo 'selected'; ?>>
                                                        <?php echo $mapel['nama_mapel']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk kelas -->
                                            <div class="select-custom">
                                                <label for="kelas">Kelas:</label>
                                                <select id="kelas" class="form-control">
                                                    <option value="" disabled selected>Pilih Kelas</option>
                                                    <?php foreach ($kelas_data as $kelas) : ?>
                                                    <option value="<?php echo $kelas['id_kelas']; ?>"
                                                        <?php if ($kelas['id_kelas'] == $id_kelas) echo 'selected'; ?>>
                                                        <?php echo $kelas['kelas']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk tahun_ajar -->
                                            <div class="select-custom">
                                                <label for="tahun_ajar">Tahun Ajar:</label>
                                                <select id="tahun_ajar" class="form-control">
                                                    <option value="" disabled selected>Pilih Tahun Ajar</option>
                                                    <?php foreach ($tahun_ajar_data as $tahun_ajar) : ?>
                                                    <option value="<?php echo $tahun_ajar['id_tahun_ajar']; ?>"
                                                        <?php if ($tahun_ajar['id_tahun_ajar'] == $id_tahun_ajar)
                                                                                                                        echo 'selected'; ?>>
                                                        <?php echo $tahun_ajar['tahun_ajar_awal']; ?>/<?php echo $tahun_ajar['tahun_ajar_akhir']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk jenjang -->
                                            <div class="select-custom">
                                                <label for="jenjang">Jenjang:</label>
                                                <select id="jenjang" class="form-control">
                                                    <option value="" disabled selected>Pilih Jenjang</option>
                                                    <option value="SD" <?php if ($jenjang == 'SD') echo 'selected'; ?>>
                                                        SD</option>
                                                    <option value="SMP"
                                                        <?php if ($jenjang == 'SMP') echo 'selected'; ?>>SMP</option>
                                                    <option value="SMA"
                                                        <?php if ($jenjang == 'SMA') echo 'selected'; ?>>SMA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk semester -->
                                            <div class="select-custom">
                                                <label for="semester">Semester:</label>
                                                <select id="semester" class="form-control">
                                                    <option value="" disabled selected>Pilih Semester</option>
                                                    <option value="Ganjil"
                                                        <?php if ($semester == 'Ganjil') echo 'selected'; ?>>Ganjil
                                                    </option>
                                                    <option value="Genap"
                                                        <?php if ($semester == 'Genap') echo 'selected'; ?>>Genap
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <script>
                                        document.getElementById('mapel').addEventListener('change',
                                            reloadPageWithSelection);
                                        document.getElementById('kelas').addEventListener('change',
                                            reloadPageWithSelection);
                                        document.getElementById('jenjang').addEventListener('change',
                                            reloadPageWithSelection);
                                        document.getElementById('semester').addEventListener('change',
                                            reloadPageWithSelection);
                                        document.getElementById('tahun_ajar').addEventListener('change',
                                            reloadPageWithSelection);

                                        function reloadPageWithSelection() {
                                            var id_mapel = document.getElementById('mapel').value;
                                            var id_kelas = document.getElementById('kelas').value;
                                            var jenjang = document.getElementById('jenjang').value;
                                            var semester = document.getElementById('semester').value;
                                            var id_tahun_ajar = document.getElementById('tahun_ajar').value;

                                            window.location.href =
                                                `detail_nilai.php?id_mapel=${id_mapel}&id_kelas=${id_kelas}&jenjang=${jenjang}&semester=${semester}&id_tahun_ajar=${id_tahun_ajar}&type_nilai=<?php echo $type_nilai; ?>`;
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
                                                <th class="text-center" style="white-space: nowrap;">Nomor Induk Siswa
                                                </th>
                                                <th class="text-center" style="white-space: nowrap;">Nama</th>
                                                <th class="text-center" style="white-space: nowrap;">Jumlah Nilai
                                                    Pengetahuan</th>
                                                <th class="text-center" style="white-space: nowrap;">Jumlah Nilai
                                                    Ketrampilan</th>
                                                <th class="text-center" style="white-space: nowrap;">Jumlah Nilai</th>
                                                <th class="text-center" style="white-space: nowrap;">Nilai Rata-Rata
                                                </th>
                                                <th class="text-center" style="white-space: nowrap;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $counter = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $id_siswa = $row['id_siswa'];

                                                    // Query untuk menjumlahkan nilai_pengetahuan dan nilai_ketrampilan
                                                    $query_nilai = "SELECT SUM(nilai_pengetahuan) AS total_pengetahuan, SUM(nilai_ketrampilan) AS total_ketrampilan
                        FROM nilai
                        WHERE id_mapel = '$id_mapel' AND id_siswa = '$id_siswa' AND semester = '$semester' AND type_nilai = '$type_nilai' AND id_tahun_ajar = '$id_tahun_ajar'";
                                                    $result_nilai = mysqli_query($koneksi, $query_nilai);
                                                    $nilai_pengetahuan = 0;
                                                    $nilai_ketrampilan = 0;

                                                    if ($result_nilai && mysqli_num_rows($result_nilai) > 0) {
                                                        $row_nilai = mysqli_fetch_assoc($result_nilai);
                                                        $nilai_pengetahuan = $row_nilai['total_pengetahuan'];
                                                        $nilai_ketrampilan = $row_nilai['total_ketrampilan'];
                                                    }

                                                    // Hitung nilai total dan rata-rata
                                                    $jumlah_nilai_pengetahuan = round($nilai_pengetahuan);
                                                    $jumlah_nilai_ketrampilan = round($nilai_ketrampilan);
                                                    $jumlah_nilai = round($nilai_pengetahuan + $nilai_ketrampilan);
                                                    $jumlah_nilai_rata_rata = ($nilai_pengetahuan + $nilai_ketrampilan) / 2;

                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $counter . "</td>";
                                                    echo "<td class='text-center'>" . $row['nis'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                    echo "<td class='text-center'>" . $jumlah_nilai_pengetahuan . "</td>";
                                                    echo "<td class='text-center'>" . $jumlah_nilai_ketrampilan . "</td>";
                                                    echo "<td class='text-center'>" . $jumlah_nilai . "</td>";
                                                    echo "<td class='text-center'>" . number_format($jumlah_nilai_rata_rata, 1) . "</td>"; // Format dengan satu desimal
                                                    echo "<td class='text-center'>";
                                                    echo "<a href='tambah_nilai?id_mapel={$id_mapel}&id_kelas={$id_kelas}&jenjang={$jenjang}&semester={$semester}&type_nilai={$type_nilai}&id_siswa={$row['id_siswa']}&id_tahun_ajar={$id_tahun_ajar}' class='btn btn-primary btn-sm'>Tambah & Edit Nilai</a>";
                                                    echo "</td>";
                                                    echo "</tr>";

                                                    $counter++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='8' class='text-center'><h3>Tidak ada data siswa yang sesuai dengan kriteria</h3></td></tr>";
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
            xhr.open('POST', 'siswa/tambah.php', true);
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
                    } else if (response === 'data_username_sudah_ada') {
                        swal("Username Salah!",
                            "Data username sudah digunakan silakan gunakan username lain",
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
            xhr.open('POST', 'siswa/edit.php', true);
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

                    xhr.open('POST', 'siswa/hapus.php', true);
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
        xhrTable.open('GET', 'siswa/load_table.php', true);
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