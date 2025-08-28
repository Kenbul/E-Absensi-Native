<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>

<div class="row mb-3">
    <div class="col">
        <h3>Laporan Persentase Absensi</h3>
        <p class="text-sm text-muted">
            Periode: <?= htmlspecialchars($mulai) ?> s/d <?= htmlspecialchars($akhir) ?>
        </p>
    </div>
    <div class="col text-end">
        <a href="index.php?page=laporan&action=pdf&guru_id=<?= $guru_id; ?>&kelas_id=<?= $kelas_id; ?>&mapel_id=<?= $mapel_id; ?>&tgl_mulai=<?= $mulai; ?>&tgl_selesai=<?= $akhir; ?>"
            class="btn btn-outline-danger">
            Generate <i class="fa-solid fa-file-pdf"></i>
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-items-center mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Mapel</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpha</th>
                    <th>Total Pertemuan</th>
                    <th>% Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
                            <td><?= htmlspecialchars($row['Nisn']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kelas']); ?></td>
                            <td><?= htmlspecialchars($row['Mapel']); ?></td>
                            <td class="text-center"><?= $row['total_hadir']; ?></td>
                            <td class="text-center"><?= $row['total_izin']; ?></td>
                            <td class="text-center"><?= $row['total_sakit']; ?></td>
                            <td class="text-center"><?= $row['total_alpha']; ?></td>
                            <td class="text-center"><?= $row['total_pertemuan']; ?></td>
                            <td class="text-center">
                                <span class="badge 
                                    <?= ($row['persen_hadir'] >= 80) ? 'bg-success' : (($row['persen_hadir'] >= 60) ? 'bg-warning' : 'bg-danger') ?>">
                                    <?= $row['persen_hadir']; ?>%
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data absensi pada periode ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>