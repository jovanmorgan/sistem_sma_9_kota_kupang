<table class="table tablesorter " id="dataTable">
    <thead class=" text-primary">
        <tr>
            <th class="text-center">
                Nomor
            </th>
            <th class="text-center">
                Judul
            </th>
            <th class="text-center">
                Kegiatan
            </th>
            <th class="text-center">
                Tanggal
            </th>
            <th class="text-center">
                Gambar
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

        // Query SQL untuk mengambil data dari tabel berita
        $query = "SELECT * FROM berita";

        // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
        if (!empty($search_query)) {
            $query .= " WHERE tanggal LIKE '%$search_query%' OR judul LIKE '%$search_query%' OR isi_kegiatan LIKE '%$search_query%' OR foto LIKE '%$search_query%'";
        }

        // Balik urutan data untuk memunculkan yang paling baru di atas
        $query .= " ORDER BY id_berita DESC";
        $result = mysqli_query($koneksi, $query);

        // Variabel untuk menyimpan nomor urut
        $counter = 1;

        // Cek jika query berhasil dieksekusi
        if ($result) {
            // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
            while ($row = mysqli_fetch_assoc($result)) {
                // Menampilkan data ke dalam tabel HTML
                $foto = str_replace('../../../', '../../', $row['foto']);
                $isi_kegiatan = nl2br(htmlspecialchars($row['isi_kegiatan'], ENT_QUOTES));
                // Mengganti newline dengan <br> dan menghapus baris baru
                $isi = str_replace(array("\r", "\n"), '', $isi_kegiatan);
                echo "<tr>";
                echo "<td class='text-center'>" . $counter . "</td>";
                echo "<td class='text-center'>" . $row['judul'] . "</td>";
                echo "<td class='text-center'>" . $isi . "</td>";
                echo "<td class='text-center'>" . $row['tanggal'] . "</td>";
                echo "<td class='text-center'><img src='" . $foto . "' class='img-thumbnail' style='width: 100px; cursor: pointer;' onclick='showImage(\"" . $foto . "\")'></td>";
                echo "<td class='text-center'>
        <button class='btn btn-primary btn-sm' onclick='openEditModal(
            \"" . $row['id_berita'] . "\",
            \"" . $row['tanggal'] . "\",
            \"" . $row['judul'] . "\",
            \"" . $isi . "\",
            \"" . $foto . "\"
        )'>Edit</button>
            </td>";
                echo "<td class='text-center'>
            <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_berita'] . "\")'>Hapus</button>
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