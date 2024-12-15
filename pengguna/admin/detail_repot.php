<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login");
    exit;
}

// Lakukan koneksi ke database
include '../../koneksi.php';

// Ambil data dari URL menggunakan metode GET
$id_siswa = isset($_GET['id_siswa']) ? $_GET['id_siswa'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';
$semester = isset($_GET['semester']) ? strtoupper($_GET['semester']) : '';
$id_tahun_ajar = isset($_GET['id_tahun_ajar']) ? $_GET['id_tahun_ajar'] : '';

// Query untuk mendapatkan informasi siswa dan kelas
$query_siswa = "SELECT siswa.*, kelas.kelas, tahun_ajar.tahun_ajar_awal, tahun_ajar.tahun_ajar_akhir
                FROM siswa
                INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                INNER JOIN tahun_ajar ON siswa.id_tahun_ajar = tahun_ajar.id_tahun_ajar
                WHERE siswa.id_siswa = '$id_siswa'";
$result_siswa = mysqli_query($koneksi, $query_siswa);
$siswa = mysqli_fetch_assoc($result_siswa);

// Format tahun ajaran
$query_tahun_ajar = "SELECT tahun_ajar_awal, tahun_ajar_akhir FROM tahun_ajar WHERE id_tahun_ajar = '$id_tahun_ajar'";
$result_tahun_ajar = mysqli_query($koneksi, $query_tahun_ajar);
$data_tahun_ajar = mysqli_fetch_assoc($result_tahun_ajar);
$tahun_ajar = $data_tahun_ajar['tahun_ajar_awal'] . '/' . $data_tahun_ajar['tahun_ajar_akhir'];

// Fungsi untuk menghitung jumlah kehadiran
function hitungKehadiran($koneksi, $id_siswa, $jenis_kehadiran)
{
    $query = "SELECT $jenis_kehadiran FROM absensi2";
    $result = mysqli_query($koneksi, $query);

    $jumlah = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $kehadiran_list = explode(',', $row[$jenis_kehadiran]);
        if (in_array($id_siswa, $kehadiran_list)) {
            $jumlah++;
        }
    }

    return $jumlah;
}

$hadir = hitungKehadiran($koneksi, $id_siswa, 'hadir');
$sakit = hitungKehadiran($koneksi, $id_siswa, 'sakit');
$ijin = hitungKehadiran($koneksi, $id_siswa, 'ijin');
$alpa = hitungKehadiran($koneksi, $id_siswa, 'alpa');
$jumlah = $hadir + $sakit + $ijin + $alpa;

// Query untuk mendapatkan data kepribadian
$query_kepribadian = "SELECT kerajinan, kerapian, keterampilan 
                      FROM kepribadian 
                      WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar' AND semester = '$semester'";
$result_kepribadian = mysqli_query($koneksi, $query_kepribadian);
$kepribadian = mysqli_fetch_assoc($result_kepribadian);

// Jika tidak ada data kepribadian, set nilai default ke '0 (D)'
if (!$kepribadian) {
    $kepribadian = array(
        'kerajinan' => '0 (D)',
        'keterampilan' => '0 (D)',
        'kerapian' => '0 (D)'
    );
}

// Query untuk mendapatkan data wali kelas
$query_wali_kelas = "SELECT guru.nama, guru.nip
                     FROM wali_kelas
                     INNER JOIN guru ON wali_kelas.id_guru = guru.id_guru
                     WHERE wali_kelas.id_kelas = '$id_kelas'";
$result_wali_kelas = mysqli_query($koneksi, $query_wali_kelas);
$wali_kelas = mysqli_fetch_assoc($result_wali_kelas);

// Jika tidak ada data wali kelas, inisialisasi dengan nilai default
if (!$wali_kelas) {
    $wali_kelas = array(
        'nama' => 'Nama Tidak Tersedia',
        'nip' => 'NIP Tidak Tersedia'
    );
}

