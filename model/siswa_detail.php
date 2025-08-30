<?php
require_once 'config/database.php';

class siswa_detail
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function findById($id)
    {
        $sql = "SELECT 
                sd.id,
                sd.tanggal,
                sd.status,
                s.Nisn,
                s.Nama AS nama_siswa,
                k.Kelas
            FROM siswa_detail sd
            JOIN siswa s ON s.Nisn = sd.siswa_nisn
            JOIN jadwal_mengajar jm ON jm.id = sd.jadwal_mengajar_id
            JOIN kelas k ON k.id = jm.kelas_id
            WHERE sd.id = :id
            LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE siswa_detail SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }
}
