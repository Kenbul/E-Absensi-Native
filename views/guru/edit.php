<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=guru&action=update" method="post">
            <input type="hidden" name="id" value="<?= $guru['id'] ?>">
            <div class="input-group input-group-static mb-4">
                <label for="">Nama-Guru</label>
                <input type="text" class="form-control" name="Nama" value="<?= $guru['username'] ?>">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4 ">
                        <label for="">Nik</label>
                        <input type="text" class="form-control" name="Nik" value="<?= $guru['Nik'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4 ">
                        <label for="">Nuptk</label>
                        <input type="text" class="form-control" name="Nuptk" value="<?= $guru['Nuptk'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Status Kepegawaian</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="StatusKepegawaian">
                            <option value="PNS" <?= ($guru['StatusKepegawaian'] == 'PNS') ? 'selected' : ''; ?>>PNS</option>
                            <option value="Non PNS" <?= ($guru['StatusKepegawaian'] == 'Non PNS') ? 'selected' : ''; ?>>Non PNS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="JenisKelamin">
                            <option value="Laki Laki" <?= ($guru['JenisKelamin'] == 'Laki Laki') ? 'selected' : ''; ?>>Laki Laki</option>
                            <option value="Perempuan" <?= ($guru['JenisKelamin'] == 'PEREMPUAN') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="TempatLahir" value=<?= $guru['TempatLahir'] ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static my-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="TglLahir" value="<?= $guru['TglLahir'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="">No-Hp</label>
                        <input type="text" class="form-control" name="NoHp" value="<?= $guru['NoHp'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="Email" value="<?= $guru['email'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="">Email-Madrasah</label>
                        <input type="email" class="form-control" name="EmailMadrasah" value="<?= $guru['EmailMadrasah'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="Password">
                        <small>Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Status">
                            <option value="Kepala Madrasah" <?= ($guru['Status'] == 'Kepala Madrasah') ? 'selected' : ''; ?>>Kepala Madrasah</option>
                            <option value="Guru Mapel" <?= ($guru['Status'] == 'GURU MAPEL') ? 'selected' : ''; ?>>Guru Mapel</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Penempatan</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Penempatan">
                            <option value="SATMINGKAL" <?= ($guru['Penempatan'] == 'SATMINGKAL') ? 'selected' : ''; ?>>Satmingkal</option>
                            <option value="Non SATMINGKAL" <?= ($guru['Penempatan'] == 'Non SATMINGKAL') ? 'selected' : ''; ?>>Non Satmingkal</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>