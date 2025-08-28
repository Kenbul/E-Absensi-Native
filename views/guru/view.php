<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('/assets/img/Gambar-Sekolah.jpg');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="" alt="<?= $guru['username'] ?>" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        <?= $guru['username'] ?>
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        <?= $guru['Status'] ?>/<?= $guru['StatusKepegawaian'] ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <?php if ($_SESSION['role'] == 'Kepala Sekolah') : ?>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " href="index.php?page=guru&action=kinerja&id=<?= $guru['id'] ?>" role="tab" aria-selected="false">
                                    <i class="fa-solid fa-chart-simple"></i>
                                    <span class="ms-1">Kinerja</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Keterangan</h6>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Pendidikan</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 px-0">
                                    <h6>Nik : <?= $guru['Nik'] ?></h6>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <h6>Nuptk : <?= $guru['Nuptk'] ?></h6>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <h6>Email-Madrasah : <?= $guru['EmailMadrasah'] ?></h6>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="card-body p-3">
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Personal</h6>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 px-0">
                                        <h6>Jenis-Kelamin : <?= $guru['JenisKelamin'] ?></h6>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <h6>Tanggal-Lahir : <?= $guru['TglLahir'] ?></h6>
                                    </li>
                                    <li class="list-group-item border-0 px-0 pb-0">
                                        <h6>Tempat-Lahir : <?= $guru['TempatLahir'] ?></h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">

                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " href="index.php?page=guru&action=view_kinerja&id=<?= $guru['id'] ?>">
                                    <span class="ms-1">Kinerja-Guru</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <?php if (isset($_SESSION['danger'])) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $_SESSION['danger'] ?>
                                </div>
                                <?php unset($_SESSION['danger']); // supaya tidak muncul lagi saat reload 
                                ?>
                            <?php endif; ?>
                            <?php foreach ($jadwal as $j): ?>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $j['Mapel'] ?></h6>
                                    <p class="mb-0 text-xs"><?= $j['jam_mulai'] ?>|<?= $j['jam_selesai'] ?> | <?= $j['Kelas'] ?> </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>