<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_kepalah_sekolah'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman kepalah_sekolah.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../img/logo.png">
    <title>
        Akademik | Data Guru
    </title>
    <link rel="icon" type="image/png" href="../../../aimg/logo.png">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <style>
    /* Style scrollbar */
    .table-responsive::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    .button-like {
        display: inline-block;
        padding: 5px 10px;
        background-color: #4e73df;
        color: white;
        border-radius: 5px;
    }
    </style>
</head>

<body translate="no">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Data Guru</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered display nowrap"
                                style="width:100%">
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
                                            Mengajar pada jenjang
                                        </th>
                                        <th class="text-center">
                                            Alamat
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            // Lakukan koneksi ke database
                                            include '../../../koneksi.php';
                                            // Ambil kata kunci pencarian dari URL jika ada
                                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
                                            // Query SQL untuk mengambil data dari tabel guru
                                            $query = "SELECT * FROM guru";
                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE nama LIKE '%$search_query%' OR nip LIKE '%$search_query%' OR jenis_kelamin LIKE '%$search_query%' OR nomor_telepon LIKE '%$search_query%' OR username LIKE '%$search_query%' OR password LIKE '%$search_query%' OR jenjang LIKE '%$search_query%' OR alamat LIKE '%$search_query%'";
                                            }
                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_guru DESC";
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
                                                    echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nip'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['jenis_kelamin'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nomor_telepon'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['jenjang'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['alamat'] . "</td>";
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

    <!-- Tautan ke file jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tautan ke file JavaScript DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <!-- Tautan ke file JavaScript untuk ekspor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: 'PDF A3',
                    customize: function(doc) {
                        doc.pageSize = 'A3';
                        doc.content[1].table.headerRows = 1;
                        doc.content[1].table.body[0].forEach(function(col) {
                            col.fillColor = '#cccccc';
                        });
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF A4',
                    customize: function(doc) {
                        doc.pageSize = 'A4';
                        doc.content[1].table.headerRows = 1;
                        doc.content[1].table.body[0].forEach(function(col) {
                            col.fillColor = '#cccccc';
                        });
                    }
                },
                'copy', 'csv', 'excel', 'print'
            ]
        });
    });
    </script>
</body>

</html>