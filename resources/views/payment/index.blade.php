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
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 text-gray-800">Iuran Bulanan</h1>
                        <div>
                            <form action="{{ route('payment.index') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="d-flex align-items-center">
                                    <div class="mt-1 mr-2">
                                        <label for="month">Bulan:</label>
                                        <select id="month" name="month">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="mt-1 mr-2">
                                        <label for="year">Tahun:</label>
                                        <select id="month" name="month">
                                            <option value="2023">2023</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="">Sudah Bayar: <b>{{ $payments->where('status_id', 1)->count() }}</b></div>
                    <div class="">Belum Bayar: <b
                            class="text-danger">{{ $payments->where('status_id', 2)->count() }}</b></div>
                    <div class="row mb-4">
                        <label for="status_id" class="mt-2 col-1 form-label">Tampilkan:</label>
                        <select class="col-2 form-control" id="status_id" name="status_id">
                            <option value="">Semua</option>
                            <option value="1">Sudah Bayar</option>
                            <option value="2">Belum Bayar</option>
                        </select>
                    </div>

                    <div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                <b>{{ \Session::get('success') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (\Session::has('delete'))
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                <b>{{ \Session::get('delete') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Iuran Bulanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            @if (Auth::user()->center_id == null)
                                                <th>Center</th>
                                            @endif
                                            <th>Name</th>
                                            <th>Payment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>No</th>
                                            @if (Auth::user()->center_id == null)
                                                <th>Center</th>
                                            @endif
                                            <th>Name</th>
                                            <th>Payment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($payments as $payment)
                                            @if (Auth::user()->center_id == null)
                                                <tr class="text-center">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $payment->student->center->name }}</td>
                                                    <td><a
                                                            href="{{ route('student.detail', ['student_id' => $payment->student->id]) }}">{{ $payment->student->name }}</a>
                                                    </td>
                                                    <td>{{ $payment->payment_date }}</td>
                                                    @if ($payment->status_id == 1)
                                                        <td>{{ $payment->status->name }}</td>
                                                    @elseif ($payment->status_id == 2)
                                                        <td><a href="{{ route('payment.student.detail', ['student_id' => $payment->student->id]) }}"
                                                                class="btn btn-sm btn-secondary"> Pay Now </a></td>
                                                    @endif
                                                </tr>
                                            @elseif ($payment->student->center_id == Auth::user()->center_id)
                                                <tr class="text-center">
                                                    <td>{{ $no++ }}</td>
                                                    <td><a
                                                            href="{{ route('student.detail', ['student_id' => $payment->student->id]) }}">{{ $payment->student->name }}</a>
                                                    </td>
                                                    <td>{{ $payment->payment_date }}</td>
                                                    @if ($payment->status_id == 1)
                                                        <td>{{ $payment->status->name }}</td>
                                                    @elseif ($payment->status_id == 2)
                                                        <td><a href="{{ route('payment.student.detail', ['student_id' => $payment->student->id]) }}"
                                                                class="btn btn-sm btn-secondary"> Pay Now </a></td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            var select = document.getElementById('month');
            var selectedValue = select.value;

            select.addEventListener('change', function() {
                selectedValue = select.value;
                filterTableByStatus(selectedValue);
            });

            function filterTableByStatus(status) {
                var tableRows = document.querySelectorAll('#dt_table tbody tr');

                tableRows.forEach(function(row) {
                    var statusCell = row.querySelector('td:nth-child(5)');
                    var paymentStatus = statusCell.textContent.trim();

                    if (status === '1' && paymentStatus === 'Sudah Bayar') {
                        row.style.display = 'table-row';
                    } else if (status === '2' && paymentStatus === 'Belum Bayar') {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            filterTableByStatus(selectedValue);
        });
    </script>
    @include('templates.script')
</body>

</html>
