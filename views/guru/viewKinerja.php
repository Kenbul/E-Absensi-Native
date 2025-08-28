<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<?php if (isset($_SESSION['option'])) : ?>
    <div class="alert alert-warning" role="alert">
        <?= $_SESSION['option'] ?>
    </div>
    <?php unset($_SESSION['option']); // supaya tidak muncul lagi saat reload 
    ?>
<?php endif; ?>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama-Guru</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama-Mapel</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama-Kelas</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah-Pertemuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kinerja as $k) :
                ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($k['nama_guru']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($k['Mapel']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-center mb-0 text-xs"><?= htmlspecialchars($k['Kelas']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-center mb-0 text-xs"><?= htmlspecialchars($k['jumlah_pertemuan']); ?></h6>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>