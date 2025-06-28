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

        // Ambil data dari form
        // $data = [
        //     'guru_id' => $_POST['guru_id'],
        //     'pelajaran_id' => $_POST['pelajaran_id'],
        //     'kelas_id' => $_POST['kelas_id'],
        //     'hari' => $_POST['hari'],
        //     'jam_mulai' => $_POST['jam_mulai'],
        //     'jam_selesai' => $_POST['jam_selesai'],
        // ];
        // var_dump($data);
        // exit();
        $guru_id = $_POST['guru_id'];
        $pelajaran_id = $_POST['pelajaran_id'];
        $kelas_id = $_POST['kelas_id'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        try {

            $queryGuruPelajaran = "INSERT INTO guru_pelajaran 
                              (guru_id, pelajaran_id) 
                              VALUES (:guru_id, :pelajaran_id)";
            $stmtGuruPelajaran = $pdo->prepare($queryGuruPelajaran);
            $stmtGuruPelajaran->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
            $stmtGuruPelajaran->bindParam(':pelajaran_id', $pelajaran_id, PDO::PARAM_INT);
            $stmtGuruPelajaran->execute();


            $queryJadwal = "INSERT INTO jadwal_mengajar 
            (guru_id, kelas_id, hari, jam_mulai, jam_selesai) 
            VALUES (:guru_id, :kelas_id, :hari, :jam_mulai, :jam_selesai)";

            $stmtJadwal = $pdo->prepare($queryJadwal);
            $stmtJadwal->bindParam(':guru_id', $guru_id, PDO::PARAM_INT);
            $stmtJadwal->bindParam(':kelas_id', $kelas_id, PDO::PARAM_INT);
            $stmtJadwal->bindParam(':hari', $hari, PDO::PARAM_STR);
            $stmtJadwal->bindParam(':jam_mulai', $jam_mulai, PDO::PARAM_STR);
            $stmtJadwal->bindParam(':jam_selesai', $jam_selesai, PDO::PARAM_STR);
            $stmtJadwal->execute();
            // var_dump($stmtJadwal);
            // exit();
            $_SESSION['success'] = "Jadwal mengajar berhasil ditambahkan!";

            // Redirect ke halaman index jadwal
            header('Location: index.php?page=jadwal-mengajar');
            exit(); // Pastikan script berhenti setelah redirect

        } catch (PDOException $e) {
            // ❌ Simpan pesan error ke session
            $_SESSION['error'] = "Gagal menambahkan jadwal: " . $e->getMessage();

            // Redirect kembali ke form
            header('Location: index.php?page=jadwal-mengajar&action=create');
            exit();
        }
    }
    public function edit($id)
    {
        $page = 'Edit Data kelas';
        $kelas = $this->kelasModel->findById($id);
        // var_dump($kelas);
        // die;
        if (!$kelas) {
            $_SESSION['error'] = "Data kelas tidak ditemukan!";
            header('Location: index.php?page=kelas');
            exit;
        }
        include 'views/kelas/edit.php'; // Tampilkan halaman edit
    }

    public function update($id)
    {
        include 'config/database.php';
        $Kelas = $_POST['Kelas'];

        try {
            $queryUser = "UPDATE kelas SET Kelas = :Kelas, created_at = NOW(), updated_at = NOW() WHERE kelas.id = $id";
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':Kelas', $Kelas);
            $stmtUser->execute();
            header('Location: index.php?page=kelas');
            $_SESSION['success'] = "Data kelas berhasil diperbaharui!";
            exit;
        } catch (PDOException $e) {
            echo "Gagal memperbarui data: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        include 'config/database.php';
        try {
            // Hapus data kelas berdasarkan ID
            $query = "DELETE FROM kelas WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data kelas berhasil dihapus!";
            header('Location: index.php?page=kelas');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data kelas: " . $e->getMessage();
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
