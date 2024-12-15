<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>www.Slbn Kota Kupang.com</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <!-- Memuat CSS Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!--<link rel="stylesheet" href="home.css" />-->
    <style>
    body {
        background-color: rgb(255, 255, 255);
    }

    /**NAVBAR HEADER */

    .navbar {
        background-color: rgb(174, 47, 47);
        z-index: 3;
        position: fixed;
        width: 100%;
    }

    /* Navbar Shadow */

    #navbar {
        transition: box-shadow 0.3s ease;
        /* Tambahkan transisi untuk animasi shadow */
    }

    .navbar-shadow {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.9);
        /* Ubah nilai bayangan sesuai kebutuhan */
    }

    /**LOGO BAGIAN KIRI NAVBAR HEADER  */

    .logo img {
        display: flex;
    }

    .logo img {
        position: relative;
        top: 30px;
        left: 20px;
        width: 1px;
        height: 1px;
    }

    .logo a {
        text-decoration: none;
        color: black;
        position: relative;
        top: -10px;
        left: -506px;
    }

    .logo h1 {
        font-size: 19px;
        position: relative;
        left: 700px;
    }

    .logo p {
        color: black;
        position: relative;
        font-size: 15px;
        top: 16px;
        left: -95%;
    }

    .logo h1:hover {
        color: red;
    }

    .logo p:hover {
        color: rgb(216, 216, 24);
    }

    /**NAVBAR ITEM */
    /* Atur lebar navbar */

    .navbar-nav .nav-item:hover {
        background-color: rgba(250, 242, 6, 0.529);
        /* Atur warna latar belakang saat kursor mengarah pada menu li */
    }

    .navbar {
        width: 100%;
        /* Atur lebar menjadi 100% dari lebar viewport */
    }

    /* Atur posisi navbar agar tetap di atas */

    .navbar {
        position: fixed;
        /* Atur posisi menjadi tetap */
        top: 0;
        /* Atur posisi di bagian atas */
        left: 0;
        /* Atur posisi di bagian kiri */
        z-index: 1000;
        /* Atur z-index untuk menempatkan navbar di atas konten lain */
    }

    /* Atur lebar elemen navbar-brand */

    .navbar-brand {
        width: auto;
        /* Atur lebar sesuai kebutuhan */
    }

    /* Atur panjang lebar form search */

    .form-control {
        width: 300px;
        /* Atur lebar sesuai kebutuhan */
    }

    /* Atur posisi dan ukuran font pada tombol search */

    .btn-outline-success {
        font-size: 14px;
        /* Atur ukuran font */
        margin-left: 10px;
        /* Atur jarak antara input dan tombol */
    }

    /* Atur panjang lebar dropdown menu */

    .dropdown-menu {
        min-width: 200px;
        /* Atur lebar minimum sesuai kebutuhan */
    }

    /* Atur lebar dropdown item */

    .dropdown-menu .dropdown-item {
        width: 100%;
        /* Atur lebar menjadi 100% */
    }

    /* Atur jarak antara tiap-tiap nav-item */

    .navbar-nav .nav-item {
        margin-right: 60px;
        /* Atur jarak kanan antara tiap-tiap nav-item */
    }

    /* Atur jarak kanan untuk nav-item terakhir */

    .navbar-nav .nav-item:last-child {
        margin-right: 0;
        /* Atur jarak kanan menjadi 0 untuk nav-item terakhir */
    }

    /* Atur jarak kanan untuk dropdown menu */

    .dropdown-menu {
        margin-top: 0;
        /* Atur jarak atas menjadi 0 untuk dropdown menu */
        margin-right: 0;
        /* Atur jarak kanan menjadi 0 untuk dropdown menu */
    }

    /**BACKROUND GAMBAR DI BAWAH NAVBAR HEADER */
    /* Styling untuk div dengan background gambar */

    .hero-section {
        position: relative;
        background-image: url("img/background.awal.jpg");
        background-size: cover;
        width: auto;
        height: 0vh;
        background-position: center;
        color: white;
        text-align: center;
        padding: 140px 0;
    }

    .hero-section .overlay {
        content: "";
        position: absolute;
        background-color: rgba(0, 0, 0, 0.7);
        /* Ubah opacity di sini (0.5 adalah 50%) */
        background-size: cover;
        background-position: center;
        top: 0;
        left: 0;
        width: 100%;
        height: 0vh;
        padding: 140px 0;
        z-index: 1;
        /* Mengatur z-index lebih rendah agar berada di belakang elemen lain */
    }

    /* Heading 1 pada backround atas*/

    .hero-section h1 {
        position: relative;
        top: 20px;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        /* Mengatur z-index lebih tinggi agar berada di atas overlay */
    }

    /*KONTEN KE 2*/
    /* Animasi untuk muncul dari bawah */

    @keyframes slideInFromBottom {
        0% {
            transform: translateY(100%);
        }

        100% {
            transform: translateY(0);
        }
    }

    /* Terapkan animasi pada elemen yang diinginkan */

    .slide-in-from-bottom {
        animation: slideInFromBottom 1s ease-out;
        /* Sesuaikan durasi dan efek animasi */
    }

    /*tabel*/
    /* Atur tampilan tabel */

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody+tbody {
        border-top: 2px solid #dee2e6;
    }

    .table-sm th,
    .table-sm td {
        padding: 0.3rem;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px;
    }

    .table-borderless th,
    .table-borderless td,
    .table-borderless thead th,
    .table-borderless tbody+tbody {
        border: 0;
    }
    </style>
