<?php
require_once 'config/database.php';

class JadwalMengajar
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getAll()
    {
        $query = "SELECT jm.id, u.username AS nama_guru, k.Kelas, jm.hari, jm.jam_mulai, jm.jam_selesai FROM jadwal_mengajar jm JOIN gurus g on jm.guru_id = g.id JOIN users u on g.users_id = u.id JOIN kelas k on jm.kelas_id = k.id; ";
        //  ORDER BY jm.hari, jm.jam_mulai";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByGuru()
    {
        $query = "SELECT jm.*, k.Kelas FROM jadwal_mengajar jm JOIN kelas k ON k.id = jm.kelas_id JOIN gurus g ON g.id = jm.guru_id WHERE g.users_id;";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function viewSiswa($kelas)
    {
        $query = "SELECT Nama,Nisn FROM siswa WHERE Kelas = $kelas";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getIdBykelas($kelas)
    {
        $query = "SELECT id FROM jadwal_mengajar WHERE kelas_id = $kelas";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function showAbsensi($guru_id)
    {
        $sql = "SELECT
    k.Kelas,           -- agar bisa dikelompokkan/diurutkan per kelas
    s.Nama         AS nama_siswa,
    sd.tanggal,
    sd.status
    FROM siswa_detail sd
    JOIN siswa            s  ON s.Nisn   = sd.siswa_nisn
    JOIN jadwal_mengajar  jm ON jm.id = sd.jadwal_mengajar_id
    JOIN kelas            k  ON k.id   = jm.kelas_id   -- bisa juga s.id_kelas
    WHERE jm.guru_id = $guru_id               -- ← guru yg sedang login
    ORDER BY k.Kelas, sd.tanggal DESC, s.Nama";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
