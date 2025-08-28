<?php
require_once 'config/database.php';

class Guru
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fungsi untuk mendapatkan semua data guru
    public function getAll()
    {
        $query = "SELECT gurus.*, users.username, users.email FROM gurus 
                  JOIN users ON gurus.users_id = users.id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $query = "SELECT gurus.*, users.username, users.email 
                  FROM gurus 
                  JOIN users ON gurus.users_id = users.id 
                  WHERE gurus.id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function nameById($id)
    {
        $query = "SELECT users.username As Nama, gurus.users_id FROM gurus JOIN users ON gurus.users_id = users.id WHERE gurus.id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Fungsi menampilkan nama guru berdasarkan id guuru
    public function getAllWithUsername()
    {
        $query = "SELECT gurus.id, users.username 
              FROM gurus 
              JOIN users ON gurus.users_id = users.id
              ORDER BY users.username ASC";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGuruByEmail($email)
    {
        $sql = "SELECT u.id,
               u.role,
               g.id,
               u.username,
               u.password
        FROM users u
        LEFT JOIN gurus g ON g.users_id = u.id
        WHERE u.email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insert($data)
    {
        $query = "INSERT INTO gurus (
        users_id, Nik, Nuptk, StatusKepegawaian, JenisKelamin, 
        TempatLahir, TglLahir, NoHp, EmailMadrasah, Status, Penempatan
    ) VALUES (
        :users_id, :Nik, :Nuptk, :StatusKepegawaian, :JenisKelamin, 
        :TempatLahir, :TglLahir, :NoHp, :EmailMadrasah, :Status, :Penempatan
    )";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':users_id', $data['users_id']);
        $stmt->bindParam(':Nik', $data['Nik']);
        $stmt->bindParam(':Nuptk', $data['Nuptk']);
        $stmt->bindParam(':StatusKepegawaian', $data['StatusKepegawaian']);
        $stmt->bindParam(':JenisKelamin', $data['JenisKelamin']);
        $stmt->bindParam(':TempatLahir', $data['TempatLahir']);
        $stmt->bindParam(':TglLahir', $data['TglLahir']);
        $stmt->bindParam(':NoHp', $data['NoHp']);
        $stmt->bindParam(':EmailMadrasah', $data['EmailMadrasah']);
        $stmt->bindParam(':Status', $data['Status']);
        $stmt->bindParam(':Penempatan', $data['Penempatan']);
        $stmt->execute();
    }
    public function getJadwalByGuruId($guru_id)
    {
        $query = "SELECT jm.hari, jm.jam_mulai, jm.jam_selesai, 
                     m.Mapel, k.Kelas, jm.guru_pelajaran_id, gp.guru_id, gp.pelajaran_id
              FROM jadwal_mengajar jm
              JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
              JOIN mapel m ON gp.pelajaran_id = m.id
              JOIN kelas k ON jm.kelas_id = k.id
              WHERE gp.guru_id = :guru_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDataGuru($keyword = '')
    {
        if ($keyword) {
            $sql = "SELECT g.*, u.username, u.email FROM gurus g
                JOIN users u ON g.users_id = u.id
                WHERE u.username LIKE :keyword";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['keyword' => "%$keyword%"]);
        } else {
            $sql = "SELECT g.*, u.username, u.email FROM gurus g
                JOIN users u ON g.users_id = u.id";
            $stmt = $this->pdo->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getJadwalByGuru($guru_id)
    {
        $query = "SELECT jm.*, k.Kelas, p.nama_pelajaran
        FROM jadwal_mengajar jm
        JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
        JOIN guru g ON gp.guru_id = g.id
        JOIN pelajaran p ON gp.pelajaran_id = p.id
        JOIN kelas k ON jm.kelas_id = k.id
        WHERE gp.guru_id = :guru_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':guru_id', $guru_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getJumlahAbsensiGuru($guru_id, $semester_id)
    {
        $sql = "SELECT 
                u.username AS nama_guru,
                k.Kelas      AS nama_kelas,
                m.Mapel      AS nama_mapel,
                jm.id        AS jadwal_mengajar_id,
                COUNT(DISTINCT sd.tanggal) AS jumlah_absensi
            FROM siswa_detail sd
            JOIN jadwal_mengajar jm ON sd.jadwal_mengajar_id = jm.id
            JOIN kelas k ON jm.kelas_id = k.id
            -- hubungkan ke guru_pelajaran lalu ke mapel
            JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
            JOIN mapel m ON gp.pelajaran_id = m.id
            -- ambil info guru -> users
            JOIN gurus gr ON gp.guru_id = gr.id
            JOIN users u ON gr.users_id = u.id
            WHERE gr.id = :guru_id
              AND sd.semester_id = :semester_id
            GROUP BY jm.id, k.Kelas, m.Mapel, u.username
            ORDER BY jumlah_absensi DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':guru_id'     => $guru_id,
            ':semester_id' => $semester_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getKinerjaGuru($keywordSemester)
    {
        $sql = "SELECT 
                u.username AS nama_guru,
                m.Mapel,
                k.Kelas,
                COUNT(DISTINCT sd.tanggal) AS jumlah_pertemuan
            FROM siswa_detail sd
            JOIN jadwal_mengajar jm ON sd.jadwal_mengajar_id = jm.id
            JOIN guru_pelajaran gp ON jm.guru_pelajaran_id = gp.id
            JOIN gurus g ON gp.guru_id = g.id
            JOIN users u ON g.users_id = u.id
            JOIN mapel m ON gp.pelajaran_id = m.id
            JOIN kelas k ON jm.kelas_id = k.id
            WHERE sd.semester_id = :semester_id
            GROUP BY gp.id, jm.kelas_id
            ORDER BY u.username, k.Kelas";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':semester_id', $keywordSemester);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
