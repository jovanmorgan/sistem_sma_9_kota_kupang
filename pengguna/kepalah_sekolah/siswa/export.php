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
        Akademik | Data siswa
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
                        <h3 class="text-center">Data Siswa</h3>
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
                                            Nomor Induk Siswa
                                        </th>
                                        <th class="text-center">
                                            Nama
                                        </th>
                                        <th class="text-center">
                                            Jenis Kelamin
                                        </th>
                                        <th class="text-center">
                                            Tempat Lahir
                                        </th>
                                        <th class="text-center">
                                            Tanggal Lahir
                                        </th>
                                        <th class="text-center">
                                            Tahun Ajaran
                                        </th>
                                        <th class="text-center">
                                            Kelas
                                        </th>
                                        <th class="text-center">
                                            Belajar pada jenjang
                                        </th>
                                        <th class="text-center">
                                            Kebutuhan Khusus
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

                                            // Query SQL untuk mengambil data dari tabel siswa, juga mengambil data nama guru dan nama kelas berdasarkan id_guru dan id_kelas
                                            $query = "SELECT siswa.*, kelas.kelas AS nama_kelas, tahun_ajar.tahun_ajar_awal AS tahun_ajar_awal, tahun_ajar.tahun_ajar_akhir AS tahun_ajar_akhir, kebutuhan_khusus.jenis_kebutuhan_khusus AS jenis_kebutuhan_khusus
          FROM siswa
          LEFT JOIN tahun_ajar ON siswa.id_tahun_ajar = tahun_ajar.id_tahun_ajar
          LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
          LEFT JOIN kebutuhan_khusus ON siswa.id_kebutuhan_khusus = kebutuhan_khusus.id_kebutuhan_khusus";

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE siswa.nama LIKE '%$search_query%' OR siswa.nis LIKE '%$search_query%' OR siswa.username LIKE '%$search_query%' OR siswa.password LIKE '%$search_query%' OR siswa.tempat_lahir LIKE '%$search_query%' OR siswa.tanggal_lahir LIKE '%$search_query%' OR siswa.jenis_kelamin LIKE '%$search_query%' OR siswa.alamat LIKE '%$search_query%' OR siswa.jenjang LIKE '%$search_query%' OR kelas.kelas LIKE '%$search_query%' OR kebutuhan_khusus.jenis_kebutuhan_khusus LIKE '%$search_query%'";
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY siswa.id_siswa DESC";

                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Menampilkan data ke dalam tabel HTML
                                                    $tl = $row['tanggal_lahir'];
                                                    $tli = date('Y-m-d', strtotime($tl));
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $counter . "</td>";
                                                    echo "<td class='text-center'>" . $row['nis'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['jenis_kelamin'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['tempat_lahir'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['tanggal_lahir'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['tahun_ajar_awal'] . "/" . $row['tahun_ajar_akhir'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama_kelas'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['jenjang'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['jenis_kebutuhan_khusus'] . "</td>";
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