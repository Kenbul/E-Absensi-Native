<?php
require_once 'model/Guru.php';

class AuthController
{
    private $guruModel;
    private $userModel;
    private $semesterModel;

    public function __construct($pdo)
    {
        $this->guruModel = new Guru($pdo);
        $this->userModel = new User($pdo);
        $this->semesterModel = new Semester($pdo);
    }
    public function showLoginForm()
    {
        $title = 'Login-Page';
        include 'views/layouts/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=login');
            exit;
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Inisialisasi counter percobaan login per email
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = [];
        }
        if (!isset($_SESSION['login_attempts'][$email])) {
            $_SESSION['login_attempts'][$email] = 0;
        }

        // Ambil user
        $user = $this->guruModel->getGuruByEmail($email);

        if (!$user) {
            $_SESSION['error'] = 'Email tidak terdaftar';
            header('Location: index.php?page=login');
            exit;
        }

        // Verifikasi password & hitung percobaan
        if (!password_verify($password, $user['password'])) {
            $_SESSION['login_attempts'][$email]++;

            if ($_SESSION['login_attempts'][$email] >= 2) {
                $_SESSION['error'] = 'Jika anda lupa password silahkan hubungi admin';
            } else {
                $_SESSION['error'] = 'Password salah';
            }

            header('Location: index.php?page=login');
            exit;
        }

        // Reset counter jika login berhasil
        $_SESSION['login_attempts'][$email] = 0;

        // Ambil data user untuk set session
        $coba = $this->userModel->findUser($email, $user['password']);
        $semester = $this->semesterModel->where();

        if ($coba['role'] == "Admin") {
            $_SESSION['user_id'] = $coba['id'];
            $_SESSION['role']     = $user['role'];
            $_SESSION['semester_id'] = $semester['id'];
        } else {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['role']     = $user['role'];
            $_SESSION['semester_id'] = $semester['id'];
        }

        header('Location: index.php?page=dashboard');
        exit;
    }



    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
