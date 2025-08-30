<footer class="footer py-4  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Sukma-Rianti-Marpaung</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</main>
<!--   Core JS Files   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="assets/js/plugins/chartjs.min.js"></script>
<script src="https://kit.fontawesome.com/a49b250db2.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.min.js?v=3.2.0"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.min.js"></script>
<script>
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            const id = this.getAttribute('data-id');
            confirmDelete(page, id);
        });
    });

    function confirmDelete(page, id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?page=${page}&action=delete&id=${id}`;
            }
        });
    }

    flatpickr("#jam-mulai", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        allowInput: true,
        plugins: [new confirmDatePlugin({
            confirmText: "OK",
            showAlways: false // tampil hanya saat picker terbuka
        })] // Ini tambahkan tombol OK
    });

    flatpickr("#jam-selesai", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        allowInput: true,
        plugins: [new confirmDatePlugin({
            confirmText: "OK",
            showAlways: false // tampil hanya saat picker terbuka
        })]
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidenav-main");
        const closeButton = document.getElementById("closeSidebar");
        const overlay = document.getElementById("sidebarOverlay");

        function openSidebar() {
            sidebar.classList.add("show-sidebar");
            overlay.classList.remove("d-none");
        }

        function closeSidebar() {
            sidebar.classList.remove("show-sidebar");
            overlay.classList.add("d-none");
        }

        toggleButton.addEventListener("click", function() {
            if (sidebar.classList.contains("show-sidebar")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        closeButton.addEventListener("click", closeSidebar);
        overlay.addEventListener("click", closeSidebar);

    });
</script>



</body>

</html>