// Fungsi untuk mengambil rata-rata nilai dan predikat
function getNilaiRataRata($koneksi, $id_siswa, $id_mapel, $id_tahun_ajar)
{
    $query_nilai = "SELECT nilai_pengetahuan, nilai_ketrampilan
                    FROM nilai
                    WHERE id_siswa = '$id_siswa' AND id_mapel = '$id_mapel' AND id_tahun_ajar = '$id_tahun_ajar'";
    $result_nilai = mysqli_query($koneksi, $query_nilai);

    $total_pengetahuan = 0;
    $total_ketrampilan = 0;
    $count = 0;

    while ($nilai = mysqli_fetch_assoc($result_nilai)) {
        $total_pengetahuan += $nilai['nilai_pengetahuan'];
        $total_ketrampilan += $nilai['nilai_ketrampilan'];
        $count++;
    }

    $rata_pengetahuan = $count > 0 ? $total_pengetahuan / $count : 0;
    $rata_ketrampilan = $count > 0 ? $total_ketrampilan / $count : 0;

    return [$rata_pengetahuan, $rata_ketrampilan];
}

function getPredikat($nilai)
{
    if ($nilai >= 85) {
        return 'A';
    } elseif ($nilai >= 75) {
        return 'B';
    } elseif ($nilai >= 60) {
        return 'C';
    } else {
        return 'D';
    }
}

// Ambil nilai dan predikat untuk mapel dengan id_mapel 15 hingga 25
list($rata_pengetahuan_15, $rata_ketrampilan_15) = getNilaiRataRata($koneksi, $id_siswa, 15, $id_tahun_ajar);
$predikat_pengetahuan_15 = getPredikat($rata_pengetahuan_15);
$predikat_ketrampilan_15 = getPredikat($rata_ketrampilan_15);

list($rata_pengetahuan_16, $rata_ketrampilan_16) = getNilaiRataRata($koneksi, $id_siswa, 16, $id_tahun_ajar);
$predikat_pengetahuan_16 = getPredikat($rata_pengetahuan_16);
$predikat_ketrampilan_16 = getPredikat($rata_ketrampilan_16);

list($rata_pengetahuan_17, $rata_ketrampilan_17) = getNilaiRataRata($koneksi, $id_siswa, 17, $id_tahun_ajar);
$predikat_pengetahuan_17 = getPredikat($rata_pengetahuan_17);
$predikat_ketrampilan_17 = getPredikat($rata_ketrampilan_17);

list($rata_pengetahuan_18, $rata_ketrampilan_18) = getNilaiRataRata($koneksi, $id_siswa, 18, $id_tahun_ajar);
$predikat_pengetahuan_18 = getPredikat($rata_pengetahuan_18);
$predikat_ketrampilan_18 = getPredikat($rata_ketrampilan_18);

list($rata_pengetahuan_19, $rata_ketrampilan_19) = getNilaiRataRata($koneksi, $id_siswa, 19, $id_tahun_ajar);
$predikat_pengetahuan_19 = getPredikat($rata_pengetahuan_19);
$predikat_ketrampilan_19 = getPredikat($rata_ketrampilan_19);

list($rata_pengetahuan_20, $rata_ketrampilan_20) = getNilaiRataRata($koneksi, $id_siswa, 20, $id_tahun_ajar);
$predikat_pengetahuan_20 = getPredikat($rata_pengetahuan_20);
$predikat_ketrampilan_20 = getPredikat($rata_ketrampilan_20);

list($rata_pengetahuan_21, $rata_ketrampilan_21) = getNilaiRataRata($koneksi, $id_siswa, 21, $id_tahun_ajar);
$predikat_pengetahuan_21 = getPredikat($rata_pengetahuan_21);
$predikat_ketrampilan_21 = getPredikat($rata_ketrampilan_21);

list($rata_pengetahuan_22, $rata_ketrampilan_22) = getNilaiRataRata($koneksi, $id_siswa, 22, $id_tahun_ajar);
$predikat_pengetahuan_22 = getPredikat($rata_pengetahuan_22);
$predikat_ketrampilan_22 = getPredikat($rata_ketrampilan_22);

list($rata_pengetahuan_23, $rata_ketrampilan_23) = getNilaiRataRata($koneksi, $id_siswa, 23, $id_tahun_ajar);
$predikat_pengetahuan_23 = getPredikat($rata_pengetahuan_23);
$predikat_ketrampilan_23 = getPredikat($rata_ketrampilan_23);

list($rata_pengetahuan_24, $rata_ketrampilan_24) = getNilaiRataRata($koneksi, $id_siswa, 24, $id_tahun_ajar);
$predikat_pengetahuan_24 = getPredikat($rata_pengetahuan_24);
$predikat_ketrampilan_24 = getPredikat($rata_ketrampilan_24);

