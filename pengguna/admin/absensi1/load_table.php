                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">
                                                    Nomor
                                                </th>
                                                <th class="text-center">
                                                    Kelas
                                                </th>
                                                <th class="text-center">
                                                    Mapel
                                                </th>
                                                <th class="text-center">
                                                    Jenjang
                                                </th>
                                                <th class="text-center">
                                                    Detail
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

                                                $query = "SELECT absensi1.*, kelas.kelas AS nama_kelas, mapel.nama_mapel AS nama_mapel
                                                        FROM absensi1
                                                        LEFT JOIN mapel ON absensi1.id_mapel  = mapel.id_mapel 
                                                        LEFT JOIN kelas ON absensi1.id_kelas = kelas.id_kelas";

                                                // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                                if (!empty($search_query)) {
                                                    $query .= " WHERE kelas.kelas LIKE '%$search_query%' OR mapel.nama_mapel LIKE '%$search_query%' OR absensi1.jenjang LIKE '%$search_query%'";
                                                }

                                                // Balik urutan data untuk memunculkan yang paling baru di atas
                                                $query .= " ORDER BY absensi1.id_absensi1 DESC";

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
                                                        echo "<td class='text-center'>" . $row['nama_kelas'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nama_mapel'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['jenjang'] . "</td>";
                                                        echo "<td class='text-center'>
                                                                <a href='admin_data_absensi_detail?id_absensi=" . $row['id_absensi1'] . "' class='btn btn-info btn-sm'>Detail</a>
                                                            </td>";
                                                        echo "<td class='text-center'>
                                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                        \"" . $row['id_absensi1'] . "\",
                                                                        \"" . $row['id_kelas'] . "\",
                                                                        \"" . $row['id_mapel'] . "\",
                                                                        \"" . $row['jenjang'] . "\"
                                                                    )'>Edit</button>
                                                                </td>";
                                                        echo "<td class='text-center'>
                                                                    <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_absensi1'] . "\")'>Hapus</button>
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