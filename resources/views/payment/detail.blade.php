<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    @include('templates.header')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('templates.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('templates.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h4 mb-2 text-gray-800">Invoices {{ $payment->student->name }}</h1>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="iuran-bulanan-tab" data-bs-toggle="tab"
                                data-bs-target="#iuran-bulanan" type="button" role="tab"
                                aria-controls="iuran-bulanan" aria-selected="true">Iuran Bulanan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="iuran-buku-tab" data-bs-toggle="tab"
                                data-bs-target="#iuran-buku" type="button" role="tab" aria-controls="iuran-buku"
                                aria-selected="false">Iuran Buku</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="iuran-bulanan" role="tabpanel"
                            aria-labelledby="iuran-bulanan-tab">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Kupon</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>{{ date('m-Y', strtotime($payment->payment_date)) }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>Kupon</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>Jenis</td>
                                        <td><i class="fas fa-print"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="iuran-buku" role="tabpanel" aria-labelledby="iuran-buku-tab">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Tanggal</th>
                                        <th>Kurikulum</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>No Buku</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>{{ date('m-Y', strtotime($payment->payment_date)) }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>Kupon</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>Jenis</td>
                                        <td><i class="fas fa-print"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('templates.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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

    @include('templates.script')
</body>

</html>
