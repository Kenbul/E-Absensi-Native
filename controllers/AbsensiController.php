<?php
require_once 'model/JadwalMengajar.php';
require_once 'model/siswa_detail.php';

class AbsensiController
{
    private $JadwalModel;
    private $absensiModel;

    public function __construct($pdo)
    {
        $this->JadwalModel = new JadwalMengajar($pdo);
        $this->absensiModel = new siswa_detail($pdo);
    }

    public function index()
    {
        $guru_id  = $_SESSION['user_id'];
        $kelas_id = $_GET['kelas_id'] ?? '';
        $mapel_id = $_GET['mapel_id'] ?? '';

        $page  = 'Jadwal-Absensi-Siswa';
        $title = 'Absensi Siswa';

        // Ambil daftar kelas dan mapel untuk dropdown filter
        $kelasList = $this->JadwalModel->getKelasByGuru($guru_id);
        $mapelList = $this->JadwalModel->getMapelByGuru($guru_id);

        // Ambil data absensi sesuai filter
        $absensi = [];
        if (!empty($kelas_id) && !empty($mapel_id)) {
            $absensi = $this->JadwalModel->showAbsensiFiltered($guru_id, $kelas_id, $mapel_id);
        }

        include 'views/absensi/index.php';
    }

    public function showAbsensi($kelas)
    {
        $page = 'Form-Absensi';
        $guru_id = $_SESSION['user_id'];
        $pelajaran_id = $_GET['mapel_id'];

        // Data siswa di kelas
        $Kelas = $this->JadwalModel->viewSiswa($kelas);

        // Detail jadwal
        $jadwal = $this->JadwalModel->getDetailByKelas($kelas, $guru_id, $pelajaran_id);

        // Data absensi
        $absensi = $this->JadwalModel->getAbsensiByKelasMapel($kelas, $guru_id, $pelajaran_id);

        include 'views/absensi/form-absensi.php';
    }


    public function addAbsensi()
    {
        require 'config/database.php';

        $jadwal_mengajar_id = $_POST['jadwal_mengajar_id'];
        $pelajaran_id = $_POST['pelajaran_id'];
        $kelas_id = $_POST['kelas_id'];
        $semester_id = $_SESSION['semester_id'];
        $tanggal = $_POST['tanggal'];

        try {
            // Validasi: Cegah absensi ganda
            $queryCheck = "SELECT COUNT(*) FROM siswa_detail 
                       WHERE jadwal_mengajar_id = :jadwal_mengajar_id 
                       AND tanggal = :tanggal";
            $stmtCheck = $pdo->prepare($queryCheck);
            $stmtCheck->execute([
                ':jadwal_mengajar_id' => $jadwal_mengajar_id,
                ':tanggal' => $tanggal
            ]);
            $absensiCount = $stmtCheck->fetchColumn();

            if ($absensiCount > 0) {
                $_SESSION['error'] = 'Tidak dapat melakukan Absensi kembali, Absensi untuk tanggal ini sudah dilakukan.';
                header('Location: index.php?page=absensi&action=showAbsensi&kelas=' . $kelas_id . '&mapel_id=' . $pelajaran_id);
                exit;
            }

            // Lanjut insert
            $query = "INSERT INTO siswa_detail (id, jadwal_mengajar_id, siswa_nisn, status, tanggal, waktu_absen, semester_id) 
                  VALUES (NULL, :jadwal_mengajar_id, :siswa_nisn, :status, :tanggal, NOW(), :semester_id)";
            $stmt = $pdo->prepare($query);

            $count = count($_POST['siswa_nisn']);
            for ($i = 0; $i < $count; $i++) {
                $stmt->execute([
                    ':jadwal_mengajar_id' => $jadwal_mengajar_id,
                    ':siswa_nisn'         => $_POST['siswa_nisn'][$i],
                    ':status'             => $_POST['status'][$i],
                    ':tanggal'            => $tanggal,
                    ':semester_id'        => $semester_id,
                ]);
            }

            $_SESSION['success'] = 'Absensi berhasil dilakukan untuk semua siswa.';
            header('Location: index.php?page=absensi');
            exit;
        } catch (PDOException $e) {
            die('Gagal menambahkan data Absensi: ' . $e->getMessage());
        }
    }
    public function editAbsensi($id)
    {
        $id = (int)($_GET['id'] ?? 0);
        $absensi = $this->absensiModel->findById($id);

        if (!$absensi) {
            $_SESSION['error'] = "Data absensi tidak ditemukan.";
            header('Location: index.php?page=absensi');
            exit;
        }

        // Cek apakah masih dalam 24 jam
        if ((strtotime('now') - strtotime($absensi['tanggal'])) > 86400) {
            $_SESSION['error'] = "Data absensi sudah terkunci dan tidak bisa diubah.";
            header('Location: index.php?page=absensi');
            exit;
        }

        $page = "Edit Absensi";
        include 'views/absensi/edit.php';
    }

    public function updateAbsensi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $status = $_POST['status'] ?? '';

            $absensi = $this->absensiModel->findById($id);
            if (!$absensi) {
                $_SESSION['error'] = "Data absensi tidak ditemukan.";
                header('Location: index.php?page=absensi');
                exit;
            }

            if ((strtotime('now') - strtotime($absensi['tanggal'])) > 86400) {
                $_SESSION['error'] = "Data absensi sudah terkunci dan tidak bisa diubah.";
                header('Location: index.php?page=absensi');
                exit;
            }

            $this->absensiModel->updateStatus($id, $status);
            $_SESSION['success'] = "Data absensi berhasil diperbarui.";
            header('Location: index.php?page=absensi');
            exit;
        }
    }
    public function edit($id) {}
    public function update($id) {}
    public function delete($id) {}
}
