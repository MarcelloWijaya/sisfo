<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

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

<!-- Masukkan link JavaScript Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

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
