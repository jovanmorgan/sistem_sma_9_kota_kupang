                                    <table class="table tablesorter " id="dataTable">
                                    <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">
                                                    Nomor
                                                </th>
                                                <th class="text-center">
                                                    Mapel
                                                </th>
                                                <th class="text-center">
                                                    Kelas
                                                </th>
                                                <th class="text-center">
                                                    Guru
                                                </th>
                                                <th class="text-center">
                                                    Hari
                                                </th>
                                                <th class="text-center">
                                                    Kbm
                                                </th>
                                                <th class="text-center">
                                                    Tanggal
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

                                                $query = "SELECT jadwal_kbm.*, guru.nama AS nama_guru, kelas.kelas AS nama_kelas, mapel.nama_mapel AS nama_mapel
                                                        FROM jadwal_kbm
                                                        LEFT JOIN mapel ON jadwal_kbm.id_mapel  = mapel.id_mapel 
                                                        LEFT JOIN guru ON jadwal_kbm.id_guru = guru.id_guru
                                                        LEFT JOIN kelas ON jadwal_kbm.id_kelas = kelas.id_kelas";

                                                // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                                if (!empty($search_query)) {
                                                    $query .= " WHERE guru.nama LIKE '%$search_query%' OR kelas.kelas LIKE '%$search_query%' OR mapel.nama_mapel LIKE '%$search_query%' OR jadwal_kbm.hari LIKE '%$search_query%' OR jadwal_kbm.tanggal LIKE '%$search_query%' OR jadwal_kbm.jam_mengajar LIKE '%$search_query%' OR jadwal_kbm.jam_pulang";
                                                }

                                                // Balik urutan data untuk memunculkan yang paling baru di atas
                                                $query .= " ORDER BY jadwal_kbm.id_jadwal_kbm DESC";

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
                                                        echo "<td class='text-center'>" . $row['nama_mapel'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nama_kelas'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nama_guru'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['hari'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['jam_mengajar'] . " - " . $row['jam_pulang'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['tanggal'] . "</td>";
                                                        echo "<td class='text-center'>
                                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                        \"" . $row['id_jadwal_kbm'] . "\",
                                                                        \"" . $row['id_mapel'] . "\",
                                                                        \"" . $row['id_guru'] . "\",
                                                                        \"" . $row['id_kelas'] . "\",
                                                                        \"" . $row['hari'] . "\",
                                                                        \"" . $row['jam_mengajar'] . "\",
                                                                        \"" . $row['jam_pulang'] . "\",
                                                                        \"" . $row['tanggal'] . "\",
                                                                    )'>Edit</button>
                                                                </td>";
                                                        echo "<td class='text-center'>
                                                                    <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_jadwal_kbm'] . "\")'>Hapus</button>
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