list($rata_pengetahuan_25, $rata_ketrampilan_25) = getNilaiRataRata($koneksi, $id_siswa, 25, $id_tahun_ajar);
$predikat_pengetahuan_25 = getPredikat($rata_pengetahuan_25);
$predikat_ketrampilan_25 = getPredikat($rata_ketrampilan_25);

// Ambil semua nilai pengetahuan dan ketrampilan dari tabel nilai untuk id_siswa dan id_tahun_ajar
$query_all_nilai = "SELECT nilai_pengetahuan, nilai_ketrampilan
                    FROM nilai
                    WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar'";
$result_all_nilai = mysqli_query($koneksi, $query_all_nilai);

$total_all_pengetahuan = 0;
$total_all_ketrampilan = 0;
$count_all = 0;

while ($nilai_all = mysqli_fetch_assoc($result_all_nilai)) {
    $total_all_pengetahuan += $nilai_all['nilai_pengetahuan'];
    $total_all_ketrampilan += $nilai_all['nilai_ketrampilan'];
    $count_all++;
}

$jumlah_rata_pengetahuan = $total_all_pengetahuan;
$jumlah_rata_ketrampilan = $total_all_ketrampilan;

// Query untuk mendapatkan data keterangan
$query_keterangan = "SELECT keterangan FROM keterangan 
                      WHERE id_siswa = '$id_siswa' AND id_tahun_ajar = '$id_tahun_ajar' AND semester = '$semester'";
$result_keterangan = mysqli_query($koneksi, $query_keterangan);

// Ambil data keterangan atau set ke default jika tidak ada
$keterangan = mysqli_fetch_assoc($result_keterangan);
$keterangan_text = isset($keterangan['keterangan']) ? $keterangan['keterangan'] : 'Keterangan tidak tersedia.';


// Buat PDF dengan FPDF
require ('../../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Hanya tampilkan header di halaman pertama
        if ($this->PageNo() == 1) {
            // Logo
            $this->Image('../../img/logo.png', 10, 8, 20); // Ganti 'path/to/logo.png' dengan path yang benar

            // Font Times New Roman bold 16 untuk nama sekolah
            $this->SetFont('Times', 'B', 14);
            $this->Cell(0, 3, 'PEMERINTAH KOTA KUPANG', 0, 1, 'C'); // Nama sekolah
            $this->Cell(0, 9, 'DINAS PENDIDIKAN DAN KEBUDAYAAN', 0, 1, 'C'); // Nama sekolah
            $this->Cell(0, 3, 'SEKOLAH LUAR BIASA SLB NEGERI KOTA KUPANG', 0, 1, 'C'); // Nama sekolah
            $this->SetFont('Times', '', 12);
            $this->Cell(0, 12, 'Jln. Timor Raya no. 17-18 / Kelurahan Kelapa Lima / Kecamatan Kelapa Lima', 0, 1, 'C'); // Nama sekolah

            // Garis di bawah informasi siswa
            $this->SetDrawColor(0, 0, 0);
            $this->SetLineWidth(0.5);
            $this->Line(1, $this->GetY() + 1, 200, $this->GetY() + 1); // Ubah koordinat dan panjang garis sesuai kebutuhan

            // Pindah ke baris baru untuk konten setelah header
            $this->Ln(15);
        }
    }

    function Footer()
    {
        // Posisi 1,5 cm dari bawah
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Nomor halaman
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Buat objek PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12); // Times New Roman regular 12

// Menampilkan nama siswa dan Semester
$pdf->Cell(40, -12, 'Nama', 0, 0);
$pdf->Cell(5, -12, ':', 0, 0);
$pdf->Cell(75, -12, htmlspecialchars($siswa['nama'], ENT_QUOTES), 0, 0); // Lebar 75 untuk nama siswa
$pdf->Cell(20, -12, 'Semester              :', 0, 0);
$pdf->Cell(15, -12, '', 0, 0);
$pdf->Cell(0, -12, $semester, 0, 1);
$pdf->SetXY(10, $pdf->GetY() + 10);

