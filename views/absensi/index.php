<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<h1><?php echo  $page ?></h1>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">

            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
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
                        <td class="text-center"><?= htmlspecialchars($j['Kelas']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['jam_mulai']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($j['jam_selesai']) ?></td>
                        <td><a href="index.php?page=absensi&action=showAbsensi&kelas=<?= $j['kelas_id']; ?>" class="btn btn-success">Absensi</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<h3><?php echo  $title ?></h3>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">

            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama-Siswa</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status-Absensi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($absensi as $a) :
                ?><tr>
                        <td class="text-center"><?= htmlspecialchars($a['Kelas']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($a['nama_siswa']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($a['tanggal']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($a['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>