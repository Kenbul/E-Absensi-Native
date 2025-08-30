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
        $query = "SELECT 
                jm.id,
                u.username AS nama_guru,
                m.Mapel AS mapel,
                k.Kelas,
                jm.hari,
                jm.jam_mulai,
                jm.jam_selesai
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              JOIN gurus g ON gp.guru_id = g.id
              JOIN users u ON g.users_id = u.id
              JOIN mapel m ON gp.pelajaran_id = m.id
              JOIN kelas k ON jm.kelas_id = k.id
              ORDER BY jm.hari, jm.jam_mulai";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByKelas($filter = '')
    {
        $query = "SELECT 
                jm.id,
                u.username AS nama_guru,
                m.Mapel AS mapel,
                k.Kelas,
                jm.hari,
                jm.jam_mulai,
                jm.jam_selesai
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              JOIN gurus g ON gp.guru_id = g.id
              JOIN users u ON g.users_id = u.id
              JOIN mapel m ON gp.pelajaran_id = m.id
              JOIN kelas k ON jm.kelas_id = k.id
              WHERE kelas_id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $filter);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getByGuru($guru_id)
    {
        $query = "SELECT jm.*, k.Kelas, m.Mapel, m.id as mapel_id, gp.pelajaran_id
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
              JOIN gurus g ON g.id = gp.guru_id
              JOIN mapel m ON m.id = gp.pelajaran_id
              JOIN kelas k ON k.id = jm.kelas_id
              WHERE g.id = :guru_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findByGuru($guru_id)
    {
        $query = "SELECT jm.*, k.Kelas, m.Mapel, m.id as mapel_id, gp.pelajaran_id, g.id as guru_id
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
              JOIN gurus g ON g.id = gp.guru_id
              JOIN mapel m ON m.id = gp.pelajaran_id
              JOIN kelas k ON k.id = jm.kelas_id
              WHERE g.id = :guru_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function findById($id)
    {
        $query = "SELECT 
                jm.*,
                g.id AS guru_id,
                m.Mapel AS nama_mapel,
                gp.pelajaran_id,
                m.id as mapel_id
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              JOIN gurus g ON gp.guru_id = g.id
              JOIN mapel m ON gp.pelajaran_id = m.id
              WHERE jm.id = :id
              LIMIT 1";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function viewSiswa($kelas)
    {
        $query = "SELECT Nama,Nisn FROM siswa WHERE Kelas = $kelas";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDetailByKelas($kelas, $guru_id, $pelajaran_id)
    {
        $query = "SELECT 
                  jm.id AS jadwal_mengajar_id,
                  k.Kelas,
                  k.id as kelas_id,
                  gp.pelajaran_id as pelajaran_id,
                  m.Mapel AS nama_mapel
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              JOIN kelas k ON jm.kelas_id = k.id
              JOIN mapel m ON gp.pelajaran_id = m.id
              WHERE jm.kelas_id = :kelas_id 
                AND gp.guru_id = :guru_id 
                AND gp.pelajaran_id = :pelajaran_id
              LIMIT 1";

        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':kelas_id', $kelas);
        $stm->bindParam(':guru_id', $guru_id);
        $stm->bindParam(':pelajaran_id', $pelajaran_id);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC); // supaya dapat array dengan key nama kolom
    }
    public function getAbsensiByKelasMapel($kelas_id, $guru_id, $pelajaran_id)
    {
        $query = "
        SELECT 
            sd.id,
            s.Nisn,
            s.Nama AS nama_siswa,
            sd.tanggal,
            sd.status,
            CASE 
                WHEN TIMESTAMPDIFF(HOUR, sd.tanggal, NOW()) <= 24 THEN 1
                ELSE 0
            END AS boleh_edit
        FROM siswa_detail sd
        JOIN siswa s ON s.Nisn = sd.siswa_nisn
        JOIN jadwal_mengajar jm ON jm.id = sd.jadwal_mengajar_id
        JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
        JOIN kelas k ON jm.kelas_id = k.id
        WHERE k.id = :kelas_id
          AND gp.guru_id = :guru_id
          AND gp.pelajaran_id = :pelajaran_id
        ORDER BY sd.tanggal DESC, s.Nama ASC";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':kelas_id', $kelas_id, PDO::PARAM_INT);
        $stmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
        $stmt->bindParam(':pelajaran_id', $pelajaran_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function showAbsensi($guru_id)
    {
        $sql = "SELECT
                k.Kelas,
                s.Nama AS nama_siswa,
                sd.tanggal,
                sd.status
            FROM siswa_detail sd
            JOIN siswa s ON s.Nisn = sd.siswa_nisn
            JOIN jadwal_mengajar jm ON jm.id = sd.jadwal_mengajar_id
            JOIN kelas k ON k.id = jm.kelas_id
            JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
            JOIN gurus g ON g.id = gp.guru_id
            WHERE g.id = :guru_id
            ORDER BY k.Kelas, sd.tanggal DESC, s.Nama";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getKelasByGuru($guru_id)
    {
        $sql = "SELECT DISTINCT k.id, k.Kelas
            FROM jadwal_mengajar jm
            JOIN kelas k ON k.id = jm.kelas_id
            JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
            JOIN gurus g ON g.id = gp.guru_id
            WHERE g.id = :guru_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':guru_id' => $guru_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getMapelByGuru($guru_id)
    // {
    //     $sql = "SELECT DISTINCT m.id, m.Mapel
    //         FROM jadwal_mengajar jm
    //         JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
    //         JOIN mapel m ON m.id = gp.pelajaran_id
    //         JOIN gurus g ON g.id = gp.guru_id
    //         WHERE g.id = :guru_id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([':guru_id' => $guru_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getMapelByGuru($guru_id)
    {
        $query = "SELECT m.id, m.Mapel 
              FROM guru_pelajaran gp
              JOIN mapel m ON gp.pelajaran_id = m.id
              WHERE gp.guru_id = :guru_id";

        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':guru_id', $guru_id);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getJadwalByGuruAndMapel($guru_id, $mapel_id)
    {
        $query = "SELECT jm.*, k.Kelas 
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              JOIN kelas k ON jm.kelas_id = k.id
              WHERE gp.guru_id = :guru_id AND gp.pelajaran_id = :mapel_id";

        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':guru_id', $guru_id);
        $stm->bindParam(':mapel_id', $mapel_id);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getJumlahAbsensiGuru($guru_id, $pelajaran_id, $kelas_id, $start_date, $end_date)
    {
        $query = "SELECT COUNT(a.id) AS total_absensi
              FROM absensi a
              JOIN jadwal_mengajar jm ON a.jadwal_mengajar_id = jm.id
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              WHERE gp.guru_id = :guru_id
                AND gp.pelajaran_id = :pelajaran_id
                AND jm.kelas_id = :kelas_id
                AND a.tanggal BETWEEN :start AND :end";

        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':guru_id', $guru_id);
        $stm->bindParam(':pelajaran_id', $pelajaran_id);
        $stm->bindParam(':kelas_id', $kelas_id);
        $stm->bindParam(':start', $start_date);
        $stm->bindParam(':end', $end_date);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function getJadwalByGuru($guru_id)
    {
        $query = "SELECT jm.*, k.nama_kelas, p.nama_pelajaran 
              FROM jadwal_mengajar jm
              JOIN kelas k ON jm.kelas_id = k.id
              JOIN pelajaran p ON jm.pelajaran_id = p.id
              WHERE jm.guru_id = :guru_id";
        $stm = $this->pdo->prepare($query);
        $stm->execute([':guru_id' => $guru_id]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function showAbsensiFiltered($guru_id, $kelas_id, $mapel_id)
    {
        $sql = "SELECT
                sd.id,
                k.Kelas,
                s.Nama AS nama_siswa,
                sd.tanggal,
                sd.status,
                CASE 
                    WHEN TIMESTAMPDIFF(HOUR, sd.tanggal, NOW()) <= 24 THEN 1
                    ELSE 0
                END AS boleh_edit
            FROM siswa_detail sd
            JOIN siswa s ON s.Nisn = sd.siswa_nisn
            JOIN jadwal_mengajar jm ON jm.id = sd.jadwal_mengajar_id
            JOIN kelas k ON k.id = jm.kelas_id
            JOIN guru_pelajaran gp ON gp.id = jm.guru_pelajaran_id
            JOIN gurus g ON g.id = gp.guru_id
            WHERE g.id = :guru_id
              AND k.id = :kelas_id
              AND gp.pelajaran_id = :mapel_id
            ORDER BY sd.tanggal DESC, s.Nama";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':guru_id'   => $guru_id,
            ':kelas_id'  => $kelas_id,
            ':mapel_id'  => $mapel_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMapelByGuruAndKelas($guru_id, $kelas_id)
    {
        $sql = "SELECT DISTINCT m.id, m.Mapel
            FROM jadwal_mengajar jm
            JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
            JOIN mapel m ON gp.pelajaran_id = m.id
            WHERE gp.guru_id = :guru_id
              AND jm.kelas_id = :kelas_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':guru_id' => $guru_id,
            ':kelas_id' => $kelas_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMapelByGuruKelas($guru_id, $kelas_id)
    {
        $sql = "SELECT DISTINCT m.id, m.Mapel
                FROM jadwal_mengajar jm
                JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
                JOIN mapel m ON gp.pelajaran_id = m.id
                WHERE gp.guru_id = :guru_id
                  AND jm.kelas_id = :kelas_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':guru_id' => $guru_id,
            ':kelas_id' => $kelas_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
