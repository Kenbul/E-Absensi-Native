<?php
require_once 'model/Guru.php';

class AuthController
{
    private $guruModel;

    public function __construct($pdo)
    {
        $this->guruModel = new Guru($pdo);
    }
    public function showLoginForm()
    {
        $title = 'Login-Page';
        include 'views/layouts/login.php';
    }

    public function login()
    {
        // 0. Taruh session_start() sekali di file bootstrap / config,
        //    atau pastikan tidak dipanggil dua kali.
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=login'); exit;
        }
    
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
    
        // 1. Ambil user dari tabel USERS, bukan guru. Sesuaikan model Anda.
        $user = $this->guruModel->getGuruByEmail($email);   // SELECT id_user, email, password, role FROM users ...
    
        if (!$user) {
            $_SESSION['error'] = 'Email tidak terdaftar';
            header('Location: index.php?page=login'); exit;
        }
    
        // 2. Verifikasi hash
        if (!password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Password salah';
            header('Location: index.php?page=login'); exit;
        }
    
        // 3. Set session utama
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['role']     = $user['role'];
    
        // 4. (Opsional) jika role‑nya guru, simpan id_guru sekali saja
        // if ($user['role'] === 'guru') {
        //     $guru = $this->guruModel->findByUserId($user['id_user']); // SELECT id_guru ...
        //     $_SESSION['guru_id'] = $guru['id_guru'] ?? null;
        // }
    
        header('Location: index.php?page=dashboard'); exit;
    }
    

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
