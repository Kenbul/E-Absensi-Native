<?php
require_once 'config/database.php';

class Siswa
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fungsi untuk mendapatkan semua data guru
    public function getAll()
    {
        $query = "SELECT * FROM siswa";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($Nik)
    {
        $query = "SELECT * FROM siswa WHERE Nik = :Nik";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':Nik', $Nik, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getDataSiswa($keyword = '')
    {
        if ($keyword) {
            $sql = "SELECT * FROM siswa WHERE Nama LIKE :keyword";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['keyword' => "%$keyword%"]);
        } else {
            $sql = "SELECT * FROM siswa";
            $stmt = $this->pdo->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
