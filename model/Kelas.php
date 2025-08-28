<?php
require_once 'config/database.php';

class Kelas
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fungsi untuk mendapatkan semua data guru
    public function getAll()
    {
        $query = "SELECT * FROM kelas";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $query = "SELECT id,Kelas FROM kelas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function kelasById($id)
    {
        $query = "SELECT Kelas FROM kelas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getByGuruId($guru_id)
    {
        $query = "
            SELECT jm.*, k.Kelas, m.Mapel
            FROM jadwal_mengajar jm
            JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
            JOIN kelas k ON jm.kelas_id = k.id
            JOIN mapel m ON gp.pelajaran_id = m.id
            WHERE gp.guru_id = :guru_id
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function isKelasInUse($id)
    {
        // Cek relasi dengan tabel siswa
        $query1 = "SELECT COUNT(*) as total FROM siswa WHERE Kelas = :Kelas";
        $stmt1 = $this->pdo->prepare($query1);
        $stmt1->execute(['Kelas' => $id]);
        $countSiswa = $stmt1->fetch(PDO::FETCH_ASSOC)['total'];

        // Cek relasi dengan tabel jadwal_mengajar
        $query3 = "SELECT COUNT(*) as total FROM jadwal_mengajar WHERE kelas_id = :kelas_id";
        $stmt3 = $this->pdo->prepare($query3);
        $stmt3->execute(['kelas_id' => $id]);
        $countJadwal = $stmt3->fetch(PDO::FETCH_ASSOC)['total'];

        // Jika ada salah satu yang relasi, berarti tidak bisa dihapus
        return ($countSiswa > 0 || $countJadwal > 0);
    }
}
