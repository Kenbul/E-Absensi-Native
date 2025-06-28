<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<h1>Jadwal-Mengajar</h1>
<a href="index.php?page=jadwal-mengajar&action=create" class="btn btn-success">+ Tambah-Jadwal</a>
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
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Guru</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam-Masuk</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam-Keluar</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($jadwal as $j) :
                ?><tr>
                        <td class="text-center"><?= htmlspecialchars($j['hari']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['nama_guru']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['Kelas']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['jam_mulai']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['jam_selesai']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>