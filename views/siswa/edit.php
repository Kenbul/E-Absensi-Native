<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=siswa&action=update" method="post">
            <div class="input-group input-group-static mb-4">
                <!-- <label class="form-label">Nama Lengkap</label> -->
                <input type="hidden" name="Nisn" value="<?= $Siswa['Nisn']; ?>">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="Nama" value="<?= $Siswa['Nama'] ?>">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4 ">
                        <!-- <label class="form-label">NIK</label> -->
                         <label for="">Nik</label>
                        <input type="number" class="form-control" name="Nik" value="<?= $Siswa['Nik'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4 ">
                        <label for="">Nisn</label>
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
                        <label for="">Tampat-Lahir</label>
                        <input type="text" class="form-control" name="TempatLahir" value="<?= $Siswa['TempatLahir'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Tanggal-Lahir</label>
                        <input type="date" class="form-control" name="TanggalLahir" value="<?= $Siswa['TanggalLahir']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Nama-Ayah</label>
                        <input type="text" class="form-control" name="NamaAyah" value="<?= $Siswa['NamaAyah'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Nama-Ibu</label>
                        <input type="text" class="form-control" name="NamaIbu" value="<?= $Siswa['NamaIbu'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Nama-Wali</label>
                        <input type="text" class="form-control" name="NamaWali" value="<?= $Siswa['NamaWali'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="Alamat" value="<?= $Siswa['Alamat'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="">No-Telp</label>
                        <input type="number" class="form-control" name="NoTelp" value="<?= $Siswa['NoTelp'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Kelas</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Kelas">
                            <option value="1" <?= ($Siswa['Kelas'] == '1') ? 'selected' : ''; ?>>7</option>
                            <option value="2" <?= ($Siswa['Kelas'] == '2') ? 'selected' : ''; ?>>8</option>
                            <option value="3" <?= ($Siswa['Kelas'] == '3') ? 'selected' : ''; ?>>9</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>