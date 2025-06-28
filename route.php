<?php
include "config/database.php";
require_once 'controllers/AuthController.php';
require_once 'controllers/GuruController.php';
require_once 'controllers/KelasController.php';
require_once 'controllers/MapelController.php';
require_once 'controllers/SiswaController.php';
require_once 'controllers/JadwalMengajarController.php';
require_once 'controllers/AbsensiController.php';

$guruController = new GuruController($pdo);
$kelasController = new KelasController($pdo);
$mapelController = new MapelController($pdo);
$siswaController = new SiswaController($pdo);
$authController = new AuthController($pdo);
$jadwalMengajarController =  new JadwalMengajarController($pdo);
$AbsensiController =  new AbsensiController($pdo);
$page = $_GET['page'] ?? 'dashboard';

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
        require 'controllers/DashboardController.php';
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
            $controller->delete($_GET['Nik']);
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
            $controller->edit($_GET['id']); // Menampilkan form edit
        } elseif ($action === 'update') {
            $controller->update($_POST['id']); // Memproses update data
        } elseif ($action === 'delete') {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    default:
        echo "Halaman tidak ditemukan!";
        break;
}
