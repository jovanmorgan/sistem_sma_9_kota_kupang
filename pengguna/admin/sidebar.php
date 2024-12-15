<?php
function setActiveClass($page, $jenjang = '')
{
    $current_page = basename($_SERVER['REQUEST_URI'], ".php");
    $current_jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

    if ($jenjang) {
        return ($current_page == $page && $current_jenjang == $jenjang) ? 'class="active"' : '';
    } else {
        return $current_page == $page ? 'class="active"' : '';
    }
}

function isMenuItemActive($page)
{
    $current_page = basename($_SERVER['REQUEST_URI'], ".php");
    $current_jenjang = isset($_GET['jenjang']) ? $_GET['jenjang'] : '';

    return $current_page == $page && $current_jenjang ? 'class="active"' : '';
}
?>

<div class="sidebar">
    <div class="sidebar-wrapper badge-info">
        <div class="logo">
            <a href="javascript:void(0)" class="simple-text logo-mini">
                <img src="../../img/logo.png" width="50px" alt="" style="position: relative; bottom: 3px;">
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal position-relative" style="font-size: 14px; font-weight: bold; font-style: italic; right: 10px; color: #ffffff;">
                SLBN KOTA KUPANG
            </a>
        </div>
        <ul class="nav">
            <li <?= setActiveClass('admin') ?>>
                <a href="./admin">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="menu-item <?= isMenuItemActive('admin_data_guru') ? 'active' : '' ?>">
                <a onclick="toggleMenu(this)">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Guru</p>
                </a>
                <ul>
                    <li <?= setActiveClass('admin_data_guru', 'SD') ?>>
                        <a href="./admin_data_guru?jenjang=SD">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru SD</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('admin_data_guru', 'SMP') ?>>
                        <a href="./admin_data_guru?jenjang=SMP">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru SMP</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('admin_data_guru', 'SMA') ?>>
                        <a href="./admin_data_guru?jenjang=SMA">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru SMA</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item <?= isMenuItemActive('admin_data_walikelas') ? 'active' : '' ?>">
                <a onclick="toggleMenu(this)">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Wali Kelas</p>
                </a>
                <ul>
                    <li <?= setActiveClass('admin_data_walikelas', 'SD') ?>>
                        <a href="./admin_data_walikelas?jenjang=SD">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Wali Kelas SD</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('admin_data_walikelas', 'SMP') ?>>
                        <a href="./admin_data_walikelas?jenjang=SMP">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Wali Kelas SMP</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('admin_data_walikelas', 'SMA') ?>>
                        <a href="./admin_data_walikelas?jenjang=SMA">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Wali Kelas SMA</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li <?= setActiveClass('admin_data_kepala_sekolah') ?>>
                <a href="./admin_data_kepala_sekolah">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Kepala Sekolah</p>
                </a>
            </li>
            <li class="menu-item <?= isMenuItemActive('admin_data_siswa') ? 'active' : '' ?>">
                <a onclick="toggleMenu(this)">
                    <i class="tim-icons icon-badge"></i>
                    <p>Siswa</p>
                </a>
                <ul>
                    <li <?= setActiveClass('admin_data_siswa', 'SD') ?>>
                        <a href="./admin_data_siswa?jenjang=SD">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa SD</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('admin_data_siswa', 'SMP') ?>>
                        <a href="./admin_data_siswa?jenjang=SMP">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa SMP</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('admin_data_siswa', 'SMA') ?>>
                        <a href="./admin_data_siswa?jenjang=SMA">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa SMA</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li <?= setActiveClass('admin_data_kelas') ?>>
                <a href="./admin_data_kelas">
                    <i class="tim-icons icon-components"></i>
                    <p>Kelas</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_absensi') ?>>
                <a href="./admin_data_absensi">
                    <i class="tim-icons icon-calendar-60"></i>
                    <p>Absensi</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_kebutuhan_khusus') ?>>
                <a href="./admin_data_kebutuhan_khusus">
                    <i class="tim-icons icon-heart-2"></i>
                    <p>Kebutuhan Khusus</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_tahun_ajar') ?>>
                <a href="./admin_data_tahun_ajar">
                    <i class="fas fa-calendar-alt"></i>
                    <p>Tahun Ajar</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_mapel') ?>>
                <a href="./admin_data_mapel">
                    <i class="tim-icons icon-book-bookmark"></i>
                    <p>Mapel</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_jadwa_kbm') ?>>
                <a href="./admin_data_jadwa_kbm">
                    <i class="tim-icons icon-calendar-60"></i>
                    <p>Jadwal KBM</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_berita') ?>>
                <a href="./admin_data_berita">
                    <i class="tim-icons icon-volume-98"></i>
                    <p>Berita</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_nilai') ?>>
                <a href="./admin_data_nilai">
                    <i class="tim-icons icon-atom"></i>
                    <p>Nilai</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_kepribadian') ?>>
                <a href="./admin_data_kepribadian">
                    <i class="fa fa-user-circle"></i>
                    <p>Kepribadian</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_keterangan') ?>>
                <a href="./admin_data_keterangan">
                    <i class="fa fa-info-circle"></i>
                    <p>Keterangan</p>
                </a>
            </li>
            <li <?= setActiveClass('admin_data_repot') ?>>
                <a href="./admin_data_repot">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>Raport siswa</p>
                </a>
            </li>
            <li style="opacity: 0;">
                <a href="./admin_data_repot">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>Raport siswa</p>
                </a>
            </li>
            <br>
            <br>
        </ul>
    </div>
</div>

<script>
    function toggleMenu(element) {
        element.parentElement.classList.toggle("active");
    }
</script>