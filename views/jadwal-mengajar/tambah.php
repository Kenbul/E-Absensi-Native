<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<h1><?= $page; ?></h1>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=jadwal-mengajar&action=store" method="post">
            <!-- Step 1: Pilih Guru -->
            <div class="input-group input-group mb-4 bg-outline-dark">
                <select name="guru_id" class="form-control" required>
                    <option value="">Pilih Guru</option>
                    <?php foreach ($guru as $g) : ?>
                        <option value="<?= $g['id'] ?>">
                            <?= htmlspecialchars($g['username']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Step 2: Pilih Pelajaran untuk Guru tersebut -->
            <select name="pelajaran_id">
                <option value="">Pilih Mata Pelajaran</option>
                <?php foreach ($mapel as $m) : ?>
                    <option value="<?= $m['id'] ?>"><?= $m['Mapel'] ?></option>
                <?php endforeach; ?>
            </select>
            <!-- Step 3: Input Jadwal -->
            <select name="kelas_id">
                <option value="">Pilih Kelas</option>
                <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k['id'] ?>">
                        <?= htmlspecialchars($k['Kelas']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="hari">
                <option value="">Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
            <div class="row">
                <div class="col-4">
                    <div class="input-group input-group mb-4 bg-outline-dark">
                        <label for="" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control" name="jam_mulai">
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group input-group mb-4 bg-outline-dark">
                        <label for="" class="form-label">Jam Keluar</label>
                        <input type="time" class="form-control" name="jam_selesai">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>