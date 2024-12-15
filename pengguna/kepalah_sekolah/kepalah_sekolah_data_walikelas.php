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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard kepalah_sekolah</a>
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
                                        <img class="avatar" src="data_fp/<?php echo $kepalah_sekolah['fp']; ?>"
                                            alt="...">
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

            <!-- Modal Tambah Data Tamabh -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog"
                aria-labelledby="modalTambahwali_kelasLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahwali_kelasLabel">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan data tambah -->
                            <form id="form_tambah" action="wali_kelas/tambah.php" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id_guru">Guru:</label>
                                    <select class="form-control" id="id_guru" name="id_guru" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../koneksi.php';

                                        // Query untuk mendapatkan data guru
                                        $query_guru = "SELECT id_guru, nama FROM guru";
                                        $result_guru = $koneksi->query($query_guru);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result_guru) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row_guru = $result_guru->fetch_assoc()) {
                                                echo "<option value='" . $row_guru['id_guru'] . "'>" . $row_guru['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result_guru->free();
                                        } else {
                                            echo "Gagal mengeksekusi query guru: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="id_kelas">Kelas:</label>
                                    <select class="form-control" id="id_kelas" name="id_kelas" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../koneksi.php';

                                        // Query untuk mendapatkan data kelas
                                        $query = "SELECT id_kelas, kelas FROM kelas";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_kelas'] . "'>" . $row['kelas'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="text" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
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
                            <form id="form_edit" action="wali_kelas/edit.php" method="POST"
                                enctype="multipart/form-data">
                                <!-- Menambahkan input tersembunyi untuk menyimpan id_video saat mengedit -->
                                <input type="hidden" id="editid_wali_kelas" name="id_wali_kelas">

                                <div class="form-group">
                                    <label for="id_guru">Guru:</label>
                                    <select class="form-control" id="editid_guru" name="id_guru" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../koneksi.php';

                                        // Query untuk mendapatkan data guru
                                        $query_guru = "SELECT id_guru, nama FROM guru";
                                        $result_guru = $koneksi->query($query_guru);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result_guru) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row_guru = $result_guru->fetch_assoc()) {
                                                echo "<option value='" . $row_guru['id_guru'] . "'>" . $row_guru['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result_guru->free();
                                        } else {
                                            echo "Gagal mengeksekusi query guru: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="id_kelas">Kelas:</label>
                                    <select class="form-control" id="editid_kelas" name="id_kelas" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../koneksi.php';

                                        // Query untuk mendapatkan data kelas
                                        $query = "SELECT id_kelas, kelas FROM kelas";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_kelas'] . "'>" . $row['kelas'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="editusername" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="text" class="form-control" id="editpassword" name="password" required>
                                </div>
                                <script>
                                function openEditModal(id_wali_kelas, id_guru, id_kelas, username, password) {
                                    // Isi data ke dalam form edit
                                    document.getElementById('editid_wali_kelas').value = id_wali_kelas;
                                    document.getElementById('editid_guru').value = id_guru;
                                    document.getElementById('editid_kelas').value = id_kelas;
                                    document.getElementById('editusername').value = username;
                                    document.getElementById('editpassword').value = password;
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

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data Walikelas
                                            </h2>

                                            <p class="category">Clik untuk menambah data wali kelas</p>
                                            <hr>
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
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">
                                                    Nomor
                                                </th>
                                                <th class="text-center">
                                                    Nama
                                                </th>
                                                <th class="text-center">
                                                    Nomor Edintitas Pegawai
                                                </th>
                                                <th class="text-center">
                                                    Jenis Kelamin
                                                </th>
                                                <th class="text-center">
                                                    Nomor Telepon
                                                </th>
                                                <th class="text-center">
                                                    Kelas
                                                </th>
                                                <th class="text-center">
                                                    Username
                                                </th>
                                                <th class="text-center">
                                                    Password
                                                </th>
                                                <th class="text-center">
                                                    Mengajar pada jenjang
                                                </th>
                                                <th class="text-center">
                                                    Alamat
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

                                            // Lakukan koneksi ke database
                                            include '../../koneksi.php';

                                            // Ambil kata kunci pencarian dari URL jika ada
                                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                            // Query SQL untuk mengambil data dari tabel wali_kelas, juga mengambil data nama guru dan nama kelas berdasarkan id_guru dan id_kelas
                                            $query = "SELECT wali_kelas.*, guru.nama AS nama_guru, guru.nip AS nip_guru, guru.jenis_kelamin AS jenis_kelamin_guru, guru.nomor_telepon AS nomor_telepon_guru, kelas.kelas AS nama_kelas, guru.jenjang AS jenjang_guru, guru.alamat AS alamat_guru 
          FROM wali_kelas
          LEFT JOIN guru ON wali_kelas.id_guru = guru.id_guru
          LEFT JOIN kelas ON wali_kelas.id_kelas = kelas.id_kelas";

                                            // Jika ada jenjang, tambahkan klausa WHERE untuk mencocokkan jenjang
                                            if (!empty($jenjang)) {
                                                $query .= " WHERE guru.jenjang = '$jenjang'";
                                            }

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE atau AND untuk mencocokkan
                                            if (!empty($search_query)) {
                                                if (strpos($query, 'WHERE') !== false) {
                                                    $query .= " AND (guru.nama LIKE '%$search_query%' OR wali_kelas.username LIKE '%$search_query%' OR wali_kelas.password LIKE '%$search_query%' OR guru.nip LIKE '%$search_query%' OR guru.jenis_kelamin LIKE '%$search_query%' OR guru.nomor_telepon LIKE '%$search_query%' OR kelas.kelas LIKE '%$search_query%' OR guru.alamat LIKE '%$search_query%')";
                                                } else {
                                                    $query .= " WHERE (guru.nama LIKE '%$search_query%' OR wali_kelas.username LIKE '%$search_query%' OR wali_kelas.password LIKE '%$search_query%' OR guru.nip LIKE '%$search_query%' OR guru.jenis_kelamin LIKE '%$search_query%' OR guru.nomor_telepon LIKE '%$search_query%' OR kelas.kelas LIKE '%$search_query%' OR guru.alamat LIKE '%$search_query%')";
                                                }
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY wali_kelas.id_wali_kelas DESC";

                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Menampilkan data ke dalam tabel HTML
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $counter . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama_guru'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nip_guru'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['jenis_kelamin_guru'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nomor_telepon_guru'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama_kelas'] . "</td>";
                                                    echo "<td class='text-center'><p class='button-like text-white'>" . $row['username'] . "</p></td>";
                                                    echo "<td class='text-center'><p class='button-like text-white'>" . $row['password'] . "</p></td>";
                                                    echo "<td class='text-center'>" . $row['jenjang_guru'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['alamat_guru'] . "</td>";
                                                    echo "</tr>";

                                                    // Increment nomor urut
                                                    $counter++;
                                                }
                                            } else {
                                                echo "<td class='text-center'><h3>Gagal mengambil data dari database</h3></td>";
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
            event.preventDefault(); // Menghentikan aksi default form submit

            var form = this;
            var formData = new FormData(form);

            // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
            loding.style.display = 'flex';

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'wali_kelas/tambah.php', true);
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
            xhr.open('POST', 'wali_kelas/edit.php', true);
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

                    xhr.open('POST', 'wali_kelas/hapus.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {

                        // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                        loding.style.display = 'none';

                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            if (response === 'success') {
                                swal("Sukses!", "Data info berhasil dihapus.", "success")
                                loadTable();
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
        xhrTable.open('GET', 'wali_kelas/load_table.php', true);
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