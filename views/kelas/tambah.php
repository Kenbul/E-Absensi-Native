<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<div class="card card-frame">
    <div class="card-body">
        <form action="index.php?page=kelas&action=store" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic mb-4 ">
                        <label class="form-label">Kelas</label>
                        <input type="number" class="form-control" name="Kelas">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>