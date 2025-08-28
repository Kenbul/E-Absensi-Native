<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<a href="index.php?page=guru&action=create" class="btn btn-success mb-3">Tambah Guru</a>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guru</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                    <th class="text-secondary text-uppercase text-xxs opacity-7">Aksi</th>
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
                            <a href="index.php?page=guru&action=edit&id=<?= $guru['id']; ?>" class="btn btn-warning "><i class="fa-solid fa-pen fa-lg"></i></a>
                            <button class="btn btn-danger" data-page="guru" data-id="<?= $guru['id']; ?>"><i class="fa-solid fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>