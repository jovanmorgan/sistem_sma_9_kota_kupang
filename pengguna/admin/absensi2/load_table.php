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
        include '../../../koneksi.php';

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