// Menampilkan kelas siswa dan Tahun Ajaran
$pdf->Cell(40, 5, 'Kelas', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(75, 5, htmlspecialchars($siswa['kelas'], ENT_QUOTES), 0, 0); // Lebar 75 untuk kelas siswa
$pdf->Cell(20, 5, 'Tahun Ajaran       :', 0, 0);
$pdf->Cell(15, 5, '', 0, 0);
$pdf->Cell(0, 5, $tahun_ajar, 0, 1);
$pdf->SetFont('Times', '', 10); // Times New Roman regular 12

// bagian table
$pdf->SetLineWidth(0.5); // Ketebalan garis 0.5 mm
$pdf->Line(10, $pdf->GetY() - -5, 10, $pdf->GetY() + 206);// kiri
$pdf->Line(200, $pdf->GetY() - -5, 200, $pdf->GetY() + 206);// kanan

$pdf->Line(10, $pdf->GetY() + 30, 200, $pdf->GetY() + 30);//bawa
$pdf->Line(10, $pdf->GetY() + 5, 200, $pdf->GetY() + 5);//atas

// garis pemisa vertikal
$pdf->Line(20, $pdf->GetY() - -5, 20, $pdf->GetY() + 30);
$pdf->Line(58, $pdf->GetY() - -5, 58, $pdf->GetY() + 30);
$pdf->Line(73, $pdf->GetY() - -5, 73, $pdf->GetY() + 30);

// garis pemisa vertikal 2
$pdf->Line(105, $pdf->GetY() - -22, 105, $pdf->GetY() + 30);
$pdf->Line(135, $pdf->GetY() - -13, 135, $pdf->GetY() + 30);
$pdf->Line(168, $pdf->GetY() - -22, 168, $pdf->GetY() + 30);

// bagian 2
// garis pemisa vertikal 1
$pdf->Line(20, $pdf->GetY() - -38, 20, $pdf->GetY() + 86);
$pdf->Line(58, $pdf->GetY() - -38, 58, $pdf->GetY() + 86);
$pdf->Line(73, $pdf->GetY() - -38, 73, $pdf->GetY() + 86);

// garis pemisa vertikal 2
$pdf->Line(105, $pdf->GetY() - -38, 105, $pdf->GetY() + 86);
$pdf->Line(135, $pdf->GetY() - -38, 135, $pdf->GetY() + 86);
$pdf->Line(168, $pdf->GetY() - -38, 168, $pdf->GetY() + 86);

// bagian 3
// garis pemisa vertikal 1
$pdf->Line(20, $pdf->GetY() - -94, 20, $pdf->GetY() + 110);
$pdf->Line(58, $pdf->GetY() - -94, 58, $pdf->GetY() + 110);
$pdf->Line(73, $pdf->GetY() - -94, 73, $pdf->GetY() + 110);

// garis pemisa vertikal 2
$pdf->Line(105, $pdf->GetY() - -94, 105, $pdf->GetY() + 110);
$pdf->Line(135, $pdf->GetY() - -94, 135, $pdf->GetY() + 110);
$pdf->Line(168, $pdf->GetY() - -94, 168, $pdf->GetY() + 110);

// bagian 4
// garis pemisa vertikal 1
$pdf->Line(20, $pdf->GetY() - -118, 20, $pdf->GetY() + 142);
$pdf->Line(58, $pdf->GetY() - -118, 58, $pdf->GetY() + 142);
$pdf->Line(73, $pdf->GetY() - -118, 73, $pdf->GetY() + 150);

// garis pemisa vertikal 2
$pdf->Line(105, $pdf->GetY() - -118, 105, $pdf->GetY() + 142);
$pdf->Line(135, $pdf->GetY() - -118, 135, $pdf->GetY() + 150);
$pdf->Line(168, $pdf->GetY() - -118, 168, $pdf->GetY() + 142);

// bagian 5
// garis pemisa vertikal 1
$pdf->Line(20, $pdf->GetY() - -118, 20, $pdf->GetY() + 142);
$pdf->Line(58, $pdf->GetY() - -118, 58, $pdf->GetY() + 142);
$pdf->Line(73, $pdf->GetY() - -118, 73, $pdf->GetY() + 150);

// garis pemisa vertikal 2
$pdf->Line(105, $pdf->GetY() - -118, 105, $pdf->GetY() + 142);
$pdf->Line(135, $pdf->GetY() - -118, 135, $pdf->GetY() + 150);
$pdf->Line(168, $pdf->GetY() - -118, 168, $pdf->GetY() + 142);

// bagian 5
// garis pemisa vertikal 1
$pdf->Line(20, $pdf->GetY() - -158, 20, $pdf->GetY() + 190);
$pdf->Line(73, $pdf->GetY() - -158, 73, $pdf->GetY() + 198);

// garis pemisa vertikal 2
$pdf->Line(105, $pdf->GetY() - -158, 105, $pdf->GetY() + 198);
$pdf->Line(135, $pdf->GetY() - -158, 135, $pdf->GetY() + 182);
$pdf->Line(168, $pdf->GetY() - -158, 168, $pdf->GetY() + 182);

// garis pemisa horisontal
$pdf->Line(73, $pdf->GetY() + 13, 200, $pdf->GetY() + 13);//atas
$pdf->Line(73, $pdf->GetY() + 22, 200, $pdf->GetY() + 22);//atas

$pdf->SetLineWidth(0); // Ketebalan garis 0.5 untuk kotak (pilihan)
$pdf->SetXY(10, $pdf->GetY() + 13);
$pdf->Cell(10, 10, 'NO', 0, 0, 'C');

$pdf->SetXY(34, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'MATA PELAJARAN', 0, 0, 'C');

$pdf->SetXY(60, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'KKM', 0, 0, 'C');

$pdf->SetXY(60, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'KKM', 0, 0, 'C');

$pdf->SetXY(130, $pdf->GetY() + -9);
$pdf->Cell(10, 10, 'NILAI', 0, 0, 'C');

$pdf->SetXY(100, $pdf->GetY() + 9);
$pdf->Cell(10, 10, 'PENGETAHUAN', 0, 0, 'C');

$pdf->SetXY(160, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'KETRAMPILAN', 0, 0, 'C');

$pdf->SetXY(83, $pdf->GetY() + 8);
$pdf->Cell(10, 10, 'ANGKA', 0, 0, 'C');

$pdf->SetXY(115, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'PREDIKAT', 0, 0, 'C');

$pdf->SetXY(145, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'ANGKA', 0, 0, 'C');

$pdf->SetXY(179, $pdf->GetY() + 0);
$pdf->Cell(10, 10, 'PREDIKAT', 0, 0, 'C');

// KELOMPOK A (WAJIB)
$pdf->SetXY(25, $pdf->GetY() + 0);
$pdf->Cell(10, 27, 'KELOMPOK A (WAJIB)', 0, 0, 'C');

// id_mapel = 15 untuk PKN
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 43, '1', 0, 0, 'C');
$pdf->Cell(35, 43, 'PKN', 0, 0, 'C');
$pdf->Cell(20, 43, '75', 0, 0, 'C');

