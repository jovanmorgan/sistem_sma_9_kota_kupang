<table class="table tablesorter " id="dataTable">
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
                Username
            </th>
            <th class="text-center">
                Password
            </th>
            <th class="text-center">
                Kelas
            </th>
            <th class="text-center">
                Tahun Ajaran
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
                echo "<td class='text-center'><p class='button-like text-white'>" . $row['username'] . "</p></td>";
                echo "<td class='text-center'><p class='button-like text-white'>" . $row['password'] . "</p></td>";
                echo "<td class='text-center'>" . $row['tahun_ajar_awal'] . "/" . $row['tahun_ajar_akhir'] . "</td>";
                echo "<td class='text-center'>" . $row['nama_kelas'] . "</td>";
                echo "<td class='text-center'>" . $row['jenjang'] . "</td>";
                echo "<td class='text-center'>" . $row['jenis_kebutuhan_khusus'] . "</td>";
                echo "<td class='text-center'>" . $row['alamat'] . "</td>";
                echo "<td class='text-center'>
                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                        \"" . $row['id_siswa'] . "\",
                        \"" . $row['nis'] . "\",
                        \"" . $row['nama'] . "\",
                        \"" . $row['jenis_kelamin'] . "\",
                        \"" . $row['tempat_lahir'] . "\",
                        \"" . $tli . "\",
                        \"" . $row['id_kelas'] . "\",
                        \"" . $row['id_tahun_ajar'] . "\",
                        \"" . $row['id_kebutuhan_khusus'] . "\",
                        \"" . $row['jenjang'] . "\",
                        \"" . $row['alamat'] . "\",
                        \"" . $row['username'] . "\",
                        \"" . $row['password'] . "\"
                    )'>Edit</button>
                </td>";
                echo "<td class='text-center'>
                    <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_siswa'] . "\")'>Hapus</button>
              </td>";

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