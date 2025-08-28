<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error'] ?>
    </div>
    <?php unset($_SESSION['error']); // supaya tidak muncul lagi saat reload 
    ?>
<?php endif; ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=jadwal-mengajar&action=update" method="post">
            <input type="hidden" name="id" value="<?= $jadwal['id'] ?>">

            <div class="row">
                <div class="col input-group input-group-dynamic mb-4 ">
                    <select name="guru_id" class="form-control" required>
                        <option value="">Pilih Guru</option>
                        <?php foreach ($guru as $g) : ?>
                            <option value="<?= $g['id'] ?>" <?= $g['id'] == $jadwal['guru_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($g['username']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col input-group input-group-dynamic mb-4 ">
                    <select name="pelajaran_id" class="form-control">
                        <option value="">Pilih Mata Pelajaran</option>
                        <?php foreach ($mapel as $m) : ?>
                            <option value="<?= $m['id'] ?>" <?= $m['id'] == $jadwal['mapel_id'] ? 'selected' : '' ?>>
                                <?= $m['Mapel'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col input-group input-group-dynamic mb-4 ">
                    <select name="kelas_id" class="form-control mb-4">
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id'] ?>" <?= $k['id'] == $jadwal['kelas_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['Kelas']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col input-group input-group-dynamic mb-4 ">
                    <select name="hari" class="form-control mb-4">
                        <option value="">Pilih Hari</option>
                        <?php
                        $hariList = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                        foreach ($hariList as $hari) {
                            $selected = ($jadwal['hari'] == $hari) ? 'selected' : '';
                            echo "<option value=\"$hari\" $selected>$hari</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="" class="form-label">Jam Masuk</label>
                    <div class="col input-group input-group-dynamic mb-4 ">
                        <input id="jam-mulai" type="time" class="form-control" name="jam_mulai" value="<?= $jadwal['jam_mulai'] ?>">
                    </div>
                </div>
                <div class="col">
                    <label for="" class="form-label">Jam Keluar</label>
                    <div class="col input-group input-group-dynamic mb-4 ">
                        <input id="jam-selesai" type="time" class="form-control" name="jam_selesai" value="<?= $jadwal['jam_selesai'] ?>">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>