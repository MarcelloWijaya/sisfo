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

                    <!-- DataTables Example -->
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