</head>

<body>

    <!--NAVBAR HEADER -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="position: relative; top: -10px"><img src="img/gif-unscreen.gif"
                    style="height: 50px; width: auto; position: relative; top: 5px" />SLBN KOTA KUPANG</a>
            <p style="
            position: relative;
            top: 15px;
            right: 195px;
            letter-spacing: 8px;">
                Kelapa Lima
            </p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Home">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profil Sekolah
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="tentangsekolah">Tentang Sekolah</a></li>
                            <li><a class="dropdown-item" href="visimisi">Visi misi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Home#berita">Berita</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="home#kontak">Kontak</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten ke 1-->
    <div class="hero-section">
        <div class="overlay"></div>
        <div class="container">
            <h1>DATA GURU </h1>
        </div>
    </div>

    <!-- Konten ke 2-->
    <div id="konten2" class="container mt-2 mb-1 bg-light slide-in-from-bottom">
        <h2 class="garistitik text-center py-4">
            -------------------
        </h2>
        <h2 class="text-center py-3">GURU SLBN KOTA KUPANG | Kelapa Lima</h2>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center bg-danger text-white">
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data Guru -->
                            <tr>
                                <td><img src="foto_guru1.jpg" alt="Foto Guru"></td>
                                <td>John Doe</td>
                                <td>1234567890</td>
                                <td>Jl. Contoh No. 123</td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td><img src="foto_guru1.jpg" alt="Foto Guru"></td>
                                <td>Rubik</td>
                                <td>1234567890</td>
                                <td>Jl. Contoh No. 124</td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td><img src="foto_guru1.jpg" alt="Foto Guru"></td>
                                <td>Luffy</td>
                                <td>1234567890</td>
                                <td>Jl. Contoh No. 177</td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td><img src="foto_guru1.jpg" alt="Foto Guru"></td>
                                <td>namychan</td>
                                <td>1234567890</td>
                                <td>Jl. Contoh No. 111</td>
                                <td>081234567890</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Tombol untuk melihat data lain -->
                <div class="text-center">
                    <button class="btn btn-primary" onclick="nextData()">Lihat data lain</button>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>

    <script>
    </script>





    <!--FOOTER-->
    <footer id="footer" class="bg-dark text-white text-center py-4 mt-2 ">
        <div class="container-xxl ">
            <div class="row ">
                <div class="col-md-4 ">
                    <h5>Company</h5>
                    <p>About Us</p>
                    <p>Our Team</p>
                    <p>Careers</p>
                </div>
                <div class="col-md-4 ">
                    <h5>Support</h5>
                    <p>Contact Us</p>
                    <p>FAQs</p>
                    <p>Privacy Policy</p>
                </div>
                <div class="col-md-4 ">
                    <h5>Follow Us</h5>
                    <p>Facebook</p>
                    <p>Twitter</p>
                    <p>Instagram</p>
                </div>
            </div>
            <div class="row mt-3 ">
                <div class="col ">
                    <p>&copy; 2024 SLBN Kota Kupang. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="dataguru.js"></script>
    <!-- Memuat JavaScript Bootstrap dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js "></script>
</body>

</html>