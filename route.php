<?php
include "config/database.php";
require_once 'config/config.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/GuruController.php';
require_once 'controllers/KelasController.php';
require_once 'controllers/MapelController.php';
require_once 'controllers/SiswaController.php';
require_once 'controllers/JadwalMengajarController.php';
require_once 'controllers/AbsensiController.php';
require_once 'controllers/LaporanController.php';
require_once 'controllers/UploadController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/SemesterController.php';

$guruController = new GuruController($pdo);
$kelasController = new KelasController($pdo);
$mapelController = new MapelController($pdo);
$siswaController = new SiswaController($pdo);
$authController = new AuthController($pdo);
$jadwalMengajarController =  new JadwalMengajarController($pdo);
$AbsensiController =  new AbsensiController($pdo);
$LaporanController =  new LaporanController($pdo);
$DashboardController =  new DashboardController($pdo);
$SemesterController =  new SemesterController($pdo);

$page = $_GET['page'] ?? 'login';
require_once 'config/config.php';  // Tambahkan ini
handleAccess($page);

switch ($page) {
    case 'login':
        $authController->showLoginForm();
        break;
    case 'loginProcess':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
        $DashboardController->index();
        break;
    case 'semester':
        $controller = $SemesterController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } elseif ($action === 'update') {
            $controller->update($_POST['id']);
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'guru':
        $controller = $guruController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']); // Menampilkan form edit
        } elseif ($action === 'update') {
            $controller->update($_POST['id']); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } elseif ($action === 'import_guru') {
            $controller->importForm();
        } elseif ($action === 'view' && isset($_GET['id'])) {
            $controller->view($_GET['id']);
        } elseif ($action === 'import_data') {
            $controller->importData();
        } elseif ($action === 'kinerja' && isset($_GET['id'])) {
            $controller->kinerja($_GET['id']);
        } elseif ($action === 'view_kinerja' && isset($_GET['id'])) {
            $controller->viewKinerja($_GET['id']);
        } elseif ($action === 'kinerja-guru') {
            $controller->KinerjaGuru();
        } else {
            $controller->index();
        }
        break;
    case 'siswa':
        $controller = $siswaController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'edit' && isset($_GET['Nik'])) {
            $controller->edit($_GET['Nik']); // Menampilkan form edit
        } elseif ($action === 'update') {
            $controller->update($_POST['Nik']); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'mapel':
        $controller = $mapelController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']); // Menampilkan form edit
        } elseif ($action === 'update') {
            $controller->update($_POST['id']); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'kelas':
        $controller = $kelasController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']); // Menampilkan form edit
        } elseif ($action === 'update') {
            $controller->update($_POST['id']); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'jadwal-mengajar':
        // $jadwalMengajarController->index();
        $controller = $jadwalMengajarController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $controller->edit($_GET['id']); // Menampilkan form edit
        } elseif ($action === 'update') {
            $controller->update($_POST['id']); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'absensi':
        // $jadwalMengajarController->index();
        $controller = $AbsensiController;
        $action = $_GET['action'] ?? 'index';
        if ($action === 'showAbsensi' && isset($_GET['kelas'])) {
            $controller->showAbsensi($_GET['kelas']);
        } elseif ($action === 'addAbsensi') {
            $controller->addAbsensi();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $controller->editAbsensi($_GET['id']); // Menampilkan form edit
        } elseif ($action === 'update_absensi') {
            $controller->updateAbsensi(); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } elseif ($action === 'ajaxabsensi') {
            $controller->ajaxAbsensi();
        } elseif ($action === 'get_mapel_by_kelas') {
            $controller->getMapelByKelas();
        } elseif ($action === 'update_ajax') {
            $controller->updateAbsensiAjax();
        } else {
            $controller->index();
        }
        break;
    case 'laporan':
        $controller = $LaporanController;
        $action = $_GET['action'] ?? 'index';

        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'pdf') {
            $controller->exportPdf();
        } elseif ($action === 'get_kelas_by_guru') {
            $controller->getKelasByGuru();
        } elseif ($action === 'get_mapel_by_guru_kelas') {
            $controller->getMapelByGuruKelas();
        } else {
            $controller->index();
        }
        break;

    default:
        echo "Halaman tidak ditemukan!";
        break;
}
