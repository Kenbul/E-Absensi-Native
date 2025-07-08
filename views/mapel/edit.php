<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=mapel&action=update" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Mapel</label>
                    <div class="input-group input-group-dynamic mb-4 ">
                        <input type="hidden" name="id" value="<?= $mapel['id'] ?>">
                        <input type="text" class="form-control" name="mapel" value="<?= $mapel['Mapel'] ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>