<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Halaman yang bisa diakses publik tanpa login
$PUBLIC_PAGES = [
    'login',
    'loginProcess',

];

// Map page => role yang diizinkan
$PROTECTED_ROUTES = [
    'dashboard'         => ['Admin', 'Guru', 'Kepala Madrasah'],
    'guru'              => ['Admin', 'Kepala Madrasah'],
    'siswa'             => ['Admin'],
    'mapel'             => ['Admin'],
    'kelas'             => ['Admin'],
    'semester'          => ['Admin'],
    'jadwal-mengajar'   => ['Admin', 'Guru'],
    'absensi'           => ['Guru'],
    'laporan'           => ['Admin', 'Kepala Madrasah'],
    'logout'            => ['Admin', 'Guru', 'Kepala Madrasah'],
    // tambah sesuai kebutuhan
];

// Cek apakah user sudah login
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}
function onlyAdmin()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
        header('Location: index.php?page=login');
        exit;
    }
}

// Ambil role user dari session
function getUserRole()
{
    return $_SESSION['role'] ?? null;
}

// Middleware utama
function protectRoute()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $currentPage = $_GET['page'] ?? 'login';

    // Daftar halaman publik (tidak perlu login)
    $publicPages = ['login', 'register', 'lupa-password'];

    // Jika halaman bukan halaman publik dan user belum login
    if (!in_array($currentPage, $publicPages) && !isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }
}
function handleAccess($page)
{
    global $PUBLIC_PAGES, $PROTECTED_ROUTES;

    if (isLoggedIn() && in_array($page, $PUBLIC_PAGES)) {
        header('Location: index.php?page=dashboard');
        exit;
    }


    // 1. Jika page public, lewati
    if (in_array($page, $PUBLIC_PAGES)) {
        return;
    }

    // 2. Jika belum login, redirect ke login
    if (!isLoggedIn()) {
        header('Location: index.php?page=login');
        exit;
    }

    // 3. Jika ada aturan role untuk page ini
    if (isset($PROTECTED_ROUTES[$page])) {
        $allowedRoles = $PROTECTED_ROUTES[$page];
        $userRole = getUserRole();
        if (!in_array($userRole, $allowedRoles)) {
            // Role tidak diizinkan
            echo "<h2>Akses Ditolak: Halaman ini hanya untuk " . implode(", ", $allowedRoles) . "</h2>";
            exit;
        }
    }

    // 4. Jika tidak ada aturan khusus role, asal login sudah cukup
}
