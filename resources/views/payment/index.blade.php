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
                    <h1 class="h3 text-gray-800">Iuran Bulanan</h1>
                    <div class="">Sudah Bayar : <b>{{ $payments->where('status_id', 1)->count() }}</b></div>
                    <div class="">Belum Bayar : <b
                            class="text-danger">{{ $payments->where('status_id', 2)->count() }}</b></div>
                    <div class="mb-2">
                        <div class="col-2">Tampilkan : </div>
                        <div class="col-2"></div>
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
                                            <th>Center Name</th>
                                            <th>Student Name</th>
                                            <th>Payment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Center Name</th>
                                            <th>Student Name</th>
                                            <th>Payment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $payment->center->name }}</td>
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

    @include('templates.script')
</body>

</html>
