<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>www.Slbn Kota Kupang.com</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <!-- Memuat CSS Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" href="home.css" />-->
    <!--<link ICON MATA" />-->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-image: url('img/latarlogin.jpg');
            background-size: cover;
            /* Agar gambar memenuhi seluruh layar */
            background-size: cover;
            /* Agar gambar memenuhi seluruh layar */
            background-position: center;
            /* Agar gambar terpusat */
            background-repeat: no-repeat;
            /* Agar gambar tidak diulang */

        }

        .card-hover {
            background-color: rgba(255, 255, 255, 0.9);
            /* Warna putih dengan transparansi 80% */
            border-radius: 0px;
            /* Sedikit lengkung pada sudut */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            /* Bayangan lembut */
            padding: 20px;
            /* Spasi di dalam card */
        }


        /**NAVBAR HEADER */
        /* Navbar Shadow */

        #navbar {
            transition: box-shadow 0.2s ease;
            /* Tambahkan transisi untuk animasi shadow */
        }

        .navbar-shadow {
            box-shadow: 0px 4px 10px rgba(0, 12, 0, 0.9);
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
            border: 1px solid rgb(220, 220, 218);
            /* Atur lebar menjadi 100% dari lebar viewport */
        }

        /* Atur posisi navbar agar tetap di atas */

        .navbar-brand {
            width: auto;
            /* Atur lebar sesuai kebutuhan */
        }

        /* Atur panjang lebar form search */

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

        .card-hover {
            transition: box-shadow 0.3s ease-in-out;
            border-radius: 2.5%;
        }

        .card-hover:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
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
                        <a class="nav-link active" aria-current="page" href="login">Beranda</a>
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
                </ul>
            </div>
        </div>
    </nav>
    <!-- Konten ke 1-->
    <div class="hero-section">
    </div>
    <!-- Konten ke 2-->
    <div id="konten2" class="container-lg mt-5 mb-1">
        <div class="row bagian2">
            <div class="col-md-6 offset-md-3">
                <div class="card card-hover">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">SISTEM INFORMASI AKADEMIK</h2>
                        <hr>
                        <h5 class="card-title text-center mb-4">LOGIN</h5>
                        <form id="login" action="proses_login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Masukkan Username Anda">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukkan Password Anda">
                                    <span class="input-group-text" id="password-toggle"
                                        onclick="togglePasswordVisibility('password')" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
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

    </div>
    </div>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var passwordIcon = document.getElementById(inputId + '-icon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        document.getElementById("login").addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "proses_login.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        var responseArray = response.split(':');
                        if (responseArray[0].trim() === "success") {
                            swal("Login berhasil!", "Selamat datang " + responseArray[1], "success");

                            setTimeout(function() {
                                switch (responseArray[2].trim()) {
                                    case "admin":
                                        window.location.href = "pengguna/admin/admin";
                                        break;
                                    case "guru":
                                        window.location.href = "pengguna/guru/guru";
                                        break;
                                    case "wali_kelas":
                                        window.location.href = "pengguna/wali_kelas/wali_kelas";
                                        break;
                                    case "siswa":
                                        window.location.href = "pengguna/siswa/siswa";
                                        break;
                                    case "kepalah_sekolah":
                                        window.location.href =
                                            "pengguna/kepalah_sekolah/kepalah_sekolah";
                                        break;
                                    default:
                                        window.location.href = "login";
                                        break;
                                }
                            }, 2000);

                            if (rememberMe) {
                                var username = formData.get('username');
                                var password = formData.get('password');
                                document.cookie = "username=" + encodeURIComponent(username) + "; path=/";
                                document.cookie = "password=" + encodeURIComponent(password) + "; path=/";
                            }
                        } else if (responseArray[0].trim() === "error_password") {
                            swal("Error", "Password yang dimasukkan salah", "error");
                        } else if (responseArray[0].trim() === "error_username") {
                            swal("Error", "Username tidak ditemukan", "error");
                        } else if (responseArray[0].trim() === "username_tidak_ada") {
                            swal("Info", "Username belum diisi", "info");
                        } else if (responseArray[0].trim() === "password_tidak_ada") {
                            swal("Info", "Password belum diisi", "info");
                        } else if (responseArray[0].trim() === "tidak_ada_data") {
                            swal("Info", "Username dan Password belum diisi", "info");
                        } else {
                            swal("Error", "Terjadi kesalahan saat proses login", "error");
                        }
                    } else {
                        swal("Error", "Gagal", "error");
                    }
                }
            };
            xhr.onerror = function() {
                swal("Error", "Gagal melakukan request", "error");
            };
            xhr.send(formData);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js "></script>
</body>

</html>