<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>

<h3><?= $title ?></h3>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Filter Dropdown -->
<div class="row mb-3">
    <div class="col-md-4">
        <div class="input-group input-group-static mb-4">
            <select id="kelas_id" name="kelas_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <?php foreach ($kelasList as $k): ?>
                    <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['Kelas']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-static mb-4">
            <select id="mapel_id" name="mapel_id" class="form-control" required>
                <option value="">-- Pilih Mapel --</option>
            </select>
        </div>
    </div>

</div>

<!-- Tempat hasil absensi -->
<div id="tabel-absensi">
    <div class="alert alert-info">Silakan pilih kelas dan mapel untuk menampilkan absensi</div>
</div>

<!-- Modal Edit Absensi -->
<div class="modal fade" id="editAbsensiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditAbsensi">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control" id="edit-nama" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" id="edit-tanggal" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Script AJAX -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const kelasSelect = document.getElementById("kelas_id");
        const mapelSelect = document.getElementById("mapel_id");

        kelasSelect.addEventListener("change", function() {
            const kelasId = this.value;

            if (kelasId) {
                fetch(`index.php?page=absensi&action=get_mapel_by_kelas&kelas_id=${kelasId}`)
                    .then(response => {
                        if (!response.ok) throw new Error("Gagal fetch data");
                        return response.json();
                    })
                    .then(data => {
                        // Hapus opsi lama
                        mapelSelect.innerHTML = '<option value="">-- Pilih Mapel --</option>';
                        // Isi dengan data dari server
                        data.forEach(item => {
                            const option = document.createElement("option");
                            option.value = item.id;
                            option.textContent = item.Mapel;
                            mapelSelect.appendChild(option);
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Gagal memuat data mapel");
                    });
            } else {
                mapelSelect.innerHTML = '<option value="">-- Pilih Mapel --</option>';
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("click", ".btn-edit", function() {
        let id = $(this).data("id");
        let nama = $(this).data("nama");
        let tanggal = $(this).data("tanggal");
        let status = $(this).data("status");

        $("#edit-id").val(id);
        $("#edit-nama").val(nama);
        $("#edit-tanggal").val(tanggal);
        $("#edit-status").val(status);

        $("#editAbsensiModal").modal("show");
    });


    // Submit form edit via AJAX
    $("#formEditAbsensi").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: "index.php?page=absensi&action=update_ajax",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                let res = JSON.parse(response);

                if (res.success) {
                    // Update row di tabel (tanpa reload)
                    let row = $("button[data-id='" + res.id + "']").closest("tr");
                    row.find("td:eq(3)").text(res.status); // update kolom status

                    $("#editAbsensiModal").modal("hide");
                } else {
                    alert(res.message);
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        function loadAbsensi() {
            let kelas_id = $("#kelas_id").val();
            let mapel_id = $("#mapel_id").val();

            if (kelas_id && mapel_id) {
                $.ajax({
                    url: "index.php?page=absensi&action=ajaxabsensi",
                    type: "GET",
                    data: {
                        kelas_id: kelas_id,
                        mapel_id: mapel_id
                    },
                    beforeSend: function() {
                        $("#tabel-absensi").html('<div class="text-center">Loading...</div>');
                    },
                    success: function(res) {
                        $("#tabel-absensi").html(res);
                    },
                    error: function() {
                        $("#tabel-absensi").html('<div class="alert alert-danger">Gagal memuat data</div>');
                    }
                });
            }
        }

        $("#kelas_id, #mapel_id").on("change", loadAbsensi);
    });
</script>
<?php include "views/layouts/footer.php" ?>