// nilai_pengetahuan 
$pdf->Cell(25, 43, number_format($rata_pengetahuan_15, 2), 0, 0, 'C');

// predikat nilai_pengetahuan 
$pdf->Cell(38, 43, $predikat_pengetahuan_15, 0, 0, 'C');

// nilai_ketrampilan 
$pdf->Cell(25, 43, number_format($rata_ketrampilan_15, 2), 0, 0, 'C');

// predikat nilai_ketrampilan 
$pdf->Cell(41, 43, $predikat_ketrampilan_15, 0, 0, 'C');

// id_mapel = 16
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 58, '2', 0, 0, 'C');
$pdf->Cell(35, 58, 'Bahasa Indonesia', 0, 0, 'C');
$pdf->Cell(20, 58, '75', 0, 0, 'C');
$pdf->Cell(25, 58, number_format($rata_pengetahuan_16, 2), 0, 0, 'C');
$pdf->Cell(38, 58, $predikat_pengetahuan_16, 0, 0, 'C');
$pdf->Cell(25, 58, number_format($rata_ketrampilan_16, 2), 0, 0, 'C');
$pdf->Cell(41, 58, $predikat_ketrampilan_16, 0, 0, 'C');

// id_mapel = 17
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 74, '3', 0, 0, 'C');
$pdf->Cell(35, 74, 'Matematika', 0, 0, 'C');
$pdf->Cell(20, 74, '75', 0, 0, 'C');
$pdf->Cell(25, 74, number_format($rata_pengetahuan_17, 2), 0, 0, 'C');
$pdf->Cell(38, 74, $predikat_pengetahuan_17, 0, 0, 'C');
$pdf->Cell(25, 74, number_format($rata_ketrampilan_17, 2), 0, 0, 'C');
$pdf->Cell(41, 74, $predikat_ketrampilan_17, 0, 0, 'C');

