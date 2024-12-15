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
                                                    Nip
                                                </th>
                                                <th class="text-center">
                                                    Jenis Kelamin
                                                </th>
                                                <th class="text-center">
                                                    Wali Kelas
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
                                                    Alamat
                                                </th>
                                                <th class="text-center">
                                                    Foto
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
                                        include '../koneksi.php';

                                        // Query SQL untuk mengambil data dari tabel guru
                                        $query = "SELECT * FROM guru";
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
                                                echo "<td class='text-center'>" . $row['username'] . "</td>";
                                                echo "<td class='text-center'>" . $row['password'] . "</td>";
                                                echo "<td class='text-center'>" . $row['alamat'] . "</td>";
                                                echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_guru'] . "\",
                                                        \"" . $row['nama'] . "\",
                                                        \"" . $row['nip'] . "\",
                                                        \"" . $row['jenis_kelamin'] . "\",
                                                        \"" . $row['nomor_telepon'] . "\",
                                                        \"" . $row['username'] . "\",
                                                        \"" . $row['password'] . "\",
                                                        \"" . $row['alamat'] . "\",
                                                    )'>Edit</button>
                                                       </td>";
                                                        echo "<td class='text-center'>
                                                    <button class='btn btn-danger btn-sm' onclick='deleteGuru(\"" . $row['id_guru'] . "\")'>Hapus</button>
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