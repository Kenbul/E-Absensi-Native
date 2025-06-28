<?php
require_once 'model/Guru.php';

class GuruController
{
    private $guruModel;

    public function __construct($pdo)
    {
        $this->guruModel = new Guru($pdo);
    }

    // Fungsi untuk menampilkan halaman index guru
    public function index()
    {
        $page = 'Data Guru';
        $dataguru = $this->guruModel->getAll();
        include 'views/guru/index.php';
    }
    public function create()
    {
        $page = 'Tambah Data Guru';
        $guru = $this->guruModel->getAll(); // Ambil data dari model
        include 'views/guru/tambah.php'; // Kirim data ke view
    }
    public function store()
    {
        include 'config/database.php';

        // Ambil data dari form
        $Nama = $_POST['Nama'];
        $Email = $_POST['Email'];
        $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT); // Hash password
        $Nik = $_POST['Nik'];
        $Nuptk = $_POST['Nuptk'];
        $StatusKepegawaian = $_POST['StatusKepegawaian'];
        $JenisKelamin = $_POST['JenisKelamin'];
        $TempatLahir = $_POST['TempatLahir'];
        $TglLahir = $_POST['TglLahir'];
        $NoHp = $_POST['NoHp'];
        $EmailMadrasah = $_POST['EmailMadrasah'];
        $Penempatan = $_POST['Penempatan'];

        try {
            // 1️⃣ Tambahkan user baru
            $queryUser = "INSERT INTO users (username, email, password, role) 
                          VALUES (:Nama, :Email, :Password, 'Guru')";
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':Nama', $Nama);
            $stmtUser->bindParam(':Email', $Email);
            $stmtUser->bindParam(':Password', $Password);
            $stmtUser->execute();
            $userId = $pdo->lastInsertId(); // Ambil ID user yang baru dibuat

            // 2️⃣ Tambahkan data guru dengan `user_id`
            $queryGuru = "INSERT INTO gurus (users_id, Nik, Nuptk, StatusKepegawaian, JenisKelamin, TempatLahir, TglLahir, NoHp, EmailMadrasah, Penempatan) 
                          VALUES (:UserId, :Nik, :Nuptk, :StatusKepegawaian, :JenisKelamin, :TempatLahir, :TglLahir, :NoHp, :EmailMadrasah, :Penempatan)";
            $stmtGuru = $pdo->prepare($queryGuru);
            $stmtGuru->bindParam(':UserId', $userId);
            $stmtGuru->bindParam(':Nik', $Nik);
            $stmtGuru->bindParam(':Nuptk', $Nuptk);
            $stmtGuru->bindParam(':StatusKepegawaian', $StatusKepegawaian);
            $stmtGuru->bindParam(':JenisKelamin', $JenisKelamin);
            $stmtGuru->bindParam(':TempatLahir', $TempatLahir);
            $stmtGuru->bindParam(':TglLahir', $TglLahir);
            $stmtGuru->bindParam(':NoHp', $NoHp);
            $stmtGuru->bindParam(':EmailMadrasah', $EmailMadrasah);
            $stmtGuru->bindParam(':Penempatan', $Penempatan);
            $stmtGuru->execute();

            // ✅ Simpan pesan sukses ke session
            $_SESSION['success'] = "Data guru berhasil ditambahkan!";

            // Redirect ke halaman index guru
            header('Location: index.php?page=guru');
            exit(); // Pastikan script berhenti setelah redirect
        } catch (PDOException $e) {
            echo "Gagal menambahkan data: " . $e->getMessage();
        }
    }
    public function edit($id)
    {
        $page = 'Edit Data Guru';
        $guru = $this->guruModel->findById($id);
        // var_dump($guru);
        // die;
        if (!$guru) {
            die("Data guru tidak ditemukan.");
        }
        include 'views/guru/edit.php';
    }

    public function update($id)
    {
        include 'config/database.php';
        $Nama = $_POST['Nama'];
        $Email = $_POST['Email'];
        $Nik = $_POST['Nik'];
        $Nuptk = $_POST['Nuptk'];
        $StatusKepegawaian = $_POST['StatusKepegawaian'];
        $JenisKelamin = $_POST['JenisKelamin'];
        $TempatLahir = $_POST['TempatLahir'];
        $TglLahir = $_POST['TglLahir'];
        $NoHp = $_POST['NoHp'];
        $EmailMadrasah = $_POST['EmailMadrasah'];
        $Penempatan = $_POST['Penempatan'];

        // Cek apakah password diisi
        if (!empty($_POST['Password'])) {
            $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
            $queryUser = "UPDATE users SET username = :Nama, email = :Email, password = :Password WHERE id = (SELECT users_id FROM gurus WHERE id = :id)";
        } else {
            $queryUser = "UPDATE users SET username = :Nama, email = :Email WHERE id = (SELECT users_id FROM gurus WHERE id = :id)";
        }

        try {
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':Nama', $Nama);
            $stmtUser->bindParam(':Email', $Email);
            if (!empty($_POST['Password'])) {
                $stmtUser->bindParam(':Password', $Password);
            }
            $stmtUser->bindParam(':id', $id);
            $stmtUser->execute();
            // var_dump($stmtUser);
            // die;

            // Update tabel guru
            $queryGuru = "UPDATE gurus SET 
                      Nik = :Nik, Nuptk = :Nuptk, StatusKepegawaian = :StatusKepegawaian, 
                      JenisKelamin = :JenisKelamin, TempatLahir = :TempatLahir, 
                      TglLahir = :TglLahir, NoHp = :NoHp, EmailMadrasah = :EmailMadrasah, 
                      Penempatan = :Penempatan 
                      WHERE id = :id";

            $stmtGuru = $pdo->prepare($queryGuru);
            $stmtGuru->bindParam(':Nik', $Nik);
            $stmtGuru->bindParam(':Nuptk', $Nuptk);
            $stmtGuru->bindParam(':StatusKepegawaian', $StatusKepegawaian);
            $stmtGuru->bindParam(':JenisKelamin', $JenisKelamin);
            $stmtGuru->bindParam(':TempatLahir', $TempatLahir);
            $stmtGuru->bindParam(':TglLahir', $TglLahir);
            $stmtGuru->bindParam(':NoHp', $NoHp);
            $stmtGuru->bindParam(':EmailMadrasah', $EmailMadrasah);
            $stmtGuru->bindParam(':Penempatan', $Penempatan);
            $stmtGuru->bindParam(':id', $id);
            $stmtGuru->execute();

            // Redirect dengan pesan sukses

            // var_dump($_SESSION);
            // die;
            header('Location: index.php?page=guru');
            $_SESSION['success'] = "Data guru berhasil diperbaharui!";
            exit;
        } catch (PDOException $e) {
            echo "Gagal memperbarui data: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        include 'config/database.php';

        try {
            // Hapus data guru berdasarkan ID
            $query = "DELETE FROM gurus WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data guru berhasil dihapus!";
            header('Location: index.php?page=guru');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data guru: " . $e->getMessage();
        }
    }
}
