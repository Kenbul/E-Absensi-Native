<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-info my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="index.php?page=dashboard" target="_blank">
            <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">E-Absensi</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white" href="index.php?page=dashboard">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <?php if ($_SESSION['role'] == 'Admin') : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" id="masterDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Manajemen Data</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
                        <li><a class="dropdown-item" href="index.php?page=guru">
                                <i class="fa-solid fa-user-graduate fa-lg"></i>
                                <span class="nav-link-text ms-1">Guru</span></a>
                        </li>
                        <li><a class="dropdown-item" href="index.php?page=siswa">
                                <i class="fa-solid fa-users fa-lg"></i>
                                <span class="nav-link-text ms-1">Siswa</span></a>
                        </li>
                        <li><a class="dropdown-item" href="index.php?page=mapel">
                                <i class="fa-solid fa-file-lines fa-lg"></i>
                                <span class="nav-link-text ms-1">Mapel</span></a>
                        </li>
                        <li><a class="dropdown-item" href="index.php?page=kelas">
                                <i class="fa-solid fa-landmark fa-lg"></i>
                                <span class="nav-link-text ms-1">Kelas</span></a>
                        </li>
                        <li><a class="dropdown-item" href="index.php?page=jadwal-mengajar">
                                <i class="fa-solid fa-calendar-days fa-lg"></i>
                                <span class="nav-link-text ms-1">Jadwal-Mengajar</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php?page=laporan">
                        <i class="fa-solid fa-file-export"></i>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] == 'Guru') : ?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php?page=absensi">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Absensi</span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- <li class="nav-item">
                <a class="nav-link text-dark" href="pages/virtual-reality.html">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Virtual Reality</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="pages/rtl.html">
                    <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="pages/notifications.html">
                    <i class="material-symbols-rounded opacity-5">notifications</i>
                    <span class="nav-link-text ms-1">Notifications</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="pages/profile.html">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="pages/sign-in.html">
                    <i class="material-symbols-rounded opacity-5">login</i>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="pages/sign-up.html">
                    <i class="material-symbols-rounded opacity-5">assignment</i>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li> -->
        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">