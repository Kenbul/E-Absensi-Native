<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=siswa&action=update" method="post">
            <div class="input-group input-group-dynamic mb-4">
                <!-- <label class="form-label">Nama Lengkap</label> -->
                <input type="hidden" name="Nisn" value="<?= $Siswa['Nisn']; ?>">
                <input type="text" class="form-control" name="Nama" value="<?= $Siswa['Nama'] ?>">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <!-- <label class="form-label">NIK</label> -->
                        <input type="number" class="form-control" name="Nik" value="<?= $Siswa['Nik'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <input type="number" class="form-control" name="Nisn" value="<?= $Siswa['Nisn'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Status">
                            <option value="Aktif" <?= ($Siswa['Status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Tidak Aktif" <?= ($Siswa['Status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="JenisKelamin">
                            <option value="Laki-Laki" <?= ($Siswa['JenisKelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki Laki</option>
                            <option value="Perempuan" <?= ($Siswa['JenisKelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">

                        <input type="text" class="form-control" name="TempatLahir" value="<?= $Siswa['TempatLahir'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">

                        <input type="date" class="form-control" name="TanggalLahir" value="<?= $Siswa['TanggalLahir']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <input type="text" class="form-control" name="NamaAyah" value="<?= $Siswa['NamaAyah'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <input type="text" class="form-control" name="NamaIbu" value="<?= $Siswa['NamaIbu'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <input type="text" class="form-control" name="NamaWali" value="<?= $Siswa['NamaWali'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <input type="text" class="form-control" name="Alamat" value="<?= $Siswa['Alamat'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <input type="number" class="form-control" name="NoTelp" value="<?= $Siswa['NoTelp'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Kelas</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Kelas">
                            <option value="7" <?= ($Siswa['Kelas'] == '7') ? 'selected' : ''; ?>>7</option>
                            <option value="8" <?= ($Siswa['Kelas'] == '8') ? 'selected' : ''; ?>>8</option>
                            <option value="9" <?= ($Siswa['Kelas'] == '9') ? 'selected' : ''; ?>>9</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>