<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fields = ['registration_fee', 'equipment_fee', 'course_fee'];

        fields.forEach(field => {
            const display = document.getElementById(`${field}_display`);
            const hidden = document.getElementById(field);

            const formatRupiah = (angka) => {
                const number = parseInt(angka.replace(/[^\d]/g, '')) || 0;
                return 'Rp. ' + number.toLocaleString('id-ID');
            };

            const extractNumber = (value) => {
                return value.replace(/[^\d]/g, '');
            };

            // Format saat halaman dimuat (jaga-jaga jika user pakai browser autofill)
            display.value = formatRupiah(hidden.value);

            display.addEventListener('input', function() {
                const clean = extractNumber(display.value);
                hidden.value = clean;
                display.value = formatRupiah(clean);
            });

            // Jika user paste angka
            display.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData).getData('text');
                const clean = extractNumber(pasted);
                hidden.value = clean;
                display.value = formatRupiah(clean);
            });
        });
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>


<!-- Custom scripts for all pages-->
<script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

{{-- Tabs Iuran --}}
<script>
    // Inisialisasi tab menggunakan ID 'myTab'
    var tab = new bootstrap.Tab(document.getElementById('myTab'));

    // Atur event click pada setiap tombol tab
    var tabButtons = document.querySelectorAll('.nav-link');
    tabButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var target = button.getAttribute('data-bs-target');
            var tabPane = document.querySelector(target);
            var activeTab = document.querySelector('.nav-link.active');
            var activePane = document.querySelector('.tab-pane.active');

            activeTab.classList.remove('active');
            activePane.classList.remove('active', 'show');
            button.classList.add('active');
            tabPane.classList.add('active', 'show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#dt_table').DataTable();
    });
</script>
