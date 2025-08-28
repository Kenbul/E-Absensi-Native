<?php

require_once 'model/Semester.php';

class SemesterController
{
    private $Semester;
    private $pdo;

    public function __construct($pdo)
    {
        $this->Semester = new Semester($pdo);
        $this->pdo = $pdo;
    }

    public function index()
    {
        $page = 'Semester';
        $semester = $this->Semester->getAll();
        include 'views/semester/index.php';
    }
    public function create()
    {
        $page = 'Tambah-Semester';
        include 'views/semester/tambah.php';
    }

    public function store()
    {
        $nama_semenster = $_POST['nama_semester'];
        $status = $_POST['status'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];

        try {
            $query = "INSERT INTO semester (nama_semester, tanggal_mulai, tanggal_selesai, status) 
              VALUES (:nama_semester, :tanggal_mulai, :tanggal_selesai, :status)";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':nama_semester' => $nama_semenster,
                ':tanggal_mulai' => $tanggal_mulai,
                ':tanggal_selesai' => $tanggal_selesai,
                ':status' => $status,
            ]);
            // ✅ Simpan pesan sukses ke session
            $_SESSION['success'] = "Data guru berhasil ditambahkan!";

            // Redirect ke halaman index guru
            header('Location: index.php?page=semester');
            exit(); // Pastikan script berhenti setelah redirect
        } catch (PDOException $e) {
            echo "Gagal memperbarui data: " . $e->getMessage();
        }
    }
    public function edit($id)
    {
        $page = 'Edit-Semester';
        $semester = $this->Semester->findById($id);
        include 'views/semester/edit.php';
    }

    public function update($id)
    {
        $nama_semenster = $_POST['nama_semester'];
        $status = $_POST['status'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        try {
            $query = "UPDATE semester SET nama_semester = :nama_semester, tanggal_mulai = :tanggal_mulai, tanggal_selesai = :tanggal_selesai, status = :status WHERE id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':nama_semester' => $nama_semenster,
                ':tanggal_mulai' => $tanggal_mulai,
                ':tanggal_selesai' => $tanggal_selesai,
                ':status' => $status,
                ':id' => $id,
            ]);
            // ✅ Simpan pesan sukses ke session
            $_SESSION['success'] = "Data guru berhasil Update!";

            // Redirect ke halaman index guru
            header('Location: index.php?page=semester');
            exit(); // Pastikan script berhenti setelah redirect
        } catch (PDOException $e) {
            echo "Gagal memperbarui data: " . $e->getMessage();
        }
    }

    public function delete($id)
    {
        include 'config/database.php';

        try {
            // Hapus data guru berdasarkan ID
            $query = "DELETE FROM semester WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data guru berhasil dihapus!";
            header('Location: index.php?page=semester');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data guru: " . $e->getMessage();
        }
    }
}
