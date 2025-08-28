<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="row">

    <form action="index.php?page=absensi&action=addAbsensi" method="post">
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); // supaya tidak muncul lagi saat reload 
            ?>
        <?php endif; ?>
        <button type="submit" class="col-6 btn btn-success">Absensi</button>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">NISN</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Kelas as $row) : ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($row['Nisn']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['Nama']) ?></td>
                                <td class="text-center">
                                    <input type="hidden" name="jadwal_mengajar_id" value="<?= $jadwal['jadwal_mengajar_id'] ?>">
                                    <input type="hidden" name="pelajaran_id" value="<?= $jadwal['pelajaran_id'] ?>">
                                    <input type="hidden" name="kelas_id" value="<?= $jadwal['kelas_id'] ?>">
                                    <input type="hidden" name="siswa_nisn[]" value="<?= $row['Nisn'] ?>">
                                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                                    <select name="status[]" class="form-select text-center">
                                        <option value="Alpha">Alfa</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Hadir">Hadir</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>

</div>

<?php include "views/layouts/footer.php" ?>