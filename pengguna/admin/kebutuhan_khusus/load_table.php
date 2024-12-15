                                    <table class="table tablesorter " id="dataTable">
                                      <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">
                                                    Nomor
                                                </th>
                                                <th class="text-center">
                                                    Jenis kebutuhan khusus
                                                </th>
                                                <th class="text-center">
                                                    Deskripsi
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
                                        // Query SQL untuk mengambil data dari tabel guru
                                        $query = "SELECT * FROM kebutuhan_khusus";
                                        // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                        if (!empty($search_query)) {
                                            $query .= " WHERE nama LIKE '%$search_query%' OR nip LIKE '%$search_query%' OR jenis_kelamin LIKE '%$search_query%' OR nomor_telepon LIKE '%$search_query%' OR username LIKE '%$search_query%' OR password LIKE '%$search_query%' OR jenjang LIKE '%$search_query%' OR alamat LIKE '%$search_query%'";
                                        }
                                        // Balik urutan data untuk memunculkan yang paling baru di atas
                                        $query .= " ORDER BY id_kebutuhan_khusus DESC";
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
                                                echo "<td class='text-center'>" . $row['jenis_kebutuhan_khusus'] . "</td>";
                                                echo "<td class='text-center'>" . $row['deskripsi'] . "</td>";
                                                echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_kebutuhan_khusus'] . "\",
                                                        \"" . $row['jenis_kebutuhan_khusus'] . "\",
                                                        \"" . $row['deskripsi'] . "\"
                                                    )'>Edit</button>
                                                       </td>";
                                                        echo "<td class='text-center'>
                                                    <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_kebutuhan_khusus'] . "\")'>Hapus</button>
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