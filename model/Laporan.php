<?php
require_once 'config/database.php';
class Laporan
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ambil data absensi siswa per guru‑kelas dalam rentang tanggal.
     *
     * @param int    $idGuru        id guru (kolom guru.id)
     * @param int    $idKelas       id kelas (kolom kelas.id)
     * @param string $tanggalMulai  format 'YYYY‑MM‑DD'
     * @param string $tanggalAkhir  format 'YYYY‑MM‑DD'
     * @return array  result‑set associative
     */
    public function getLaporanAbsensi($guru_id, $kelas_id, $mulai, $akhir)
    {
        // $data = [
        //     'guru' => $guru_id,
        //     'kelas' => $kelas_id,
        //     'mulai' => $mulai,
        //     'akhir' => $akhir,
        // ];
        // var_dump($data);
        // exit();
        $sql = "SELECT sd.tanggal, s.Nisn,s.Nama AS nama_siswa, sd.status, k.Kelas AS nama_kelas, u.username AS nama_guru 
FROM siswa_detail   sd
JOIN siswa          s  ON s.Nisn       = sd.siswa_nisn
JOIN jadwal_mengajar    jm ON jm.id    = sd.jadwal_mengajar_id
JOIN kelas              k  ON k.id     = jm.kelas_id
JOIN gurus              g  ON g.id     = jm.guru_id
JOIN users              u ON u.id      = g.users_id
WHERE g.id     = $guru_id
AND k.id     = $kelas_id
AND sd.tanggal BETWEEN '$mulai' AND '$akhir'
ORDER BY sd.tanggal, s.Nama";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNamaKelas(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT kelas FROM kelas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}
