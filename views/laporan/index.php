<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error'] ?>
    </div>
    <?php unset($_SESSION['error']); // supaya tidak muncul lagi saat reload 
    ?>
<?php endif; ?>
<div class="card">
    <div class="card-body">
        <form action="index.php?page=laporan&action=create" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Guru</label>
                        <select id="guru_id" name="guru_id" class="form-control">
                            <option value="">Pilih Guru</option>
                            <?php foreach ($guru as $g): ?>
                                <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['username']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Kelas</label>
                        <select id="kelas_id" name="kelas_id" class="form-control">
                            <option value="">Pilih Kelas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Mapel</label>
                        <select id="mapel_id" name="mapel_id" class="form-control">
                            <option value="">Pilih Mapel</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static my-3">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggalMulai" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static my-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggalAkhir" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-danger">Buat-Laporan</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const guruSelect = document.getElementById("guru_id");
        const kelasSelect = document.getElementById("kelas_id");
        const mapelSelect = document.getElementById("mapel_id");

        // Step 1: Pilih Guru → Ambil Kelas
        guruSelect.addEventListener("change", function() {
            const guruId = this.value;
            kelasSelect.innerHTML = '<option value="">Loading...</option>';
            mapelSelect.innerHTML = '<option value="">Pilih Mapel</option>';

            if (guruId) {
                fetch(`index.php?page=laporan&action=get_kelas_by_guru&guru_id=${guruId}`)
                    .then(res => res.json())
                    .then(data => {
                        kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';
                        data.forEach(item => {
                            const option = document.createElement("option");
                            option.value = item.id;
                            option.textContent = item.Kelas;
                            kelasSelect.appendChild(option);
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        kelasSelect.innerHTML = '<option value="">Gagal memuat kelas</option>';
                    });
            } else {
                kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';
            }
        });

        // Step 2: Pilih Kelas + Guru → Ambil Mapel
        kelasSelect.addEventListener("change", function() {
            const kelasId = this.value;
            const guruId = guruSelect.value;
            mapelSelect.innerHTML = '<option value="">Loading...</option>';

            if (kelasId && guruId) {
                fetch(`index.php?page=laporan&action=get_mapel_by_guru_kelas&guru_id=${guruId}&kelas_id=${kelasId}`)
                    .then(res => res.json())
                    .then(data => {
                        mapelSelect.innerHTML = '<option value="">Pilih Mapel</option>';
                        data.forEach(item => {
                            const option = document.createElement("option");
                            option.value = item.id;
                            option.textContent = item.Mapel;
                            mapelSelect.appendChild(option);
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        mapelSelect.innerHTML = '<option value="">Gagal memuat mapel</option>';
                    });
            } else {
                mapelSelect.innerHTML = '<option value="">Pilih Mapel</option>';
            }
        });
    });
</script>

<?php include "views/layouts/footer.php" ?>