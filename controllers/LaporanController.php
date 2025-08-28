<?php
require_once 'model/Laporan.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController
{
    private $kelasModel;
    private $mapelModel;
    private $guruModel;
    private $laporanModel;
    private $JadwalModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->kelasModel = new Kelas($pdo);
        $this->mapelModel = new Mapel($pdo);
        $this->guruModel = new guru($pdo);
        $this->laporanModel = new Laporan($pdo);
        $this->JadwalModel = new JadwalMengajar($pdo);
        $this->pdo = $pdo;
    }

    public function index()
    {
        $page = 'Laporan';
        $guru = $this->guruModel->getAllWithUsername();
        $kelas = $this->kelasModel->getAll();
        $mapel = $this->mapelModel->getAll();
        include 'views/laporan/index.php';
    }
    public function create()
    {
        $page = 'Hasil Laporan';
        $guru_id  = (int)($_POST['guru_id']   ?? 0);
        $kelas_id = (int)($_POST['kelas_id']  ?? 0);
        $mapel_id = (int)($_POST['mapel_id']  ?? 0);
        $mulai   = $_POST['tanggalMulai']       ?? '';
        $akhir   = $_POST['tanggalAkhir']     ?? '';
        // var_dump($akhir);
        // exit();

        // validasi sederhana
        if (!$guru_id || !$kelas_id || !$mapel_id || !$mulai || !$akhir) {
            $_SESSION['error'] = 'Semua field wajib diisi.';
            header('Location: index.php?page=laporan');
            exit;
        }

        // panggil model
        $data = $this->laporanModel->getLaporanAbsensiPersentase(
            $guru_id,
            $mapel_id,
            $kelas_id,
            $mulai,
            $akhir
        );
        // var_dump($data);
        // die;
        // var_dump($data);
        // exit();
        // lempar ke view hasil
        include 'views/laporan/view.php';
    }

    public function exportPdf(): void
    {
        ob_start();
        // Ambil filter dari GET/POST (sama seperti metode proses())
        $idGuru  = (int)($_GET['guru_id']  ?? 0);
        $idKelas = (int)($_GET['kelas_id'] ?? 0);
        $idMapel = (int)($_GET['mapel_id'] ?? 0);
        $mulai   = $_GET['tgl_mulai'] ?? '';
        $akhir   = $_GET['tgl_selesai'] ?? '';
        // var_dump($mulai);
        // die;

        // Ambil data laporan
        $data = $this->laporanModel->getLaporanAbsensiPersentase(
            $idGuru,
            $idMapel,
            $idKelas,
            $mulai,
            $akhir
        );
        // var_dump($data);
        // exit();

        // Ambil nama guru & kelas (query sederhana)
        $mapelRow = $this->mapelModel->findById($idMapel);
        $guruRow  = $this->guruModel->nameById($idGuru);   // buat helper di model
        $kelasRow = $this->kelasModel->findById($idKelas);
        // var_dump($kelasRow);
        // exit();
        // Render view ke string HTML

        $namaGuru  = $guruRow['Nama']   ?? '-';
        $namaKelas = $kelasRow['Kelas'] ?? '-';
        $namaMapel = $mapelRow['Mapel'] ?? '-';
        // var_dump($namaGuru);
        // exit();
        include 'views/laporan/pdf.php';
        $html = ob_get_clean();

        // Konfigurasi Dompdf
        require_once 'vendor/autoload.php';
        $options = new Options();
        $options->set('isRemoteEnabled', true);  // tidak perlu remote image
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nama file
        $filename = "laporan_absensi_{$namaGuru}_{$namaKelas}_{$mulai}_{$akhir}.pdf";

        // Output ke browser
        header('Content-Type: application/pdf');
        header("Content-Disposition: inline; filename=\"$filename\"");
        echo $dompdf->output();
        exit;
    }
}
