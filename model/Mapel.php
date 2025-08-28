<?php
require_once 'config/database.php';

class Mapel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fungsi untuk mendapatkan semua data guru
    public function getAll()
    {
        $query = "SELECT * FROM Mapel";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $query = "SELECT id,Mapel FROM Mapel WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getMapelByJadwalId($jadwalId)
    {
        $sql = "SELECT m.id, m.Mapel AS Mapel
            FROM jadwal_mengajar jm
            JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
            JOIN mapel m ON gp.pelajaran_id = m.id
            WHERE jm.id = :jadwalId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['jadwalId' => $jadwalId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
