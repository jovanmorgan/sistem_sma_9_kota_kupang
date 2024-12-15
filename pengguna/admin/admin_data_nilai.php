<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
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

            <!-- Modal untuk menampilkan gambar -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="modalImage" src="" width="100%" class="img-fluid" alt="Gambar">
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showImage(src) {
                    var modalImage = document.getElementById('modalImage');
                    modalImage.src = src;
                    $('#imageModal').modal('show');
                }
            </script>

            <!-- Modal Tambah Data Tambah -->
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
                            <form id="form_tambah" action="berita/tambah.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal:</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="judul">Judul:</label>
                                    <input type="text" class="form-control" placeholder="Silakan masukan judul" id="judul" name="judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="isi_kegiatan">Text:</label>
                                    <textarea class="form-control" id="isi_kegiatan" name="isi_kegiatan" required></textarea>
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

            // Tutup koneksi ke database
            mysqli_close($koneksi);
            ?>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-custom">
                            <div class="card-body card-body-custom">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title-custom">Data Nilai</h2>
                                            <p class="category-custom">Click card mata pelajaran untuk mengisi nilai</p>
                                            <hr>
                                            <!-- Tambahkan select option dari tabel kelas -->
                                            <div class="select-custom">
                                                <label for="kelas">Pilih Kelas:</label>
                                                <select id="kelas" class="form-control">
                                                    <option value="" disabled selected>Pilih Kelas</option>
                                                    <?php foreach ($kelas_data as $kelas) : ?>
                                                        <option value="<?php echo $kelas['id_kelas']; ?>">
                                                            <?php echo $kelas['kelas']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <!-- Tambahkan select option dari tabel tahun_ajar -->
                                            <div class="select-custom">
                                                <label for="tahun_ajar">Pilih Tahun Ajar:</label>
                                                <select id="tahun_ajar" class="form-control">
                                                    <option value="" disabled selected>Pilih Tahun Ajar</option>
                                                    <?php foreach ($tahun_ajar_data as $tahun_ajar) : ?>
                                                        <option value="<?php echo $tahun_ajar['id_tahun_ajar']; ?>">
                                                            <?php echo $tahun_ajar['tahun_ajar_awal']; ?>/<?php echo $tahun_ajar['tahun_ajar_akhir']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <!-- Tambahkan select option untuk jenjang dengan data tetap -->
                                            <div class="select-custom">
                                                <label for="jenjang">Jenjang:</label>
                                                <select id="jenjang" class="form-control">
                                                    <option value="" disabled selected>Pilih Jenjang</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="SMA">SMA</option>
                                                </select>
                                            </div>
                                            <div class="select-custom">
                                                <label for="semester">Semester:</label>
                                                <select id="semester" class="form-control">
                                                    <option value="" disabled selected>Pilih Semester</option>
                                                    <option value="Ganjil">Ganjil</option>
                                                    <option value="Genap">Genap</option>
                                                </select>
                                            </div>
                                            <div class="select-custom">
                                                <label for="type_nilai">Type Nilai:</label>
                                                <select id="type_nilai" class="form-control">
                                                    <option value="" disabled selected>Type Nilai</option>
                                                    <option value="Tugas">Tugas</option>
                                                    <option value="Ulangan">Ulangan</option>
                                                    <option value="Uts">Uts</option>
                                                    <option value="Uas">Uas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($mapel_data as $mapel) : ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-custom kotak_keren" onclick="detailData('<?php echo $mapel['id_mapel']; ?>')">
                                <div class="card-header card-header-custom">
                                    <h3 class="card-title-custom pb-3 text-center">
                                        <?php echo $mapel['nama_mapel']; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <style>
                .kotak_keren {
                    border: none;
                    border-radius: 15px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    transition: transform 0.2s;
                    margin-bottom: 20px;
                    cursor: pointer;
                }

                .kotak_keren:hover {
                    transform: scale(1.05);
                }

                .card-header-custom {
                    background-color: #f8f9fa;
                    border-bottom: 1px solid #e9ecef;
                    border-top-left-radius: 15px;
                    border-top-right-radius: 15px;
                    padding: 15px;
                }

                .card-title-custom {
                    color: #343a40;
                    font-size: 1.5rem;
                    margin: 0;
                }

                .icon-custom {
                    color: #007bff;
                    margin-right: 10px;
                }

                .card-body-custom {
                    padding: 15px;
                }

                .kotak_keren {
                    opacity: 0;
                    animation: fadeIn 1s forwards;
                }

                @keyframes fadeIn {
                    to {
                        opacity: 1;
                    }
                }

                .content {
                    margin-top: 20px;
                }

                .category-custom {
                    color: #6c757d;
                }

                .select-custom {
                    margin-bottom: 20px;
                }
            </style>

            <!-- Include SweetAlert -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function detailData(id_mapel) {
                    const kelas = document.getElementById('kelas').value;
                    const jenjang = document.getElementById('jenjang').value;
                    const semester = document.getElementById('semester').value;
                    const type_nilai = document.getElementById('type_nilai').value;
                    const tahun_ajar = document.getElementById('tahun_ajar').value;

                    if (!tahun_ajar) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Tahun Ajar belum dipilih!',
                        });
                        return;
                    }

                    if (!kelas) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Kelas belum dipilih!',
                        });
                        return;
                    }

                    if (!jenjang) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Jenjang belum dipilih!',
                        });
                        return;
                    }

                    if (!semester) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Semester belum dipilih!',
                        });
                        return;
                    }

                    if (!type_nilai) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Type nilai belum dipilih!',
                        });
                        return;
                    }

                    // Jika semua validasi terlewati, redirect ke halaman detail_nilai
                    window.location.href =
                        `detail_nilai.php?id_mapel=${id_mapel}&id_kelas=${kelas}&jenjang=${jenjang}&semester=${semester}&type_nilai=${type_nilai}&id_tahun_ajar=${tahun_ajar}`;
                }
            </script>

            <style>
                .kotak_keren {
                    border: none;
                    border-radius: 15px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    transition: transform 0.2s;
                    margin-bottom: 20px;
                    cursor: pointer;
                }

                .kotak_keren:hover {
                    transform: scale(1.05);
                }

                .card-header-custom {
                    background-color: #f8f9fa;
                    border-bottom: 1px solid #e9ecef;
                    border-top-left-radius: 15px;
                    border-top-right-radius: 15px;
                    padding: 15px;
                }

                .card-title-custom {
                    color: #343a40;
                    font-size: 1.5rem;
                    margin: 0;
                }

                .icon-custom {
                    color: #007bff;
                    margin-right: 10px;
                }

                .card-body-custom {
                    padding: 15px;
                }

                .kotak_keren {
                    opacity: 0;
                    animation: fadeIn 1s forwards;
                }

                @keyframes fadeIn {
                    to {
                        opacity: 1;
                    }
                }

                .content {
                    margin-top: 20px;
                }

                .category-custom {
                    color: #6c757d;
                }

                .select-custom {
                    margin-bottom: 20px;
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
                xhr.open('POST', form.action, true);
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
                        } else if (response === 'file_bukan_gambar') {
                            swal("Error", "File yang diunggah bukan gambar", "error");
                        } else if (response === 'tipe_file_tidak_diperbolehkan') {
                            swal("Error", "Tipe file tidak diperbolehkan", "error");
                        } else if (response === 'file_terlalu_besar') {
                            swal("Error", "File terlalu besar", "error");
                        } else if (response === 'gagal_upload') {
                            swal("Error", "Gagal mengunggah file", "error");
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

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_edit').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'berita/edit.php', true);
                xhr.onload = function() {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Berhasil!", "Data berhasil diubah", "success");
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#editModal').modal('hide');
                            // Muat ulang tabel
                            loadTable();
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (response === 'file_bukan_gambar') {
                            swal("Error", "File yang diunggah bukan gambar", "error");
                        } else if (response === 'tipe_file_tidak_diperbolehkan') {
                            swal("Error", "Tipe file gambar tidak diperbolehkan", "error");
                        } else if (response === 'gagal_upload') {
                            swal("Error", "Gagal mengunggah gambar", "error");
                        } else {
                            swal("Error", "Gagal mengubah data", "error");
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

                        xhr.open('POST', 'berita/hapus.php', true);
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


        function loadTable() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('dataTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'berita/load_table.php', true);
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