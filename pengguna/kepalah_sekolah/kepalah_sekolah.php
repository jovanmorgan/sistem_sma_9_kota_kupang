<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_kepalah_sekolah'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman kepalah_sekolah.php seperti biasa
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard Kepalah Sekolah</a>
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

                                        // Periksa apakah session id_kepalah_sekolah telah diset
                                        if (isset($_SESSION['id_kepalah_sekolah'])) {
                                            $id_kepalah_sekolah = $_SESSION['id_kepalah_sekolah'];

                                            // Query SQL untuk mengambil data kepalah_sekolah berdasarkan id_kepalah_sekolah dari session
                                            $query = "SELECT * FROM kepalah_sekolah WHERE id_kepalah_sekolah = '$id_kepalah_sekolah'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data kepalah_sekolah
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data kepalah_sekolah sebagai array asosiatif
                                                    $kepalah_sekolah = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($kepalah_sekolah['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $kepalah_sekolah['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $kepalah_sekolah['id_kepalah_sekolah']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data kepalah_sekolah
                                                    echo "Tidak ada data kepalah_sekolah.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data kepalah_sekolah: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_kepalah_sekolah tidak diset
                                            echo "Session id_kepalah_sekolah tidak tersedia.";
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

            $tables = ['guru', 'siswa'];
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
                        'siswa' => 'Total Siswa'
                    ];

                    $icons = [
                        'guru' => 'fas fa-chalkboard-teacher',
                        'siswa' => 'fas fa-user-graduate'
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