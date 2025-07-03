<?php
require_once 'model/JadwalMengajar.php';

class AbsensiController
{
    private $JadwalModel;

    public function __construct($pdo)
    {
        $this->JadwalModel = new JadwalMengajar($pdo);
    }

    public function index()
    {
        $guru_id = $_SESSION['user_id'];
        $page = 'Jadwal-Absensi-Siswa';
        $title = 'Absensi-Siswa';
        $jadwal = $this->JadwalModel->getByGuru();
        $absensi = $this->JadwalModel->showAbsensi($guru_id);
        // var_dump($absensi);
        // exit();
        include 'views/absensi/index.php';
    }
    public function showAbsensi($kelas)
    {
        $page = 'Form-Absensi';

        $Kelas = $this->JadwalModel->viewSiswa($kelas);
        $jadwal = $this->JadwalModel->getIdBykelas($kelas);
        include 'views/absensi/form-absensi.php';
    }

    public function addAbsensi()
    {
        require 'config/database.php';
        try {
            $query = " INSERT INTO siswa_detail ( id, jadwal_mengajar_id, siswa_nisn, status, tanggal, waktu_absen) 
            VALUES (NULL, :jadwal_mengajar_id, :siswa_nisn, :status, :tanggal, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':jadwal_mengajar_id'   => $_POST['jadwal_mengajar_id'],
                ':siswa_nisn'           => $_POST['siswa_nisn'],
                ':status'               => $_POST['status'],
                ':tanggal'              => $_POST['tanggal'],
            ]);
            $_SESSION['success'] = 'Absensi berhasil Dilakukan';
            header('Location: index.php?page=absensi');
            exit;
        } catch (PDOException $e) {
            // Tampilkan pesan error mentah hanya di lingkungan dev
            die('Gagal menambahkan data Absensi: ' . $e->getMessage());
        }
    }
    public function edit($id) {}
    public function update($id) {}
    public function delete($id) {}
}
