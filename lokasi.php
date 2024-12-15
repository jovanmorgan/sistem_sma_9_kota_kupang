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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            background-color: rgb(237, 231, 231);
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
            height: 100vh;
            background-position: center;
            color: white;
            text-align: center;
            padding: 140px 0;
        }

        .hero-section .overlay {
            content: "";
            position: absolute;
            background-color: rgba(0, 0, 0, 0.4);
            /* Ubah opacity di sini (0.5 adalah 50%) */
            background-size: cover;
            background-position: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            padding: 140px 0;
            z-index: 1;
            /* Mengatur z-index lebih rendah agar berada di belakang elemen lain */
        }

        /* CSS untuk animasi */

        @keyframes heartbeat {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        /* CSS untuk elemen h5 */

        .container h5 {
            animation: heartbeat 2s infinite;
            /* Menambahkan animasi heartbeat */
        }

        /*LOGIN*/
        /* CSS untuk tombol login */

        .login-button {
            font-size: 20px;
            font-weight: bolder;
            display: inline-block;
            background-color: #f05045;
            /* Warna latar belakang */
            color: #fff;
            /* Warna teks */
            padding: 10px 250px;
            /* Padding */
            border-radius: 5px;
            /* Sudut lengkung */
            text-decoration: none;
            /* Hapus garis bawah */
            transition: background-color 0.3s ease;
            /* Transisi warna latar belakang */
            border-radius: 20px;
        }

        /* Hover state */

        .login-button:hover {
            background-color: #9e0606;
            /* Warna latar belakang saat dihover */
            color: #fff;
        }

        /* Media queries untuk responsif BUTTON LOGIN */

        @media (max-width: 768px) {
            .login-button {
                padding: 10px 130px;
                /* Mengurangi padding pada layar yang lebih kecil */
            }
        }

        @media (max-width: 576px) {
            .login-button {
                padding: 10px 130px;
                /* Mengurangi padding lebih jauh pada layar yang lebih kecil */
            }
        }

        .hero-section h1,
        .hero-section .kebawa,
        .hero-section h5,
        .hero-section,
        .login-button,
        .hero-section .login-button:hover {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Mengatur z-index lebih tinggi agar berada di atas overlay */
        }

        /*KONTEN KE 1*/

        .kontainer h5 {
            animation-name: initial;
        }

        /*KONTEK KE 2*/

        .left-content {
            position: relative;
            /* Menentukan posisi relatif untuk membuat efek terangkat */
        }

        .left-content img {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Menambahkan transisi pada transformasi dan box-shadow
        */
        }

        .left-content img:hover {
            transform: translateY(-10px);
            /* Mengangkat gambar 10px saat kursor di atasnya */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            /* Menambahkan shadow saat kursor di atasnya */
        }

        .right-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            position: relative;
            top: 70px;
            /* Menyesuaikan tinggi agar terpusat */
        }

        /* CSS untuk kalender */

        #calendar {
            background-color: #f8f9fa;
            border: 1px solid #3a3b3c;
            padding: 35px;
            border-radius: 5px;
        }

        #calendar h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        #calendar p {
            font-size: 16px;
            margin: 0;
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
                        <a class="nav-link" aria-current="page" href="login">Beranda</a>
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
                        <a class="nav-link" href="berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="lokasi">Lokasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="kontak" class="embed-responsive embed-responsive-16by9" style="padding: 10px; background-color: #fff;">
        <h3 class="text-center">Lokasi Sekolah</h3>
        <hr>
        <iframe style="width: 100%; height: 400px;" class="embed-responsive-item"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127306.04223006537!2d123.4731773!3d-10.146615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c5683854107fcc7%3A0xf6d7e226d5ac070a!2sSLBN%20Kota%20Kupang!5e0!3m2!1sen!2sid!4v1691498120534!5m2!1sen!2sid"
            frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
        </iframe>
    </div>

    <!--FOOTER-->
    <footer id="footer" class="bg-dark text-white text-center py-4 mt-2">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-12">
                    <h5>Kontak Kami</h5>
                    <p>Email: <a href="mailto:info@slbnkotakupang.com" class="text-white">info@slbnkotakupang.com</a>
                    </p>
                    <p>Telepon: <a href="tel:+628123456789" class="text-white">+62 82235-565-552</a></p>
                    <div class="social-icons mt-3">
                        <a href="https://www.facebook.com/slbnkotakupang" target="_blank" class="text-white me-3">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://www.twitter.com/slbnkotakupang" target="_blank" class="text-white me-3">
                            <i class="fab fa-twitter fa-2x"></i>
                        </a>
                        <a href="https://www.instagram.com/ronal_woda" target="_blank" class="text-white me-3">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://wa.me/6282235565552" target="_blank" class="text-white">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <p>&copy; 2024 SLBN Kota Kupang. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="home.js "></script>
    <!-- Memuat JavaScript Bootstrap dari CDN -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js ">
    </script>
</body>

</html>