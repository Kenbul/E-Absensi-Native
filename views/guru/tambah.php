<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=guru&action=store" method="post">
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
                        <label class="form-label">NUPTK</label>
                        <input type="number" class="form-control" name="Nuptk">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Status Kepegawaian</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="StatusKepegawaian">
                            <option value="PNS">PNS</option>
                            <option value="Non PNS">Non PNS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="JenisKelamin">
                            <option value="Laki Laki">Laki Laki</option>
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
                    <div class="input-group input-group-static my-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="TglLahir">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4">
                        <label class="form-label">No Hp</label>
                        <input type="number" class="form-control" name="NoHp">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="Email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4">
                        <label class="form-label">Email Madrasah</label>
                        <input type="email" class="form-control" name="EmailMadrasah">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="Password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Status">
                            <option value="Kepala Madrasah">Kepala Madrasah</option>
                            <option value="Guru Mapel">Guru Mapel</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Penempatan</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="Penempatan">
                            <option value="SATMINGKAL">Satmingkal</option>
                            <option value="Non SATMINGKAL">Non Satmingkal</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>