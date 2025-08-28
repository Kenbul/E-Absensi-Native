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
     * @param int    $idMapel       id kelas (kolom kelas.id)
     * @param string $tanggalMulai  format 'YYYY‑MM‑DD'
     * @param string $tanggalAkhir  format 'YYYY‑MM‑DD'
     * @return array  result‑set associative
     */
    public function getLaporanAbsensiPersentase($guru_id = null, $mapel_id = null, $kelas_id = null, $mulai = null, $akhir = null)
    {
        $where = [];
        $params = [];

        // Filter Guru
        if (!empty($guru_id)) {
            $where[] = "g.id = :guru_id";
            $params[':guru_id'] = $guru_id;
        }

        // Filter Kelas
        if (!empty($kelas_id)) {
            $where[] = "k.id = :kelas_id";
            $params[':kelas_id'] = $kelas_id;
        }

        // Filter Mapel
        if (!empty($mapel_id)) {
            $where[] = "gp.pelajaran_id = :mapel_id";
            $params[':mapel_id'] = $mapel_id;
        }

        // Filter Rentang Tanggal
        if (!empty($mulai) && !empty($akhir)) {
            $where[] = "DATE(sd.tanggal) BETWEEN :mulai AND :akhir";
            $params[':mulai'] = $mulai;
            $params[':akhir'] = $akhir;
        }

        $sql = "
        SELECT 
            s.Nisn,
            s.Nama AS nama_siswa,
            k.Kelas AS nama_kelas,
            u.username AS nama_guru,
            m.Mapel,
            SUM(CASE WHEN sd.status = 'Hadir' THEN 1 ELSE 0 END) AS total_hadir,
            SUM(CASE WHEN sd.status = 'Izin' THEN 1 ELSE 0 END) AS total_izin,
            SUM(CASE WHEN sd.status = 'Sakit' THEN 1 ELSE 0 END) AS total_sakit,
            SUM(CASE WHEN sd.status = 'Alpha' THEN 1 ELSE 0 END) AS total_alpha,
            COUNT(DISTINCT sd.tanggal) AS total_pertemuan,
            ROUND(
                SUM(
                    CASE 
                        WHEN sd.status = 'Hadir' THEN 2
                        WHEN sd.status = 'Izin' THEN 1
                        WHEN sd.status = 'Sakit' THEN 1
                        ELSE 0
                    END
                ) / (COUNT(DISTINCT sd.tanggal) * 2) * 100, 
                2
            ) AS persen_hadir
        FROM siswa_detail sd
        JOIN siswa s ON s.Nisn = sd.siswa_nisn
        JOIN jadwal_mengajar jm ON jm.id = sd.jadwal_mengajar_id
        JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
        JOIN gurus g ON g.id = gp.guru_id
        JOIN mapel m ON m.id = gp.pelajaran_id
        JOIN kelas k ON k.id = jm.kelas_id
        JOIN users u ON u.id = g.users_id
        " . (!empty($where) ? "WHERE " . implode(" AND ", $where) : "") . "
        GROUP BY s.Nisn, s.Nama, k.Kelas, u.username, m.Mapel
        ORDER BY persen_hadir DESC
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }






    public function getNamaKelas(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT kelas FROM kelas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}
