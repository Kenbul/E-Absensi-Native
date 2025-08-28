<?php
require_once 'model/JadwalMengajar.php';


class JadwalMengajarController
{

    private $kelasModel;
    private $guruModel;
    private $mapelModel;
    private $JadwalModel;
    private $pdo;


    public function __construct($pdo)
    {
        $this->kelasModel = new Kelas($pdo);
        $this->guruModel = new guru($pdo);
        $this->mapelModel = new mapel($pdo);
        $this->JadwalModel = new JadwalMengajar($pdo);
        $this->pdo = $pdo;
    }
    public function index()
    {
        $page = 'Jadwal-Mengajar';
        $jadwal = $this->JadwalModel->getAll();
        // var_dump($jadwal);
        // exit();
        include 'views/jadwal-mengajar/index.php';
    }
    public function create()
    {
        $page = 'Tambah-Jadwal-mengajar';
        $guru = $this->guruModel->getAllWithUsername(); // Ambil data dari model
        $mapel = $this->mapelModel->getAll(); // Ambil data dari model
        $kelas = $this->kelasModel->getAll(); // Ambil data dari model
        // $hari = $this->getHari();
        // var_dump($hari);
        // exit(); // Ambil data dari model
        include 'views/jadwal-mengajar/tambah.php'; // Kirim data ke view
    }
    public function store()
    {
        include 'config/database.php';
        $guru_id = $_POST['guru_id'];
        $pelajaran_id = $_POST['pelajaran_id'];
        $kelas_id = $_POST['kelas_id'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        try {
            // 1. Masukkan ke tabel guru_pelajaran
            $queryGuruPelajaran = "INSERT INTO guru_pelajaran 
                               (guru_id, pelajaran_id) 
                               VALUES (:guru_id, :pelajaran_id)";
            $stmtGuruPelajaran = $pdo->prepare($queryGuruPelajaran);
            $stmtGuruPelajaran->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
            $stmtGuruPelajaran->bindParam(':pelajaran_id', $pelajaran_id, PDO::PARAM_INT);
            $stmtGuruPelajaran->execute();

            // 2. Ambil ID dari guru_pelajaran yang baru disimpan
            $guru_pelajaran_id = $pdo->lastInsertId();

            // 3. Masukkan ke tabel jadwal_mengajar dengan guru_pelajaran_id
            $queryJadwal = "INSERT INTO jadwal_mengajar 
                        (guru_pelajaran_id, kelas_id, hari, jam_mulai, jam_selesai) 
                        VALUES (:guru_pelajaran_id, :kelas_id, :hari, :jam_mulai, :jam_selesai)";

            $stmtJadwal = $pdo->prepare($queryJadwal);
            $stmtJadwal->bindParam(':guru_pelajaran_id', $guru_pelajaran_id, PDO::PARAM_INT);
            $stmtJadwal->bindParam(':kelas_id', $kelas_id, PDO::PARAM_INT);
            $stmtJadwal->bindParam(':hari', $hari, PDO::PARAM_STR);
            $stmtJadwal->bindParam(':jam_mulai', $jam_mulai, PDO::PARAM_STR);
            $stmtJadwal->bindParam(':jam_selesai', $jam_selesai, PDO::PARAM_STR);
            $stmtJadwal->execute();

            $_SESSION['success'] = "Jadwal mengajar berhasil ditambahkan!";
            header('Location: index.php?page=jadwal-mengajar');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Gagal menambahkan jadwal: " . $e->getMessage();
            header('Location: index.php?page=jadwal-mengajar&action=create');
            exit();
        }
    }

    public function edit($id)
    {
        $page = 'Edit Data kelas';
        $jadwal = $this->JadwalModel->findById($id);
        // var_dump($jadwal);
        // exit();
        $guru = $this->guruModel->getAllWithUsername(); // Ambil data dari model
        $mapel = $this->mapelModel->getAll(); // Ambil data dari model
        $kelas = $this->kelasModel->getAll();
        // var_dump($mapel);
        // exit();
        if (!$jadwal) {
            $_SESSION['error'] = "Data kelas tidak ditemukan!";
            header('Location: index.php?page=kelas');
            exit;
        }
        include 'views/jadwal-mengajar/edit.php'; // Tampilkan halaman edit
    }

    public function update($id)
    {
        include 'config/database.php';

        $guru_id = $_POST['guru_id'];
        $pelajaran_id = $_POST['pelajaran_id'];
        $kelas_id = $_POST['kelas_id'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];
        // var_dump($jam_selesai);
        // die;
        try {
            // Ambil guru_pelajaran_id dari jadwal_mengajar yang sedang diupdate
            $currentQuery = "SELECT guru_pelajaran_id FROM jadwal_mengajar WHERE id = :id";
            $currentStmt = $pdo->prepare($currentQuery);
            $currentStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $currentStmt->execute();
            $currentJadwal = $currentStmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($currentJadwal);
            // die;

            // Cek apakah kombinasi guru_id dan pelajaran_id sudah ada
            $checkQuery = "SELECT id FROM guru_pelajaran WHERE guru_id = :guru_id AND pelajaran_id = :pelajaran_id LIMIT 1";
            $checkStmt = $pdo->prepare($checkQuery);
            $checkStmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
            $checkStmt->bindParam(':pelajaran_id', $pelajaran_id, PDO::PARAM_INT);
            $checkStmt->execute();
            $guruPelajaran = $checkStmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($guruPelajaran);
            // die;

            if ($guruPelajaran) {
                $guru_pelajaran_id = $guruPelajaran['id'];
            } else {
                // Jika tidak ditemukan, buat entri baru
                $insertQuery = "INSERT INTO guru_pelajaran (guru_id, pelajaran_id) VALUES (:guru_id, :pelajaran_id)";
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
                $insertStmt->bindParam(':pelajaran_id', $pelajaran_id, PDO::PARAM_INT);
                $insertStmt->execute();
                $guru_pelajaran_id = $pdo->lastInsertId();
            }
            $dupeQuery = "SELECT COUNT(*) FROM jadwal_mengajar 
                        WHERE guru_pelajaran_id = :guru_pelajaran_id 
                        AND kelas_id = :kelas_id 
                        AND hari = :hari 
                        AND jam_mulai = :jam_mulai 
                        AND jam_selesai = :jam_selesai 
                        AND id != :id";

            $dupeStmt = $pdo->prepare($dupeQuery);
            $dupeStmt->bindParam(':guru_pelajaran_id', $guru_pelajaran_id, PDO::PARAM_INT);
            $dupeStmt->bindParam(':kelas_id', $kelas_id, PDO::PARAM_INT);
            $dupeStmt->bindParam(':hari', $hari, PDO::PARAM_STR);
            $dupeStmt->bindParam(':jam_mulai', $jam_mulai, PDO::PARAM_STR);
            $dupeStmt->bindParam(':jam_selesai', $jam_selesai, PDO::PARAM_STR);
            $dupeStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $dupeStmt->execute();

            if ($dupeStmt->fetchColumn() > 0) {
                $_SESSION['error'] = "Jadwal dengan kombinasi tersebut sudah ada!";
                header("Location: index.php?page=jadwal-mengajar&action=edit&id=" . $id);
                exit();
            }


            // Update jadwal_mengajar
            $updateJadwal = "UPDATE jadwal_mengajar 
                SET guru_pelajaran_id = :guru_pelajaran_id,
                    kelas_id = :kelas_id,
                    hari = :hari,
                    jam_mulai = :jam_mulai,
                    jam_selesai = :jam_selesai
                WHERE id = :id";

            $stmt = $pdo->prepare($updateJadwal);
            $stmt->bindParam(':guru_pelajaran_id', $guru_pelajaran_id, PDO::PARAM_INT);
            $stmt->bindParam(':kelas_id', $kelas_id, PDO::PARAM_INT);
            $stmt->bindParam(':hari', $hari, PDO::PARAM_STR);
            $stmt->bindParam(':jam_mulai', $jam_mulai, PDO::PARAM_STR);
            $stmt->bindParam(':jam_selesai', $jam_selesai, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['success'] = "Jadwal mengajar berhasil diupdate!";
            header('Location: index.php?page=jadwal-mengajar');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Gagal mengupdate jadwal: " . $e->getMessage();
            header("Location: index.php?page=jadwal-mengajar&action=edit&id=" . $id);
            exit();
        }
    }

    public function delete($id)
    {
        include 'config/database.php';
        try {
            // Hapus data kelas berdasarkan ID
            $query = "DELETE FROM jadwal_mengajar WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data jadwal_mengajar berhasil dihapus!";
            header('Location: index.php?page=jadwal-mengajar');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data jadwal_mengajar: " . $e->getMessage();
        }
    }
    public function getHari()
    {
        // Array hari dalam bahasa Inggris dan Indonesia
        $hari = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            // 'Sunday'    => 'Minggu'
        ];

        return $hari;
    }
}