// id_mapel = 18
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 90, '4', 0, 0, 'C');
$pdf->Cell(35, 90, 'IPS', 0, 0, 'C');
$pdf->Cell(20, 90, '75', 0, 0, 'C');
$pdf->Cell(25, 90, number_format($rata_pengetahuan_18, 2), 0, 0, 'C');
$pdf->Cell(38, 90, $predikat_pengetahuan_18, 0, 0, 'C');
$pdf->Cell(25, 90, number_format($rata_ketrampilan_18, 2), 0, 0, 'C');
$pdf->Cell(41, 90, $predikat_ketrampilan_18, 0, 0, 'C');

// id_mapel = 19
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 106, '5', 0, 0, 'C');
$pdf->Cell(35, 106, 'IPA', 0, 0, 'C');
$pdf->Cell(20, 106, '75', 0, 0, 'C');
$pdf->Cell(25, 106, number_format($rata_pengetahuan_19, 2), 0, 0, 'C');
$pdf->Cell(38, 106, $predikat_pengetahuan_19, 0, 0, 'C');
$pdf->Cell(25, 106, number_format($rata_ketrampilan_19, 2), 0, 0, 'C');
$pdf->Cell(41, 106, $predikat_ketrampilan_19, 0, 0, 'C');

// id_mapel = 20
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 122, '6', 0, 0, 'C');
$pdf->Cell(35, 122, 'Bahasa Inggris', 0, 0, 'C');
$pdf->Cell(20, 122, '75', 0, 0, 'C');
$pdf->Cell(25, 122, number_format($rata_pengetahuan_20, 2), 0, 0, 'C');
$pdf->Cell(38, 122, $predikat_pengetahuan_20, 0, 0, 'C');
$pdf->Cell(25, 122, number_format($rata_ketrampilan_20, 2), 0, 0, 'C');
$pdf->Cell(41, 122, $predikat_ketrampilan_20, 0, 0, 'C');

// KELOMPOK B (WAJIB)
$pdf->SetXY(25, $pdf->GetY() + 0);
$pdf->Cell(10, 138, 'KELOMPOK B (WAJIB)', 0, 0, 'C');

// id_mapel = 21
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 154, '7', 0, 0, 'C');
$pdf->Cell(35, 154, 'SBP', 0, 0, 'C');
$pdf->Cell(20, 154, '70', 0, 0, 'C');
$pdf->Cell(25, 154, number_format($rata_pengetahuan_21, 2), 0, 0, 'C');
$pdf->Cell(38, 154, $predikat_pengetahuan_21, 0, 0, 'C');
$pdf->Cell(25, 154, number_format($rata_ketrampilan_21, 2), 0, 0, 'C');
$pdf->Cell(41, 154, $predikat_ketrampilan_21, 0, 0, 'C');

// id_mapel = 22
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, 170, '8', 0, 0, 'C');
$pdf->Cell(35, 170, 'Penjas', 0, 0, 'C');
$pdf->Cell(20, 170, '70', 0, 0, 'C');
$pdf->Cell(25, 170, number_format($rata_pengetahuan_22, 2), 0, 0, 'C');
$pdf->Cell(38, 170, $predikat_pengetahuan_22, 0, 0, 'C');
$pdf->Cell(25, 170, number_format($rata_ketrampilan_22, 2), 0, 0, 'C');
$pdf->Cell(41, 170, $predikat_ketrampilan_22, 0, 0, 'C');

// KELOMPOK C (PILIHAN KEMANDIRIAN )
$pdf->SetXY(25, $pdf->GetY() + 0);
$pdf->Cell(40, 186, 'KELOMPOK C (PILIHAN KEMANDIRIAN )', 0, 0, 'C');


