<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
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
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($jadwal as $j) :
                ?><tr>
                        <td class="text-center"><?= htmlspecialchars($j['hari']) ?></td>
                        <td><?= htmlspecialchars($j['Mapel']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['Kelas']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['jam_mulai']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['jam_selesai']) ?></td>
                        <td class="text-center">
                            <a href="index.php?page=guru&action=view_kinerja&id=<?= $j['guru_id'] ?>" class="btn btn-secondary">Lihat-Kinerja</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>