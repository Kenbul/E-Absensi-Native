<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl show-sidebar" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!-- Tambahkan di dalam .navbar (sebelum breadcrumb) -->
        <button class="btn btn-success d-xl-none me-3" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $page ?></li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="index.php?page=logout" class="btn btn-outline-danger mt-2">
                        <i class="fa-solid fa-right-from-bracket"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid py-2">