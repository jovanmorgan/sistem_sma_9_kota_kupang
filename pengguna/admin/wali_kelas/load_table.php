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
                                                    Kelas
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
                                                // Lakukan koneksi ke database
                                                include '../../../koneksi.php';

                                                // Ambil kata kunci pencarian dari URL jika ada
                                                $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                                // Query SQL untuk mengambil data dari tabel wali_kelas, juga mengambil data nama guru dan nama kelas berdasarkan id_guru dan id_kelas
                                                $query = "SELECT wali_kelas.*, guru.nama AS nama_guru, guru.nip AS nip_guru, guru.jenis_kelamin AS jenis_kelamin_guru, guru.nomor_telepon AS nomor_telepon_guru, kelas.kelas AS nama_kelas, guru.jenjang AS jenjang_guru, guru.alamat AS alamat_guru 
                                                        FROM wali_kelas
                                                        LEFT JOIN guru ON wali_kelas.id_guru = guru.id_guru
                                                        LEFT JOIN kelas ON wali_kelas.id_kelas = kelas.id_kelas";

                                                // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                                if (!empty($search_query)) {
                                                    $query .= " WHERE wali_kelas.nama LIKE '%$search_query%' OR guru.nip LIKE '%$search_query%' OR guru.jenis_kelamin LIKE '%$search_query%' OR guru.nomor_telepon LIKE '%$search_query%' OR guru.jenjang LIKE '%$search_query%' OR guru.alamat LIKE '%$search_query%'";
                                                }

                                                // Balik urutan data untuk memunculkan yang paling baru di atas
                                                $query .= " ORDER BY wali_kelas.id_wali_kelas DESC";

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
                                                        echo "<td class='text-center'>" . $row['nama_guru'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nip_guru'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['jenis_kelamin_guru'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nomor_telepon_guru'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['nama_kelas'] . "</td>";
                                                        echo "<td class='text-center'><p class='button-like text-white'>" . $row['username'] . "</p></td>";
                                                        echo "<td class='text-center'><p class='button-like text-white'>" . $row['password'] . "</p></td>";
                                                        echo "<td class='text-center'>" . $row['jenjang_guru'] . "</td>";
                                                        echo "<td class='text-center'>" . $row['alamat_guru'] . "</td>";
                                                        echo "<td class='text-center'>
                                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                        \"" . $row['id_wali_kelas'] . "\",
                                                                        \"" . $row['id_guru'] . "\",
                                                                        \"" . $row['id_kelas'] . "\",
                                                                        \"" . $row['username'] . "\",
                                                                        \"" . $row['password'] . "\"
                                                                    )'>Edit</button>
                                                                </td>";
                                                        echo "<td class='text-center'>
                                                                    <button class='btn btn-danger btn-sm' onclick='hapus(\"" . $row['id_wali_kelas'] . "\")'>Hapus</button>
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