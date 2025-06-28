<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="row">
    <h1 class="col-6"><?php echo  $page ?></h1>
    <form action="index.php?page=absensi&action=addAbsensi" method="post">
        <button type="submit" class="col-6 btn btn-success">Absensi</button>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">

                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nisn</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                            <th class="text-center text-secondary opacity-7">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($Kelas as $row) :
                        ?><tr>
                                <td class="text-center"><?= htmlspecialchars($row['Nisn']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['Nama']) ?></td>
                                <td class="text-center">
                                    <input type="hidden" name="jadwal_mengajar_id" value="<?= $jadwal ?> ">
                                    <input type="hidden" name="siswa_nisn" value="<?= $row['Nisn'] ?> ">
                                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                                    <select name="status" class="form-select">
                                        <option value="Hadir" class="text-center">Hadir</option>
                                        <option value="Sakit" class="text-center">Sakit</option>
                                        <option value="Izin" class="text-center">Izin</option>
                                        <option value="Alfa" class="text-center">Alfa</option>
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