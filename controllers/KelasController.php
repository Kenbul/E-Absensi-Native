<?php
require_once 'model/Kelas.php';

class KelasController
{
    private $kelasModel;

    public function __construct($pdo)
    {
        $this->kelasModel = new Kelas($pdo);
    }


    // Fungsi untuk menampilkan halaman index kelas
    public function index()
    {
        $page = 'Data kelas';
        $datakelas = $this->kelasModel->getAll();
        include 'views/kelas/index.php';
    }
    public function create()
    {
        $page = 'Tambah Data kelas';
        $kelas = $this->kelasModel->getAll(); // Ambil data dari model
        include 'views/kelas/tambah.php'; // Kirim data ke view
    }
    public function store()
    {
        include 'config/database.php';

        // Ambil data dari form
        $Kelas = $_POST['Kelas'];
        // var_dump($Kelas);
        // die;

        try {
            // 1️⃣ Tambahkan user baru
            $queryUser = "INSERT INTO kelas (id, Kelas, created_at, updated_at) VALUES (NULL, :Kelas , NOW(), NOW())";
            // var_dump($queryUser);
            // die;
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':Kelas', $Kelas);
            $stmtUser->execute();
            // var_dump($stmtUser);
            // die;

            // ✅ Simpan pesan sukses ke session
            $_SESSION['success'] = "Data kelas berhasil ditambahkan!";

            // Redirect ke halaman index kelas
            header('Location: index.php?page=kelas');
            exit(); // Pastikan script berhenti setelah redirect
        } catch (PDOException $e) {
            echo "Gagal menambahkan data: " . $e->getMessage();
        }
    }
    public function edit($id)
    {
        $page = 'Edit Data kelas';
        $kelas = $this->kelasModel->findById($id);
        // var_dump($kelas);
        // die;
        if (!$kelas) {
            $_SESSION['error'] = "Data kelas tidak ditemukan!";
            header('Location: index.php?page=kelas');
            exit;
        }
        include 'views/kelas/edit.php'; // Tampilkan halaman edit
    }

    public function update($id)
    {
        include 'config/database.php';
        $Kelas = $_POST['Kelas'];

        try {
            $queryUser = "UPDATE kelas SET Kelas = :Kelas, created_at = NOW(), updated_at = NOW() WHERE kelas.id = $id";
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':Kelas', $Kelas);
            $stmtUser->execute();
            header('Location: index.php?page=kelas');
            $_SESSION['success'] = "Data kelas berhasil diperbaharui!";
            exit;
        } catch (PDOException $e) {
            echo "Gagal memperbarui data: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        include 'config/database.php';
        try {
            // Hapus data kelas berdasarkan ID
            $query = "DELETE FROM kelas WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data kelas berhasil dihapus!";
            header('Location: index.php?page=kelas');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data kelas: " . $e->getMessage();
        }
    }
}
