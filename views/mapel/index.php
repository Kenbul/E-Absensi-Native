<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<a href="index.php?page=mapel&action=create" class="btn btn-success mb-3">Tambah mapel</a>
<?php if (!empty($_SESSION['success'])) {
    echo "<script>
            Swal.fire({
                title: 'Success!',
                text: '" . $_SESSION['success'] . "',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php?page=mapel'; // Redirect setelah klik OK
            });
          </script>";
    unset($_SESSION['success']); // Hapus session setelah ditampilkan
}
?>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">

            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">mapel</th>
                    <th class=" text-uppercase text-secondary opacity-7 text-xxs">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($datamapel as $mapel) :
                ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1"><?= $no++; ?></div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($mapel['Mapel']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <a href="index.php?page=mapel&action=edit&id=<?= $mapel['id']; ?>" class="btn btn-warning "><i class="fa-solid fa-pen fa-lg"></i></a>
                            <button class="btn btn-danger" data-page="mapel" data-id="<?= $mapel['id']; ?>"><i class="fa-solid fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>