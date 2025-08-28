<?php
require_once 'config/database.php';

class Semester
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $query = "SELECT * FROM semester";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $query = "SELECT id, nama_semester, tanggal_mulai, tanggal_selesai, status FROM semester WHERE id = :id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function where()
    {
        $status = 'aktif';
        $query = "SELECT id,nama_semester, tanggal_mulai, tanggal_selesai FROM semester WHERE status = :status";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getPertemuanJadwal($jadwal, $tanggal_mulai, $tanggal_selesai)
    {
        $hasil = [];
        $start = new DateTime($tanggal_mulai);
        $end = new DateTime($tanggal_selesai);
        $hari_target = $jadwal['hari']; // 'Senin', 'Selasa', dll

        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        foreach ($period as $date) {
            if ($this->namaHari($date) == $hari_target) {
                $hasil[] = $date->format('Y-m-d');
            }
        }
        return $hasil;
    }

    public function namaHari($date)
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return $hari[$date->format('w')];
    }
    public function hitungAbsensiGuru($guru_id, $pelajaran_id, $kelas_id, $tanggal_mulai, $tanggal_selesai)
    {
        $query = "SELECT COUNT(*) 
                  FROM absensi 
                  WHERE guru_id = :guru_id 
                    AND pelajaran_id = :pelajaran_id 
                    AND kelas_id = :kelas_id 
                    AND tanggal BETWEEN :tanggal_mulai AND :tanggal_selesai";
        $stm = $this->pdo->prepare($query);
        $stm->execute([
            ':guru_id' => $guru_id,
            ':pelajaran_id' => $pelajaran_id,
            ':kelas_id' => $kelas_id,
            ':tanggal_mulai' => $tanggal_mulai,
            ':tanggal_selesai' => $tanggal_selesai,
        ]);
        return $stm->fetchColumn();
    }

    // public function cekKinerjaGuru($guru_id, $semester_id)
    // {
    //     $semester = $this->getSemesterById($semester_id);
    //     $jadwal = $this->getJadwalByGuru($guru_id);

    //     $result = [];

    //     foreach ($jadwal as $j) {
    //         $tanggal_pertemuan = getPertemuanJadwal($j, $semester['tanggal_mulai'], $semester['tanggal_selesai']);
    //         $data = [];

    //         foreach ($tanggal_pertemuan as $tgl) {
    //             $sudah = $this->sudahAbsensi($j['id'], $tgl);
    //             $data[] = [
    //                 'tanggal' => $tgl,
    //                 'status' => $sudah ? '✅' : '❌'
    //             ];
    //         }

    //         $result[] = [
    //             'kelas' => getNamaKelas($j['kelas_id']),
    //             'mapel' => getNamaMapel($j['mapel_id']),
    //             'hari' => $j['hari'],
    //             'pertemuan' => $data
    //         ];
    //     }

    //     return $result;
    // }
    function sudahAbsensi($jadwal_id, $tanggal)
    {
        global $pdo;
        $sql = "SELECT COUNT(*) FROM siswa_detail WHERE jadwal_mengajar_id = ? AND tanggal = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$jadwal_id, $tanggal]);
        return $stmt->fetchColumn() > 0;
    }
    public function getSemesterById($id)
    {
        $query = "SELECT * FROM semester WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
