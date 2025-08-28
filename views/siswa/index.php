<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<a href="index.php?page=siswa&action=create" class="btn btn-success mb-3">Tambah siswa</a>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); // supaya tidak muncul lagi saat reload 
    ?>
<?php endif; ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); // supaya tidak muncul lagi saat reload 
    ?>
<?php endif; ?>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">

            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NISN</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs opacity-7">Aksi</th>
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
                        <td class="align-middle">
                            <a href="index.php?page=siswa&action=edit&Nik=<?= $siswa['Nik']; ?>" class="btn btn-warning "><i class="fa-solid fa-pen fa-lg"></i></a>
                            <button class="btn btn-danger" data-page="siswa" data-id="<?= $siswa['Nisn']; ?>"><i class=" fa-solid fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>