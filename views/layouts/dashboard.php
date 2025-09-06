<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
require_once 'config/config.php';
protectRoute();
$currentTime = date("H:i:s");


include './config/database.php';
// Ambil jumlah guru
try {
    $stmtGuru = $pdo->query("SELECT COUNT(*) AS total_guru FROM gurus");
    $dataGuru = $stmtGuru->fetch(PDO::FETCH_ASSOC);
    $totalGuru = $dataGuru['total_guru'];

    // Ambil jumlah siswa
    $stmtSiswa = $pdo->query("SELECT COUNT(*) AS total_siswa FROM siswa");
    $dataSiswa = $stmtSiswa->fetch(PDO::FETCH_ASSOC);
    $totalSiswa = $dataSiswa['total_siswa'];
} catch (PDOException $e) {
    die('Query gagal: ' . $e->getMessage());
}
?>


<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include "views/layouts/navbar.php" ?>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <div class="row mb-4">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                <p class="mb-4">

                </p>
            </div>
            <?php if ($_SESSION['role'] == 'Kepala Madrasah') : ?>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Jumlah Guru</p>
                                    <h4 class="mb-0"><?= $totalGuru ?></h4>
                                </div>
                                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">weekend</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Jumlah Siswa</p>
                                    <h4 class="mb-0"><?= $totalSiswa ?></h4>
                                </div>
                                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">person</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
                        </div>
                    </div>
                </div>
            <?php endif;  ?>
        </div>
        <?php if ($_SESSION['role'] == 'Kepala Madrasah' and 'Admin') : ?>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Guru</h6>
                                    <form action="index.php" method="get" style="margin-bottom: 1rem;">
                                        <input type="hidden" name="page" value="dashboard">
                                        <input type="text" name="keyword_guru" placeholder="Cari Guru...">
                                        <button type="submit">Cari Guru</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">

                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guru</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataguru as $guru) :
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1"><?= $no++; ?></div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs"><?= htmlspecialchars($guru['username']); ?></h6>
                                                            <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($guru['email']); ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($guru['StatusKepegawaian']); ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($guru['Penempatan']); ?></p>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-normal"><?= htmlspecialchars($guru['Status']); ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="index.php?page=guru&action=view&id=<?= $guru['id']; ?>" class="btn btn-secondary"><i class="fa-regular fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['role'] == 'Kepala Madrasah') : ?>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <form action="index.php" method="get" class="p-3">
                            <input type="hidden" name="page" value="dashboard">
                            <div class="col input-group input-group-dynamic mb-4 ">
                                <select name="kelas_id" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    <option value="1">7</option>
                                    <option value="2">8</option>
                                    <option value="3">9</option>
                                </select>
                            </div>
                            <button type="submit">Pilih</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama-Guru</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam-Masuk</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam-Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jadwal as $j) :
                                    ?><tr>
                                            <td class="text-center"><?= htmlspecialchars($j['hari']) ?></td>
                                            <td class=""><?= htmlspecialchars($j['nama_guru']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($j['Kelas']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($j['jam_mulai']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($j['jam_selesai']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['role'] == 'Admin') : ?>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Siswa</h6>
                                    <form action="index.php" method="get" style="margin-bottom: 1rem;">
                                        <input type="hidden" name="page" value="dashboard">
                                        <input type="text" name="keyword_siswa" placeholder="Cari siswa...">
                                        <button type="submit">Cari Siswa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">

                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NISN</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($datasiswa as $siswa) :
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1"><?= $no++; ?></div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs"><?= htmlspecialchars($siswa['Nama']); ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs"><?= htmlspecialchars($siswa['Nisn']); ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs"><?= htmlspecialchars($siswa['Status']); ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['role'] == 'Guru') : ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">

                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mata-Pelajaran</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam-Masuk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam-Keluar</th>
                                <th class="text-secondary opacity-7">Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jadwal as $j) :
                            ?><tr>
                                    <td class="text-center"><?= htmlspecialchars($j['hari']) ?></td>
                                    <td class=""><?= htmlspecialchars($j['Mapel']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($j['Kelas']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($j['jam_mulai']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($j['jam_selesai']) ?></td>
                                    <td>
                                        <?php if ($currentTime >= $j['jam_mulai'] && $currentTime <= $j['jam_selesai']): ?>
                                            <a href="index.php?page=absensi&action=showAbsensi&kelas=<?= $j['kelas_id'] ?>&mapel_id=<?= $j['mapel_id'] ?>" class="btn btn-success">Absensi</a>
                                        <?php else: ?>
                                            <button class="btn btn-secondary" disabled>Di Luar Jam</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        <?php include "views/layouts/footer.php" ?>