$pdf->SetLineWidth(0.5); // Ketebalan garis 0.5 mm
// bawa bagian 
$pdf->Line(10, $pdf->GetY() + 17, 200, $pdf->GetY() + 17);
$pdf->Line(10, $pdf->GetY() + 25, 200, $pdf->GetY() + 25);
$pdf->Line(10, $pdf->GetY() + 33, 200, $pdf->GetY() + 33);
$pdf->Line(10, $pdf->GetY() + 41, 200, $pdf->GetY() + 41);
$pdf->Line(10, $pdf->GetY() + 49, 200, $pdf->GetY() + 49);
$pdf->Line(10, $pdf->GetY() + 57, 200, $pdf->GetY() + 57);
$pdf->Line(10, $pdf->GetY() + 65, 200, $pdf->GetY() + 65);
$pdf->Line(10, $pdf->GetY() + 73, 200, $pdf->GetY() + 73);
$pdf->Line(10, $pdf->GetY() + 81, 200, $pdf->GetY() + 81);
$pdf->Line(10, $pdf->GetY() + 89, 200, $pdf->GetY() + 89);
$pdf->Line(10, $pdf->GetY() + 97, 200, $pdf->GetY() + 97);
$pdf->Line(10, $pdf->GetY() + 105, 200, $pdf->GetY() + 105);
$pdf->Line(10, $pdf->GetY() + 113, 200, $pdf->GetY() + 113);
$pdf->Line(10, $pdf->GetY() + 121, 200, $pdf->GetY() + 121);
$pdf->Line(10, $pdf->GetY() + 129, 200, $pdf->GetY() + 129);
$pdf->Line(10, $pdf->GetY() + 137, 200, $pdf->GetY() + 137);
$pdf->Line(10, $pdf->GetY() + 145, 200, $pdf->GetY() + 145);
$pdf->Line(10, $pdf->GetY() + 153, 200, $pdf->GetY() + 153);
$pdf->Line(10, $pdf->GetY() + 161, 200, $pdf->GetY() + 161);
$pdf->Line(10, $pdf->GetY() + 169, 200, $pdf->GetY() + 169);
$pdf->Line(10, $pdf->GetY() + 177, 200, $pdf->GetY() + 177);
$pdf->Line(10, $pdf->GetY() + 185, 200, $pdf->GetY() + 185);

// JUMLAH
$pdf->SetXY(25, $pdf->GetY() + 125);
$pdf->Cell(40, 1, 'JUMLAH', 0, 0, 'C');

// Jumlah Untuk Seluruh nilai Rata-Rata dari nilai_pengetahuan
$pdf->Cell(80, 1, $jumlah_rata_pengetahuan, 0, 0, 'C');

// Jumlah Untuk Seluruh nilai Rata-Rata dari nilai_ketrampilan
$pdf->Cell(45, 1, $jumlah_rata_ketrampilan, 0, 0, 'C');

// SAKIT
$pdf->SetXY(8, $pdf->GetY() + 16);
$pdf->Cell(13, 1, '1', 0, 0, 'C');
$pdf->Cell(13, 1, 'SAKIT', 0, 0, 'C');
$pdf->Cell(94, 1, "$sakit Hari ", 0, 0, 'C');

// IJIN
$pdf->SetXY(6, $pdf->GetY() + 8);
$pdf->Cell(17, 1, '2', 0, 0, 'C');
$pdf->Cell(5, 1, 'IJIN', 0, 0, 'C');
$pdf->Cell(106, 1, "$ijin Hari ", 0, 0, 'C');

// ALPA
$pdf->SetXY(7, $pdf->GetY() + 8);
$pdf->Cell(15, 1, '3', 0, 0, 'C');
$pdf->Cell(10, 1, 'ALPA', 0, 0, 'C');
$pdf->Cell(98, 1, "$alpa Hari ", 0, 0, 'C');

// HADIR
$pdf->SetXY(25, $pdf->GetY() + 8);
$pdf->Cell(-21, 1, '4', 0, 0, 'C');
$pdf->Cell(48, 1, 'HADIR', 0, 0, 'C');
$pdf->Cell(58, 1, "$hadir Hari ", 0, 0, 'C');


// Kepribadian
$pdf->SetXY(115, $pdf->GetY() + -24);
$pdf->Cell(10, 1, '1', 0, 0, 'C');
$pdf->Cell(53, 1, 'Kerajinan', 0, 0, 'C');
$pdf->Cell(15, 1, $kepribadian['kerajinan'], 0, 0, 'C');

$pdf->SetXY(115, $pdf->GetY() + 8);
$pdf->Cell(10, 1, '2', 0, 0, 'C');
$pdf->Cell(53, 1, 'Keterampilan', 0, 0, 'C');
$pdf->Cell(15, 1, $kepribadian['keterampilan'], 0, 0, 'C');

$pdf->SetXY(115, $pdf->GetY() + 8);
$pdf->Cell(10, 1, '3', 0, 0, 'C');
$pdf->Cell(53, 1, 'Kerapian', 0, 0, 'C');
$pdf->Cell(15, 1, $kepribadian['kerapian'], 0, 0, 'C');

