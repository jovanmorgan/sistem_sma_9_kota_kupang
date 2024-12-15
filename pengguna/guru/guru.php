<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_guru'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman guru.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../img/logo.png">
    <title>
        Akademik | guru Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

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
                    <li class="active">
                        <a href="./guru">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_siswa">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_jadwa_kbm">
                            <i class="tim-icons icon-calendar-60"></i>
                            <p>Jadwal KBM</p>
                        </a>
                    </li>
                    <li>
                        <a href="./guru_data_nilai">
                            <i class="tim-icons icon-atom"></i>
                            <p>Nilai</p>
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
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->
            <?php
            include '../../koneksi.php';

            // Fungsi untuk menghitung total data di setiap tabel
            function countTableData($koneksi, $table)
            {
                $sql = "SELECT COUNT(*) as total FROM $table";
                $result = mysqli_query($koneksi, $sql);
                $row = mysqli_fetch_assoc($result);
                return $row['total'];
            }

            $tables = ['guru', 'jadwal_kbm', 'siswa', 'absensi1'];
            $dataCounts = [];

            foreach ($tables as $table) {
                $dataCounts[$table] = countTableData($koneksi, $table);
            }
            ?>
            <div class="content">
                <div class="row">
                    <?php
                    $categories = [
                        'guru' => 'Total Guru',
                        'jadwal_kbm' => 'Total Jadwal KBM',
                        'siswa' => 'Total Siswa',
                        'absensi1' => 'Total Absensi'
                    ];

                    $icons = [
                        'guru' => 'fas fa-chalkboard-teacher',
                        'jadwal_kbm' => 'fas fa-calendar-alt',
                        'siswa' => 'fas fa-user-graduate',
                        'tahun_ajar' => 'fas fa-calendar',
                        'wali_kelas' => 'fas fa-chalkboard',
                        'absensi1' => 'fas fa-calendar-check'
                    ];

                    foreach ($dataCounts as $table => $count) {
                        echo '<div class="col-lg-4">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">' . $categories[$table] . '</h5>
                                <h3 class="card-title"><i class="' . $icons[$table] . '"></i> ' . $count . ' ' . ucfirst(str_replace('_', ' ', $table)) . '</h3>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data ' . strtolower($categories[$table]) . ' pada SLBN KOTA KUPANG
                            </div>
                        </div>
                    </div>';
                    }
                    ?>
                </div>
            </div>
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
                        </script> Dibuat Oleh Ronaldilak
                    </div>
                </div>
            </footer>
        </div>
    </div>

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
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

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