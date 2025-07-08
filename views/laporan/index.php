<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<h1><?= $page ?></h1>
<div class="card">
    <div class="card-body">
        <form action="index.php?page=laporan&action=create" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Guru</label>
                        <select name="guru_id" class="form-control">
                            <option value="">Pilih Guru</option>
                            <?php foreach ($guru as $g) : ?>
                                <option value="<?= $g['id'] ?>">
                                    <?= htmlspecialchars($g['username']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Kelas</label>
                        <select name="kelas_id" class="form-control">
                            <option value="">Pilih kelas</option>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id'] ?>">
                                    <?= htmlspecialchars($k['Kelas']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static my-3">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggalMulai" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static my-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggalAkhir" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-danger">Buat-Laporan</button>
        </form>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>