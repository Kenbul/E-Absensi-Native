<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=siswa&action=store" method="post">
            <div class="input-group input-group-dynamic mb-4">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="Nama">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <label class="form-label">NIK</label>
                        <input type="number" class="form-control" name="Nik">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <label class="form-label">NISN</label>
                        <input type="number" class="form-control" name="Nisn">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Status">
                            <option value="Aktif">Aktif</option>
                            <option value="TidakAktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="JenisKelamin">
                            <option value="Laki-Laki">Laki Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="TempatLahir">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="TanggalLahir">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label>Nama Ayah</label>
                        <input type="text" class="form-control" name="NamaAyah">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control" name="NamaIbu">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label>Nama Wali</label>
                        <input type="text" class="form-control" name="NamaWali">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="Alamat">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label>No Telp</label>
                        <input type="number" class="form-control" name="NoTelp">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Kelas</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Kelas">
                            <?php foreach ($datakelas as $kelas) : ?>
                                <option value="<?= $kelas['id'] ?>"><?= $kelas['Kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>