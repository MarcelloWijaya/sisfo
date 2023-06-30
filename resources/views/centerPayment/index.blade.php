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
                    <h1 class="h3 mb-2 text-gray-800">Data Biaya Center</h1>
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
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Biaya Center Data</h6>
                            <a href="{{ route('centerPayment.create') }}" class="btn btn-sm btn-primary">Add Biaya
                                Center</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Center Name</th>
                                            <th>Registration Fee Old</th>
                                            <th>Equipment Fee Old</th>
                                            <th>Course Fee Old</th>
                                            <th>Registration Fee New</th>
                                            <th>Equipment Fee New</th>
                                            <th>Course Fee New</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Center Name</th>
                                            <th>Registration Fee Old</th>
                                            <th>Equipment Fee Old</th>
                                            <th>Course Fee Old</th>
                                            <th>Registration Fee New</th>
                                            <th>Equipment Fee New</th>
                                            <th>Course Fee New</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($centerPayments as $centerPayment)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $centerPayment->center->name }}</td>
                                                <td>{{ $centerPayment->registration_fee_old ?? 0 }}</td>
                                                <td>{{ $centerPayment->equipment_fee_old ?? 0 }}</td>
                                                <td>{{ $centerPayment->course_fee_old ?? 0 }}</td>
                                                <td>{{ $centerPayment->registration_fee_new ?? 0 }}</td>
                                                <td>{{ $centerPayment->equipment_fee_new ?? 0 }}</td>
                                                <td>{{ $centerPayment->course_fee_new ?? 0 }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('centerPayment.edit', $centerPayment->id) }}"
                                                            class="btn btn-sm btn-primary mx-1"><i
                                                                class="fas fa-pen"></i></a>
                                                        <form id="delete-form-{{ $centerPayment->id }}"
                                                            action="{{ route('centerPayment.delete', $centerPayment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger mx-1">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
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
