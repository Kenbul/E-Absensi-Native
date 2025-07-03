<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<a href="index.php?page=kelas&action=create" class="btn btn-success mb-3">Tambah kelas</a>
<?php if (!empty($_SESSION['success'])) {
    echo "<script>
            Swal.fire({
                title: 'Success!',
                text: '" . $_SESSION['success'] . "',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php?page=kelas'; // Redirect setelah klik OK
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kelas</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($datakelas as $kelas) :
                ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1"><?= $no++; ?></div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($kelas['Kelas']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <a href="index.php?page=kelas&action=edit&id=<?= $kelas['id']; ?>" class="btn btn-warning "><i class="fa-solid fa-pen fa-lg"></i></a>
                            <button class="btn btn-danger" data-page="kelas" data-id="<?= $kelas['id']; ?>"><i class="fa-solid fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>