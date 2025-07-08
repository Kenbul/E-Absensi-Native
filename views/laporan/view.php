<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="row">
    <div class="col">
        <h3>Laporan Absensi</h3>
    </div>
    <div class="col">
        <a href="index.php?page=laporan&action=pdf&guru_id=<?= $guru_id; ?>&kelas_id=<?= $kelas_id; ?>&tgl_mulai=<?= $mulai; ?>&tgl_selesai=<?= $akhir; ?>" class="btn btn-outline-danger">Generete <i class="fa-solid fa-file-pdf"></i></a>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nisn</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <div class="my-auto">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($row['nama_siswa']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-normal mb-0"><?= $row['Nisn']; ?></p>
                        </td>
                        <td>
                            <span class="badge badge-dot me-4">
                                <i class="bg-info"></i>
                                <span class="text-dark text-xs"><?= $row['status']; ?></span>
                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <div class="d-flex align-items-center">
                                <?= $row['tanggal']; ?>
                            </div>
                        </td>

                        <td class="align-middle">

                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>


<?php include "views/layouts/footer.php" ?>