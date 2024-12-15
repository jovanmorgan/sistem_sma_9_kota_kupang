<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_wali_kelas'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa

// Ambil data dari URL menggunakan metode GET
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$type_nilai = isset($_GET['type_nilai']) ? $_GET['type_nilai'] : '';
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

                                            // Query SQL untuk mengambil data wali_kelas berdasarkan id_wali_kelas dari session
                                            $query = "SELECT * FROM wali_kelas WHERE id_wali_kelas = '$id_wali_kelas'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data wali_kelas
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data wali_kelas sebagai array asosiatif
                                                    $wali_kelas = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($wali_kelas['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $wali_kelas['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $wali_kelas['id_wali_kelas']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data wali_kelas
                                                    echo "Tidak ada data wali_kelas.";
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

            // Query SQL untuk mengambil data dari tabel kelas
            $query_kelas = "SELECT * FROM kelas";
            $result_kelas = mysqli_query($koneksi, $query_kelas);

            if ($result_kelas) {
                $kelas_data = mysqli_fetch_all($result_kelas, MYSQLI_ASSOC);
            } else {
                echo "Gagal mengambil data kelas dari database";
                $kelas_data = [];
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

            // Query SQL untuk menampilkan data siswa berdasarkan kelas dan jenjang yang dipilih
            $query = "SELECT siswa.*, kelas.kelas AS nama_kelas, kebutuhan_khusus.jenis_kebutuhan_khusus AS jenis_kebutuhan_khusus
        FROM siswa
        LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
        LEFT JOIN kebutuhan_khusus ON siswa.id_kebutuhan_khusus = kebutuhan_khusus.id_kebutuhan_khusus";

            if (!empty($id_kelas) && !empty($jenjang)) {
                $query .= " WHERE siswa.id_kelas = '$id_kelas' AND siswa.jenjang = '$jenjang' AND siswa.id_tahun_ajar = '$id_tahun_ajar'";
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
                                            <h2 class="card-title-custom">Data Keterangan
                                            </h2>
                                            <p class="category-custom">
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk tahun_ajar -->
                                            <div class="select-custom">
                                                <label for="tahun_ajar">Tahun Ajar:</label>
                                                <select id="tahun_ajar" class="form-control">
                                                    <option value="" disabled selected>Pilih Tahun Ajar</option>
                                                    <?php foreach ($tahun_ajar_data as $tahun_ajar) : ?>
                                                        <option value="<?php echo $tahun_ajar['id_tahun_ajar']; ?>" <?php if ($tahun_ajar['id_tahun_ajar'] == $id_tahun_ajar)
                                                                                                                        echo 'selected'; ?>>
                                                            <?php echo $tahun_ajar['tahun_ajar_awal']; ?>/<?php echo $tahun_ajar['tahun_ajar_akhir']; ?>
                                                        </option>
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
                                                        <option value="<?php echo $kelas['id_kelas']; ?>" <?php if ($kelas['id_kelas'] == $id_kelas)
                                                                                                                echo 'selected'; ?>>
                                                            <?php echo $kelas['kelas']; ?>
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
                                                    <option value="SD" <?php if ($jenjang == 'SD')
                                                                            echo 'selected'; ?>>
                                                        SD</option>
                                                    <option value="SMP" <?php if ($jenjang == 'SMP')
                                                                            echo 'selected'; ?>>
                                                        SMP</option>
                                                    <option value="SMA" <?php if ($jenjang == 'SMA')
                                                                            echo 'selected'; ?>>
                                                        SMA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto mr-auto text-center">
                                            <!-- Select option untuk semester -->
                                            <div class="select-custom">
                                                <label for="semester">Semester:</label>
                                                <select id="semester" class="form-control">
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
                                                <th class="text-center" style="white-space: nowrap;">Lihat Repot</th>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $counter = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $counter . "</td>";
                                                    echo "<td class='text-center'>" . $row['nis'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                    echo "<td class='text-center'>";
                                                    echo "<a href='#' onclick='checkAndRedirect(\"{$id_kelas}\", \"{$jenjang}\", \"{$semester}\", \"{$row['id_siswa']}\", \"{$id_tahun_ajar}\")' class='btn btn-primary btn-sm'>Lihat keterangan</a>";
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.getElementById('kelas').addEventListener('change', function() {
            reloadPageWithSelection();
        });

        document.getElementById('jenjang').addEventListener('change', function() {
            reloadPageWithSelection();
        });

        document.getElementById('semester').addEventListener('change', function() {
            reloadPageWithSelection();
        });

        document.getElementById('tahun_ajar').addEventListener('change', function() {
            reloadPageWithSelection();
        });

        function reloadPageWithSelection() {
            var id_kelas = document.getElementById('kelas').value;
            var jenjang = document.getElementById('jenjang').value;
            var semester = document.getElementById('semester').value;
            var id_tahun_ajar = document.getElementById('tahun_ajar').value; // Ambil nilai tahun ajaran yang dipilih

            // Ubah URL saat melakukan reload halaman dengan memasukkan id_tahun_ajar
            window.location.href =
                `wali_kelas_data_keterangan.php?id_kelas=${id_kelas}&jenjang=${jenjang}&semester=${semester}&type_nilai=<?php echo $type_nilai; ?>&id_tahun_ajar=${id_tahun_ajar}`;
        }


        function checkAndRedirect(id_kelas, jenjang, semester, id_siswa, id_tahun_ajar) {
            var tahun_ajar = document.getElementById('tahun_ajar').value;
            var kelas = document.getElementById('kelas').value;
            var jenjang_val = document.getElementById('jenjang').value;
            var semester_val = document.getElementById('semester').value;

            // Check if all fields are selected
            if (!tahun_ajar) {
                // Show sweetalert notification if not all fields are selected
                swal("Opsi Tahun Ajar", "Opsi Tahun Ajar Belum Dipilih, Silakan Pilih Terlebih Dahulu!", "error");
            } else if (!kelas) {
                // Show sweetalert notification if not all fields are selected
                swal("Opsi Kelas", "Opsi Kelas Belum Dipilih, Silakan Pilih Terlebih Dahulu!", "error");
            } else if (!jenjang_val) {
                // Show sweetalert notification if not all fields are selected
                swal("Opsi Jenjang", "Opsi Jenjang Belum Dipilih, Silakan Pilih Terlebih Dahulu!", "error");
            } else if (!semester_val) {
                // Show sweetalert notification if not all fields are selected
                swal("Opsi Semester", "Opsi Semester Belum Dipilih, Silakan Pilih Terlebih Dahulu!", "error");
            } else {
                // Redirect to tambah_keterangan page if all fields are selected
                var url =
                    `tambah_keterangan.php?id_kelas=${id_kelas}&jenjang=${jenjang}&semester=${semester}&id_siswa=${id_siswa}&id_tahun_ajar=${id_tahun_ajar}`;
                window.location.href = url;
            }
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