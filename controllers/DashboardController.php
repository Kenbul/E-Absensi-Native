<?php


class DashboardController
{
    private $guruModel;
    private $SiswaModel;
    private $JadwalModel;

    public function __construct($pdo)
    {
        $this->guruModel = new guru($pdo);
        $this->SiswaModel = new Siswa($pdo);
        $this->JadwalModel = new JadwalMengajar($pdo);
    }
    public function index()
    {
        $keywordGuru = $_GET['keyword_guru'] ?? '';
        $keywordSiswa = $_GET['keyword_siswa'] ?? '';
        $filterKelas = $_GET['kelas_id'] ?? '';
        $guru_id = $_SESSION['user_id'];
        $page = 'Dahsboard';
        if ($filterKelas === '') {
            $jadwal = $this->JadwalModel->getAll();
        } else {
            $jadwal = $this->JadwalModel->getByKelas($filterKelas);
        }
        if ($_SESSION['role'] == 'Guru') {
            $jadwal = $this->JadwalModel->getByGuru($guru_id);
        }
        $dataGuru = $dataguru = $this->guruModel->getDataGuru($keywordGuru);
        $datasiswa = $this->SiswaModel->getDataSiswa($keywordSiswa);
        require_once 'views/layouts/dashboard.php';
    }
}
