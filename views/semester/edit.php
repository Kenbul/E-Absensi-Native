<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=semester&action=update" method="post">
            <input type="hidden" name="id" value="<?= $semester['id'] ?>">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Semester</label>
                    <div class="input-group input-group-static mb-4 ">

                        <input type="text" class="form-control" name="nama_semester" value="<?= $semester['nama_semester'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="input-group input-group-static mb-4 ">
                        <select name="status" id="" class="form-control">
                            <option value="">Pilih-Status</option>
                            <option value="aktif" <?= ($semester['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="nonaktif" <?= ($semester['status'] == 'nonaktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Tanggal-Mulai</label>
                    <div class="input-group input-group-static mb-4 ">
                        <input type="date" class="form-control" name="tanggal_mulai" value="<?= $semester['tanggal_mulai'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal-Selesai</label>
                    <div class="input-group input-group-static mb-4 ">
                        <input type="date" class="form-control" name="tanggal_selesai" value="<?= $semester['tanggal_selesai'] ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>