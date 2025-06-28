<?php
require_once 'model/Mapel.php';

class MapelController
{
    private $mapelModel;

    public function __construct($pdo)
    {
        $this->mapelModel = new mapel($pdo);
    }


    // Fungsi untuk menampilkan halaman index mapel
    public function index()
    {
        $page = 'Data mapel';
        $datamapel = $this->mapelModel->getAll();
        include 'views/mapel/index.php';
    }
    public function create()
    {
        $page = 'Tambah Data mapel';
        $mapel = $this->mapelModel->getAll(); // Ambil data dari model
        include 'views/mapel/tambah.php'; // Kirim data ke view
    }
    public function store()
    {
        include 'config/database.php';

        // Ambil data dari form
        $mapel = $_POST['mapel'];
        // var_dump($mapel);
        // die;

        try {
            // 1️⃣ Tambahkan user baru
            $queryUser = "INSERT INTO mapel (id, mapel, created_at, updated_at) VALUES (NULL, :mapel , NOW(), NOW())";
            // var_dump($queryUser);
            // die;
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':mapel', $mapel);
            $stmtUser->execute();
            // var_dump($stmtUser);
            // die;

            // ✅ Simpan pesan sukses ke session
            $_SESSION['success'] = "Data mapel berhasil ditambahkan!";

            // Redirect ke halaman index mapel
            header('Location: index.php?page=mapel');
            exit(); // Pastikan script berhenti setelah redirect
        } catch (PDOException $e) {
            echo "Gagal menambahkan data: " . $e->getMessage();
        }
    }
    public function edit($id)
    {
        $page = 'Edit Data mapel';
        $mapel = $this->mapelModel->findById($id);
        // var_dump($mapel);
        // die;
        if (!$mapel) {
            $_SESSION['error'] = "Data mapel tidak ditemukan!";
            header('Location: index.php?page=mapel');
            exit;
        }
        include 'views/mapel/edit.php'; // Tampilkan halaman edit
    }

    public function update($id)
    {
        include 'config/database.php';
        $mapel = $_POST['mapel'];

        try {
            $queryUser = "UPDATE mapel SET mapel = :mapel, created_at = NOW(), updated_at = NOW() WHERE mapel.id = $id";
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':mapel', $mapel);
            $stmtUser->execute();
            header('Location: index.php?page=mapel');
            $_SESSION['success'] = "Data mapel berhasil diperbaharui!";
            exit;
        } catch (PDOException $e) {
            echo "Gagal memperbarui data: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        include 'config/database.php';
        try {
            // Hapus data mapel berdasarkan ID
            $query = "DELETE FROM mapel WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data mapel berhasil dihapus!";
            header('Location: index.php?page=mapel');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data mapel: " . $e->getMessage();
        }
    }
}
