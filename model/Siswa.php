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
}
