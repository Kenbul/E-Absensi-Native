<?php
require_once 'model/Siswa.php';
require_once 'model/Kelas.php';

class SiswaController
{
    private $SiswaModel;
    private $KelasModel;

    public function __construct($pdo)
    {
        $this->SiswaModel = new Siswa($pdo);
        $this->KelasModel = new Kelas($pdo);
    }


    // Fungsi untuk menampilkan halaman index Siswa
    public function index()
    {
        $page = 'Data Santri';
        $datasiswa = $this->SiswaModel->getAll();
        include 'views/siswa/index.php';
    }
    public function create()
    {
        $page = 'Tambah Data Santri';
        $Siswa = $this->SiswaModel->getAll(); // Ambil data dari model
        $datakelas = $this->KelasModel->getAll();
        include 'views/Siswa/tambah.php'; // Kirim data ke view
    }
    public function store()
    {
        require 'config/database.php';      // $pdo harus ada!

        // Validasi minimal (mis. pastikan Nama tidak kosong) bisa ditambah di sini

        try {
            $sql = "INSERT INTO siswa
                    (Nama, Nisn, Nik, TempatLahir, TanggalLahir, Status, JenisKelamin,
                     Alamat, NoTelp, NamaAyah, NamaIbu, NamaWali, Kelas)
                    VALUES
                    (:Nama, :Nisn, :Nik, :TempatLahir, :TanggalLahir, :Status, :JenisKelamin,
                     :Alamat, :NoTelp, :NamaAyah, :NamaIbu, :NamaWali, :Kelas)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':Nama'         => $_POST['Nama'],
                ':Nisn'         => $_POST['Nisn'],
                ':Nik'          => $_POST['Nik'],
                ':TempatLahir'  => $_POST['TempatLahir'],
                ':TanggalLahir' => $_POST['TanggalLahir'],
                ':Status'       => $_POST['Status'],
                ':JenisKelamin' => $_POST['JenisKelamin'],
                ':Alamat'       => $_POST['Alamat'],
                ':NoTelp'       => $_POST['NoTelp'],
                ':NamaAyah'     => $_POST['NamaAyah'],
                ':NamaIbu'      => $_POST['NamaIbu'],
                ':NamaWali'     => $_POST['NamaWali'],
                ':Kelas'        => $_POST['Kelas'],
            ]);
            // var_dump($stmt);
            // exit();

            $_SESSION['success'] = 'Data Santri berhasil ditambahkan';
            header('Location: index.php?page=siswa');
            exit;
        } catch (PDOException $e) {
            // Tampilkan pesan error mentah hanya di lingkungan dev
            die('Gagal menambahkan data Santri: ' . $e->getMessage());
        }
    }

    public function edit($Nik)
    {
        $page = 'Edit Data Santri';
        $Siswa = $this->SiswaModel->findById($Nik);
        // var_dump($Siswa);
        // die;
        if (!$Siswa) {
            $_SESSION['error'] = "Data Santri tidak ditemukan!";
            header('Location: index.php?page=Siswa');
            exit;
        }
        include 'views/Siswa/edit.php'; // Tampilkan halaman edit
    }

    public function update($Nik)
    {
        include 'config/database.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Nisn = $_POST['Nisn']; // ini jadi acuan untuk WHERE, bukan untuk update.
            // var_dump($_POST['Nisn']);
            // exit();
            $Nama = $_POST['Nama'];
            $Nik = $_POST['Nik'];
            $TempatLahir = $_POST['TempatLahir'];
            $TanggalLahir = $_POST['TanggalLahir'];
            $Status = $_POST['Status'];
            $JenisKelamin = $_POST['JenisKelamin'];
            $Alamat = $_POST['Alamat'];
            $NoTelp = $_POST['NoTelp'];
            $NamaAyah = $_POST['NamaAyah'];
            $NamaIbu = $_POST['NamaIbu'];
            $NamaWali = $_POST['NamaWali'];
            $Kelas = $_POST['Kelas'];
            // var_dump($Kelas);
            // exit();

            try {
                $query = "UPDATE Siswa SET 
                    Nama = :Nama,
                    Nik = :Nik,
                    TempatLahir = :TempatLahir,
                    TanggalLahir = :TanggalLahir,
                    Status = :Status,
                    JenisKelamin = :JenisKelamin,
                    Alamat = :Alamat,
                    NoTelp = :NoTelp,
                    NamaAyah = :NamaAyah,
                    NamaIbu = :NamaIbu,
                    NamaWali = :NamaWali,
                    Kelas = :Kelas
                    WHERE Nisn = :Nisn";

                $stmt = $pdo->prepare($query);

                $stmt->bindParam(':Nama', $Nama);
                $stmt->bindParam(':Nik', $Nik);
                $stmt->bindParam(':TempatLahir', $TempatLahir);
                $stmt->bindParam(':TanggalLahir', $TanggalLahir);
                $stmt->bindParam(':Status', $Status);
                $stmt->bindParam(':JenisKelamin', $JenisKelamin);
                $stmt->bindParam(':Alamat', $Alamat);
                $stmt->bindParam(':NoTelp', $NoTelp);
                $stmt->bindParam(':NamaAyah', $NamaAyah);
                $stmt->bindParam(':NamaIbu', $NamaIbu);
                $stmt->bindParam(':NamaWali', $NamaWali);
                $stmt->bindParam(':Kelas', $Kelas);
                $stmt->bindParam(':Nisn', $Nisn);

                $stmt->execute();

                $_SESSION['success'] = "Data siswa berhasil diupdate!";
                header('Location: index.php?page=siswa');
                exit();
            } catch (PDOException $e) {
                echo "Gagal update data: " . $e->getMessage();
            }
        }
    }
    public function delete($Nisn)
    {
        include 'config/database.php';
        try {
            // Hapus data Siswa berdasarkan ID
            $query = "DELETE FROM siswa WHERE Nisn = :nisn";
            $stmt  = $pdo->prepare($query);
            $stmt->bindValue(':nisn', $Nisn, PDO::PARAM_INT);
            $stmt->execute();

            // Set pesan sukses menggunakan session
            $_SESSION['success'] = "Data Santri berhasil dihapus!";
            header('Location: index.php?page=siswa');
            exit;
        } catch (PDOException $e) {
            echo "Gagal menghapus data Santri: " . $e->getMessage();
        }
    }
}
