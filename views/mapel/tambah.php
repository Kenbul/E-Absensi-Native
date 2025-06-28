<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=mapel&action=store" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <label class="form-label">Mapel</label>
                        <input type="text" class="form-control" name="mapel">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>