// KELOMPOK C (PILIHAN KEMANDIRIAN )
$pdf->SetXY(10, $pdf->GetY() + 0);

// id_mapel = 23
$pdf->Cell(10, -112, '9', 0, 0, 'C');
$pdf->Cell(35, -112, 'Seni Musik', 0, 0, 'C');
$pdf->Cell(20, -112, '90', 0, 0, 'C');
$pdf->Cell(25, -112, number_format($rata_pengetahuan_23, 2), 0, 0, 'C');
$pdf->Cell(38, -112, $predikat_pengetahuan_23, 0, 0, 'C');
$pdf->Cell(25, -112, number_format($rata_ketrampilan_23, 2), 0, 0, 'C');
$pdf->Cell(41, -112, $predikat_ketrampilan_23, 0, 0, 'C');

// id_mapel = 24
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, -96, '10', 0, 0, 'C');
$pdf->Cell(35, -96, 'Budidaya Tanaman', 0, 0, 'C');
$pdf->Cell(20, -96, '90', 0, 0, 'C');
$pdf->Cell(25, -96, number_format($rata_pengetahuan_24, 2), 0, 0, 'C');
$pdf->Cell(38, -96, $predikat_pengetahuan_24, 0, 0, 'C');
$pdf->Cell(25, -96, number_format($rata_ketrampilan_24, 2), 0, 0, 'C');
$pdf->Cell(41, -96, $predikat_ketrampilan_24, 0, 0, 'C');

// id_mapel = 25
$pdf->SetXY(10, $pdf->GetY() + 0);
$pdf->Cell(10, -79, '11', 0, 0, 'C');
$pdf->Cell(35, -79, 'Komputer', 0, 0, 'C');
$pdf->Cell(20, -79, '70', 0, 0, 'C');
$pdf->Cell(25, -79, number_format($rata_pengetahuan_25, 2), 0, 0, 'C');
$pdf->Cell(38, -79, $predikat_pengetahuan_25, 0, 0, 'C');
$pdf->Cell(25, -79, number_format($rata_ketrampilan_25, 2), 0, 0, 'C');
$pdf->Cell(41, -79, $predikat_ketrampilan_25, 0, 0, 'C');


// JUMLAH
$pdf->SetXY(25, $pdf->GetY() + 16);
$pdf->Cell(-10, 1, 'JUMLAH', 0, 0, 'C');
$pdf->Cell(132, 1, "$jumlah Hari ", 0, 0, 'C');

// modifikasi dan isi keterangannya 
// KETERANGAN
$pdf->SetXY(28, $pdf->GetY() + 7);
$pdf->Cell(-1, 1, 'KETERANGAN : ', 0, 0, 'C');

$pdf->Cell(70, 1, $keterangan_text, 0, 0, 'C');

// Menambahkan Tanda Tangan
$pdf->Ln(140); // Jarak dari konten sebelumnya

// Tanda tangan Orang tua / Wali
$pdf->Cell(25, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->Cell(0, 5, 'Orang tua / Wali', 0, 0, 'L');
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY() + 20, 36, $pdf->GetY() + 20);

// Tanda tangan Wali Kelas di sebelah kanan
$pdf->SetY($pdf->GetY() - 5); // Kembali ke baris sebelumnya untuk mengatur posisi horizontal
$pdf->SetX(158); // Menyesuaikan posisi horizontal untuk Wali Kelas
$pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->SetX(170); // Menyesuaikan posisi horizontal untuk Wali Kelas
$pdf->Cell(0, 5, 'Wali Kelas', 0, 0, 'L');
$pdf->SetLineWidth(0.2);
$pdf->Line(165, $pdf->GetY() + 20, 195, $pdf->GetY() + 20);

// Menambahkan nama dan NIP di bawah garis tanda tangan wali kelas
$pdf->SetY(30); // Menyesuaikan posisi vertikal untuk nama dan NIP
$pdf->SetX(170); // Menyesuaikan posisi horizontal untuk nama dan NIP
$pdf->Cell(0, 5, $wali_kelas['nama'], 0, 1, 'L');
$pdf->SetX(167); // Menyesuaikan posisi horizontal untuk nama dan NIP
$pdf->Cell(0, 5, 'NIP: ' . $wali_kelas['nip'], 0, 1, 'L');

// Tutup koneksi ke database
mysqli_close($koneksi);

// Output PDF
$pdf->Output();
?>