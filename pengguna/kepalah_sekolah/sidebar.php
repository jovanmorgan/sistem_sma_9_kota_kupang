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
            <a href="javascript:void(0)" class="simple-text logo-normal position-relative"
                style="font-size: 14px; font-weight: bold; font-style: italic; right: 10px; color: #ffffff;">
                SLBN KOTA KUPANG
            </a>
        </div>
        <ul class="nav">
            <li <?= setActiveClass('kepalah_sekolah') ?>>
                <a href="./kepalah_sekolah">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="menu-item <?= isMenuItemActive('kepalah_sekolah_data_guru') ? 'active' : '' ?>">
                <a onclick="toggleMenu(this)">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Guru</p>
                </a>
                <ul>
                    <li <?= setActiveClass('kepalah_sekolah_data_guru', 'SD') ?>>
                        <a href="./kepalah_sekolah_data_guru?jenjang=SD">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru SD</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('kepalah_sekolah_data_guru', 'SMP') ?>>
                        <a href="./kepalah_sekolah_data_guru?jenjang=SMP">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru SMP</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('kepalah_sekolah_data_guru', 'SMA') ?>>
                        <a href="./kepalah_sekolah_data_guru?jenjang=SMA">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Guru SMA</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item <?= isMenuItemActive('kepalah_sekolah_data_siswa') ? 'active' : '' ?>">
                <a onclick="toggleMenu(this)">
                    <i class="tim-icons icon-badge"></i>
                    <p>Siswa</p>
                </a>
                <ul>
                    <li <?= setActiveClass('kepalah_sekolah_data_siswa', 'SD') ?>>
                        <a href="./kepalah_sekolah_data_siswa?jenjang=SD">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa SD</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('kepalah_sekolah_data_siswa', 'SMP') ?>>
                        <a href="./kepalah_sekolah_data_siswa?jenjang=SMP">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa SMP</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('kepalah_sekolah_data_siswa', 'SMA') ?>>
                        <a href="./kepalah_sekolah_data_siswa?jenjang=SMA">
                            <i class="tim-icons icon-badge"></i>
                            <p>Siswa SMA</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item <?= isMenuItemActive('kepalah_sekolah_data_walikelas') ? 'active' : '' ?>">
                <a onclick="toggleMenu(this)">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Wali Kelas</p>
                </a>
                <ul>
                    <li <?= setActiveClass('kepalah_sekolah_data_walikelas', 'SD') ?>>
                        <a href="./kepalah_sekolah_data_walikelas?jenjang=SD">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Wali Kelas SD</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('kepalah_sekolah_data_walikelas', 'SMP') ?>>
                        <a href="./kepalah_sekolah_data_walikelas?jenjang=SMP">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Wali Kelas SMP</p>
                        </a>
                    </li>
                    <li <?= setActiveClass('kepalah_sekolah_data_walikelas', 'SMA') ?>>
                        <a href="./kepalah_sekolah_data_walikelas?jenjang=SMA">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Wali Kelas SMA</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li <?= setActiveClass('kepalah_sekolah_data') ?>>
                <a href="./kepalah_sekolah_data">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Kepala Sekolah</p>
                </a>
            </li>
            <li style="opacity: 0;">
                <a href="./kepalah_sekolah_data_repot">
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