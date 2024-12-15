<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_wali_kelas'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman wali_kelas.php seperti biasa
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
                    <li class="active">
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
                    <li>
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard Wali Kelas</a>
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

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahGuruLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahGuruLabel">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_tambah" action="absensi2/tambah.php" method="POST" enctype="multipart/form-data">

                                <!-- Form for selecting guru -->
                                <div class="form-group">
                                    <label for="id_guru">Guru:</label>
                                    <select class="form-control" id="id_guru" name="id_guru" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Query untuk mendapatkan data guru
                                        include '../../koneksi.php';
                                        $query_guru = "SELECT id_guru, nama, jenjang FROM guru";
                                        $result_guru = $koneksi->query($query_guru);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result_guru) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row_guru = $result_guru->fetch_assoc()) {
                                                echo "<option value='" . $row_guru['id_guru'] . "'>" . $row_guru['nama'] . " | " . $row_guru['jenjang'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result_guru->free();
                                        } else {
                                            echo "Gagal mengeksekusi query guru: " . $koneksi->error;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Form for jam mengajar and jam pulang -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jam_mengajar">Jam Mengajar:</label>
                                            <input type="time" class="form-control" id="jam_mengajar" name="jam_mengajar" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jam_pulang">Jam Pulang:</label>
                                            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" required>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $id_absensi = isset($_GET['id_absensi']) ? $_GET['id_absensi'] : '';

                                $query = "SELECT absensi1.*, kelas.kelas AS nama_kelas, mapel.nama_mapel AS nama_mapel
                              FROM absensi1
                              LEFT JOIN mapel ON absensi1.id_mapel = mapel.id_mapel 
                              LEFT JOIN kelas ON absensi1.id_kelas = kelas.id_kelas
                              WHERE absensi1.id_absensi1 = '$id_absensi'";

                                $result = mysqli_query($koneksi, $query);

                                // Cek jika query berhasil dieksekusi
                                if ($result && $row = mysqli_fetch_assoc($result)) {
                                    $id_kelas = $row['id_kelas'];
                                    $jenjang = $row['jenjang'];
                                    echo "<input type='hidden' class='form-control' id='id_absensi1' name='id_absensi1' value='" . $row['id_absensi1'] . "' readonly>";
                                    echo "<input type='hidden' class='form-control' id='id_kelas' name='id_kelas' value='" . $row['id_kelas'] . "' readonly>";
                                    echo "<input type='hidden' class='form-control' id='id_absensi' name='id_absensi' value='" . $id_absensi . "' readonly>";
                                } else {
                                    echo "<p>Gagal mengambil data dari database.</p>";
                                }

                                // Query untuk mendapatkan data siswa berdasarkan id_kelas dan jenjang
                                $query_siswa = "SELECT id_siswa, nama FROM siswa WHERE id_kelas = '$id_kelas' AND jenjang = '$jenjang'";
                                $result_siswa = $koneksi->query($query_siswa);
                                ?>
                                <!-- Table for students -->
                                <div class="form-group">
                                    <label for="siswa">Data Siswa:</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>Hadir</th>
                                                <th>Sakit</th>
                                                <th>Ijin</th>
                                                <th>Alpa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result_siswa) {
                                                if ($result_siswa->num_rows > 0) {
                                                    while ($row_siswa = $result_siswa->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row_siswa['nama'] . "</td>";
                                                        echo "<td><input type='radio' name='status_kehadiran[" . $row_siswa['id_siswa'] . "]' value='hadir'></td>";
                                                        echo "<td><input type='radio' name='status_kehadiran[" . $row_siswa['id_siswa'] . "]' value='sakit'></td>";
                                                        echo "<td><input type='radio' name='status_kehadiran[" . $row_siswa['id_siswa'] . "]' value='ijin'></td>";
                                                        echo "<td><input type='radio' name='status_kehadiran[" . $row_siswa['id_siswa'] . "]' value='alpa'></td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td class='text-center' colspan='5'>Data siswa yang berkaitan tidak ada.</td></tr>";
                                                }
                                                $result_siswa->free();
                                            } else {
                                                echo "<tr><td colspan='5'>Gagal mengeksekusi query siswa: " . $koneksi->error . "</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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

            <?php
            $koneksi->close();
            ?>

            <!-- Modal Edit Data -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="font-size: 150%;">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_edit" action="absensi2/edit.php" method="POST" enctype="multipart/form-data">


                                <!-- Form for selecting guru -->
                                <div class="form-group">
                                    <label for="id_guru">Guru:</label>
                                    <select class="form-control" id="editid_guru" name="id_guru" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Query untuk mendapatkan data guru
                                        include '../../koneksi.php';
                                        $query_guru = "SELECT id_guru, nama, jenjang FROM guru";
                                        $result_guru = $koneksi->query($query_guru);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result_guru) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row_guru = $result_guru->fetch_assoc()) {
                                                echo "<option value='" . $row_guru['id_guru'] . "'>" . $row_guru['nama'] . " | " . $row_guru['jenjang'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result_guru->free();
                                        } else {
                                            echo "Gagal mengeksekusi query guru: " . $koneksi->error;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Form for jam mengajar and jam pulang -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jam_mengajar">Jam Mengajar:</label>
                                            <input type="time" class="form-control" id="editjam_mengajar" name="jam_mengajar" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jam_pulang">Jam Pulang:</label>
                                            <input type="time" class="form-control" id="editjam_pulang" name="jam_pulang" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden inputs -->
                                <input type="hidden" id="editid_absensi2" name="id_absensi2">
                                <input type="hidden" id="editid_absensi1" name="id_absensi1">
                                <input type="hidden" id="editid_kelas" name="id_kelas">

                                <div class="form-group">
                                    <label for="siswa">Data Siswa:</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>Hadir</th>
                                                <th>Sakit</th>
                                                <th>Ijin</th>
                                                <th>Alpa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentsData">
                                            <!-- Data siswa akan diisi menggunakan JavaScript -->
                                        </tbody>
                                    </table>
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
                function openEditModal(id_absensi2, id_absensi1, id_guru, hadir, sakit, ijin, alpa, jenjang, jam_mengajar,
                    jam_pulang) {
                    // Isi data ke dalam form edit
                    document.getElementById('editid_absensi2').value = id_absensi2;
                    document.getElementById('editid_absensi1').value = id_absensi1;
                    document.getElementById('editid_guru').value = id_guru;
                    document.getElementById('editjam_mengajar').value = jam_mengajar;
                    document.getElementById('editjam_pulang').value = jam_pulang;

                    // Parse data kehadiran
                    var hadirArray = hadir ? hadir.split(',') : [];
                    var sakitArray = sakit ? sakit.split(',') : [];
                    var ijinArray = ijin ? ijin.split(',') : [];
                    var alpaArray = alpa ? alpa.split(',') : [];

                    // Fetch siswa data and populate the table
                    fetch(`absensi2/get_siswa_data.php?id_absensi1=${id_absensi1}&jenjang=${jenjang}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                console.error(data.error);
                                return;
                            }

                            var studentsData = document.getElementById('studentsData');
                            studentsData.innerHTML = '';
                            data.forEach(siswa => {
                                var row = document.createElement('tr');
                                var hadirChecked = hadirArray.includes(siswa.id_siswa.toString()) ? 'checked' :
                                    '';
                                var sakitChecked = sakitArray.includes(siswa.id_siswa.toString()) ? 'checked' :
                                    '';
                                var ijinChecked = ijinArray.includes(siswa.id_siswa.toString()) ? 'checked' :
                                    '';
                                var alpaChecked = alpaArray.includes(siswa.id_siswa.toString()) ? 'checked' :
                                    '';

                                row.innerHTML = `
                    <td>${siswa.nama}</td>
                    <td><input type='radio' name='status_kehadiran[${siswa.id_siswa}]' value='hadir' ${hadirChecked}></td>
                    <td><input type='radio' name='status_kehadiran[${siswa.id_siswa}]' value='sakit' ${sakitChecked}></td>
                    <td><input type='radio' name='status_kehadiran[${siswa.id_siswa}]' value='ijin' ${ijinChecked}></td>
                    <td><input type='radio' name='status_kehadiran[${siswa.id_siswa}]' value='alpa' ${alpaChecked}></td>
                `;
                                studentsData.appendChild(row);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching siswa data:', error);
                        });

                    $('#editModal').modal('show');
                }
            </script>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data Absensi
                                            </h2>

                                            <p class="category">Clik untuk menambah data</p>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php
                                    include '../../koneksi.php';
                                    $id_absensi = isset($_GET['id_absensi']) ? $_GET['id_absensi'] : '';

                                    $query = "SELECT absensi1.*, kelas.kelas AS nama_kelas, mapel.nama_mapel AS nama_mapel
                              FROM absensi1
                              LEFT JOIN mapel ON absensi1.id_mapel = mapel.id_mapel 
                              LEFT JOIN kelas ON absensi1.id_kelas = kelas.id_kelas
                              WHERE absensi1.id_absensi1 = '$id_absensi'";

                                    $result = mysqli_query($koneksi, $query);

                                    // Cek jika query berhasil dieksekusi
                                    if ($result && $row = mysqli_fetch_assoc($result)) {
                                        $id_kelas = $row['id_kelas'];
                                        $jenjang = $row['jenjang'];
                                        echo "<div class='form-group'>";
                                        echo "<label for='nama_kelas'>Nama Kelas:</label>";
                                        echo "<input type='text' class='form-control' id='nama_kelas' name='nama_kelas' value='" . $row['nama_kelas'] . "' readonly>";
                                        echo "</div>";

                                        echo "<input type='hidden' class='form-control' id='id_absensi1' name='id_absensi1' value='" . $row['id_absensi1'] . "' readonly>";
                                        echo "<input type='hidden' class='form-control' id='id_kelas' name='id_kelas' value='" . $row['id_kelas'] . "' readonly>";

                                        echo "<div class='form-group'>";
                                        echo "<label for='nama_mapel'>Nama Mapel:</label>";
                                        echo "<input type='text' class='form-control' id='nama_mapel' name='nama_mapel' value='" . $row['nama_mapel'] . "' readonly>";
                                        echo "</div>";

                                        echo "<div class='form-group'>";
                                        echo "<label for='jenjang'>Jenjang:</label>";
                                        echo "<input type='text' class='form-control' id='jenjang' name='jenjang' value='" . $row['jenjang'] . "' readonly>";
                                        echo "</div>";
                                    } else {
                                        echo "<p>Gagal mengambil data dari database.</p>";
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">
                                                    Nomor
                                                </th>
                                                <th class="text-center">
                                                    Guru
                                                </th>
                                                <th class="text-center">
                                                    Tanggal Mengajar
                                                </th>
                                                <th class="text-center">
                                                    Jam Mengajar
                                                </th>
                                                <th class="text-center">
                                                    Jam Pulang
                                                </th>
                                                <th class="text-center">
                                                    Hadir
                                                </th>
                                                <th class="text-center">
                                                    Sakit
                                                </th>
                                                <th class="text-center">
                                                    Ijin
                                                </th>
                                                <th class="text-center">
                                                    Alpa
                                                </th>
                                                <th class="text-center">
                                                    Edit
                                                </th>
                                                <th class="text-center">
                                                    Hapus
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lakukan koneksi ke database
                                            include '../../koneksi.php';

                                            // Ambil id_absensi dari parameter URL
                                            $id_absensi = isset($_GET['id_absensi']) ? $_GET['id_absensi'] : '';

                                            // Query untuk mendapatkan data absensi1, kelas, dan mapel
                                            $query = "SELECT absensi1.*, kelas.kelas AS nama_kelas, mapel.nama_mapel AS nama_mapel
                                                        FROM absensi1
                                                        LEFT JOIN mapel ON absensi1.id_mapel = mapel.id_mapel 
                                                        LEFT JOIN kelas ON absensi1.id_kelas = kelas.id_kelas
                                                        WHERE absensi1.id_absensi1 = '$id_absensi'";

                                            $result = mysqli_query($koneksi, $query);

                                            // Cek jika query berhasil dieksekusi dan data ditemukan
                                            if ($result && $row = mysqli_fetch_assoc($result)) {
                                                $id_kelas = $row['id_kelas'];
                                                $jenjang = $row['jenjang'];
                                                // Query untuk mendapatkan data absensi2, guru, dan jenjang
                                                $query_absensi2 = "SELECT absensi2.*, guru.nama AS nama_guru, guru.jenjang AS jenjang_guru
                                                                    FROM absensi2
                                                                    LEFT JOIN guru ON absensi2.id_guru = guru.id_guru
                                                                    WHERE absensi2.id_absensi1 = '$id_absensi'
                                                                    ORDER BY absensi2.id_absensi2 DESC";

                                                $result_absensi2 = mysqli_query($koneksi, $query_absensi2);

                                                // Cek jika query berhasil dieksekusi
                                                if ($result_absensi2) {
                                                    // Cek apakah ada data yang ditemukan
                                                    if (mysqli_num_rows($result_absensi2) > 0) {
                                                        // Variabel untuk menyimpan nomor urut
                                                        $counter = 1;

                                                        // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                        while ($row_absensi2 = mysqli_fetch_assoc($result_absensi2)) {
                                                            // Menghitung jumlah siswa untuk setiap kategori kehadiran
                                                            $hadir = !empty($row_absensi2['hadir']) ? count(explode(',', $row_absensi2['hadir'])) : '-';
                                                            $sakit = !empty($row_absensi2['sakit']) ? count(explode(',', $row_absensi2['sakit'])) : '-';
                                                            $ijin = !empty($row_absensi2['ijin']) ? count(explode(',', $row_absensi2['ijin'])) : '-';
                                                            $alpa = !empty($row_absensi2['alpa']) ? count(explode(',', $row_absensi2['alpa'])) : '-';

                                                            echo "<tr>";
                                                            echo "<td class='text-center'>" . $counter . "</td>";
                                                            echo "<td class='text-center'>" . $row_absensi2['nama_guru'] . " | " . $row_absensi2['jenjang_guru'] . "</td>";
                                                            echo "<td class='text-center'>" . $row_absensi2['tanggal'] . "</td>";
                                                            echo "<td class='text-center'>" . $row_absensi2['jam_mengajar'] . "</td>";
                                                            echo "<td class='text-center'>" . $row_absensi2['jam_pulang'] . "</td>";
                                                            echo "<td class='text-center'>" . $hadir . "</td>";
                                                            echo "<td class='text-center'>" . $sakit . "</td>";
                                                            echo "<td class='text-center'>" . $ijin . "</td>";
                                                            echo "<td class='text-center'>" . $alpa . "</td>";
                                                            echo "<td class='text-center'>
                                                                <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                    \"" . $row_absensi2['id_absensi2'] . "\",
                                                                    \"" . $row_absensi2['id_absensi1'] . "\",
                                                                    \"" . $row_absensi2['id_guru'] . "\",
                                                                    \"" . $row_absensi2['hadir'] . "\",
                                                                    \"" . $row_absensi2['sakit'] . "\",
                                                                    \"" . $row_absensi2['ijin'] . "\",
                                                                    \"" . $row_absensi2['alpa'] . "\",
                                                                    \"" . $jenjang . "\",
                                                                    \"" . $row_absensi2['jam_mengajar'] . "\",
                                                                    \"" . $row_absensi2['jam_pulang'] . "\"
                                                                )'>Edit</button>
                                                            </td>";
                                                            echo "<td class='text-center'>
                                                                        <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row_absensi2['id_absensi2'] . "\")'>Hapus</button>
                                                                    </td>";
                                                            echo "</tr>";

                                                            // Increment nomor urut
                                                            $counter++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='10' class='text-center'><h3>Data yang berkaitan tidak ada.</h3></td></tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='10' class='text-center'><h3>Gagal mengeksekusi query absensi2: " . mysqli_error($koneksi) . "</h3></td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='10' class='text-center'><h3>Gagal mengambil data dari database: " . mysqli_error($koneksi) . "</h3></td></tr>";
                                            }

                                            // Tutup koneksi ke database
                                            mysqli_close($koneksi);
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
                event.preventDefault();

                var form = this;
                var formData = new FormData(form);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'absensi2/tambah.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Berhasil!", "Data berhasil ditambahkan", "success");
                            form.reset();
                            $('#modalTambah').modal('hide');
                            loadTable();
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_sudah_ada') {
                            swal("Salah!", "Data sudah digunakan silakan gunakan mapel lain", "error");
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
                xhr.open('POST', 'absensi2/edit.php', true);
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
                        } else if (response === 'data_sudah_ada') {
                            swal("mapel Salah!",
                                "Data mapel sudah digunakan silakan gunakan mapel lain",
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

                        xhr.open('POST', 'absensi2/hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            loding.style.display = 'none';

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Sukses!", "Data berhasil dihapus.", "success")
                                    loadTable();
                                } else {
                                    swal("Error", "Gagal menghapus data ini.", "error");
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

        // Fungsi untuk memuat ulang tabel
        function loadTable() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('dataTable').innerHTML = xhrTable.responseText;
                }
            };
            // Pastikan parameter id_absensi dikirim dengan benar
            let id_absensi = document.getElementById('id_absensi').value;
            xhrTable.open('GET', 'absensi2/load_table.php?id_absensi=' + id_absensi, true);
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