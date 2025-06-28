<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<a href="index.php?page=siswa&action=create" class="btn btn-success mb-3">Tambah siswa</a>
<?php if (!empty($_SESSION['success'])) {
    echo "<script>
            Swal.fire({
                title: 'Success!',
                text: '" . $_SESSION['success'] . "',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php?page=siswa'; // Redirect setelah klik OK
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NISN</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($datasiswa as $siswa) :
                ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1"><?= $no++; ?></div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($siswa['Nama']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($siswa['Nisn']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"><?= htmlspecialchars($siswa['Status']); ?></h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <a href="index.php?page=siswa&action=edit&Nik=<?= $siswa['Nik']; ?>" class="btn btn-warning "><i class="fa-solid fa-pen fa-lg"></i></a>
                            <a href="index.php?page=delete&Nik=<?= $siswa['Nik']; ?>" class="btn btn-danger " onclick="confirmDelete(<?= $siswa['Nik']; ?>)"><i class="fa-solid fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "views/layouts/footer.php" ?>