                                    <table class="table tablesorter " id="dataTable">
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
                                                    Username
                                                </th>
                                                <th class="text-center">
                                                    Password
                                                </th>
                                                <th class="text-center">
                                                    Mengajar pada jenjang
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
                                            $jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

                                            // Lakukan koneksi ke database
                                            include '../../../koneksi.php';

                                            // Ambil kata kunci pencarian dari URL jika ada
                                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                            // Query SQL untuk mengambil data dari tabel guru
                                            $query = "SELECT * FROM guru";

                                            // Jika ada jenjang, tambahkan klausa WHERE untuk mencocokkan jenjang
                                            if (!empty($jenjang)) {
                                                $query .= " WHERE jenjang = '$jenjang'";
                                            }

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE atau AND untuk mencocokkan
                                            if (!empty($search_query)) {
                                                if (strpos($query, 'WHERE') !== false) {
                                                    $query .= " AND (nama LIKE '%$search_query%' OR nip LIKE '%$search_query%' OR jenis_kelamin LIKE '%$search_query%' OR nomor_telepon LIKE '%$search_query%' OR username LIKE '%$search_query%' OR password LIKE '%$search_query%' OR jenjang LIKE '%$search_query%' OR alamat LIKE '%$search_query%')";
                                                } else {
                                                    $query .= " WHERE (nama LIKE '%$search_query%' OR nip LIKE '%$search_query%' OR jenis_kelamin LIKE '%$search_query%' OR nomor_telepon LIKE '%$search_query%' OR username LIKE '%$search_query%' OR password LIKE '%$search_query%' OR jenjang LIKE '%$search_query%' OR alamat LIKE '%$search_query%')";
                                                }
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_guru DESC";
                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Cek jika ada data yang ditemukan
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        // Menampilkan data ke dalam tabel HTML
                                                        echo "<tr>";
                                                        echo "<td class='text-center'>" . $counter . "</td>";
                                                        echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nip'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['jenis_kelamin'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nomor_telepon'] . "</td>";
                                                        echo "<td class='text-center'><p class='button-like text-white'>" . $row['username'] . "</p></td>";
                                                        echo "<td class='text-center'><p class='button-like text-white'>" . $row['password'] . "</p></td>";
                                                        echo "<td class='text-center'>" . $row['jenjang'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['alamat'] . "</td>";
                                                        echo "<td class='text-center'>
                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                        \"" . $row['id_guru'] . "\",
                        \"" . $row['nama'] . "\",
                        \"" . $row['nip'] . "\",
                        \"" . $row['jenis_kelamin'] . "\",
                        \"" . $row['jenjang'] . "\",
                        \"" . $row['nomor_telepon'] . "\",
                        \"" . $row['username'] . "\",
                        \"" . $row['password'] . "\",
                        \"" . $row['alamat'] . "\"
                    )'>Edit</button>
                   </td>";
                                                        echo "<td class='text-center'>
                    <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_guru'] . "\")'>Hapus</button>
                </td>";
                                                        echo "</tr>";

                                                        // Increment nomor urut
                                                        $counter++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='12' class='text-center'><h3>Data tidak ada</h3></td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='12' class='text-center'><h3>Gagal mengambil data dari database</h3></td></tr>";
                                            }

                                            // Tutup koneksi ke database
                                            mysqli_close($koneksi);
                                            ?>

                                        </tbody>
                                    </table>