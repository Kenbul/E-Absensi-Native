<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=semester&action=store" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <label class="form-label">Semester</label>
                        <input type="text" class="form-control" name="nama_semester">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <select name="status" id="" class="form-control">
                            <option value="">Pilih-Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Tanggal-Mulai</label>
                    <div class="input-group input-group-dynamic mb-4 ">
                        <input type="date" class="form-control" name="tanggal_mulai">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal-Selesai</label>
                    <div class="input-group input-group-dynamic mb-4 ">
                        <input type="date" class="form-control" name="tanggal_selesai">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>