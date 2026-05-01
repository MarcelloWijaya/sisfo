<!-- PERBAIKI: load jquery dulu -->
<script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- plugins -->
<script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- custom -->
<script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        /*
        ==========================================
        FORMAT RUPIAH (AMAN JIKA ELEMENT TIDAK ADA)
        ==========================================
        */
        const fields = ['registration_fee', 'equipment_fee', 'course_fee'];

        fields.forEach(field => {
            const display = document.getElementById(field + "_display");
            const hidden = document.getElementById(field);

            if (!display || !hidden) return;

            const formatRupiah = (angka) => {
                const number = parseInt(String(angka).replace(/[^\d]/g, '')) || 0;
                return 'Rp. ' + number.toLocaleString('id-ID');
            };

            const extractNumber = (value) => {
                return String(value).replace(/[^\d]/g, '');
            };

            display.value = formatRupiah(hidden.value || "");

            display.addEventListener('input', function() {
                const clean = extractNumber(this.value);
                hidden.value = clean;
                this.value = formatRupiah(clean);
            });

            display.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData).getData('text');
                const clean = extractNumber(pasted);
                hidden.value = clean;
                this.value = formatRupiah(clean);
            });
        });


        /*
        ==========================================
        DATATABLE
        ==========================================
        */
        if ($('#dt_table').length) {
            $('#dt_table').DataTable();
        }


        /*
        ==========================================
        TABS FIX
        ==========================================
        */
        const tabButtons = document.querySelectorAll('[data-bs-target]');

        tabButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const target = this.getAttribute('data-bs-target');
                const tabPane = document.querySelector(target);

                if (!tabPane) return;

                document.querySelectorAll('.nav-link').forEach(el => {
                    el.classList.remove('active');
                });

                document.querySelectorAll('.tab-pane').forEach(el => {
                    el.classList.remove('active', 'show');
                });

                this.classList.add('active');
                tabPane.classList.add('active', 'show');
            });
        });


        /*
        ==========================================
        CHART FIX (JIKA CANVAS ADA BARU LOAD)
        ==========================================
        */
        if (document.getElementById("myAreaChart")) {
            $.getScript("{{ asset('template/js/demo/chart-area-demo.js') }}");
        }

        if (document.getElementById("myPieChart")) {
            $.getScript("{{ asset('template/js/demo/chart-pie-demo.js') }}");
        }

    });
</script>
