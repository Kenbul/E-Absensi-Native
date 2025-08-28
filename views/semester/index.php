<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); // supaya tidak muncul lagi saat reload 
    ?>
<?php endif; ?>
<a href="index.php?page=semester&action=create" class="btn btn-success">Tambah-Semester</a>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">

            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tahun-Ajaran</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal-Mulai</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal-Selesai</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($semester as $s) :
                ?><tr>
                        <td class=""><?= htmlspecialchars($s['nama_semester']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($s['tanggal_mulai']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($s['tanggal_selesai']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($s['status']) ?></td>
                        <td class="text-center">
                            <a href="index.php?page=semester&action=edit&id=<?= $s['id']; ?>" class="btn btn-warning "><i class="fa-solid fa-pen fa-lg"></i></a>
                            <button class="btn btn-danger" data-page="semester" data-id="<?= $s['id']; ?>"><i class=" fa-solid fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>