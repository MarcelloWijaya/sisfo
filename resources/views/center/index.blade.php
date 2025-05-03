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
                    <h1 class="h3 mb-2 text-gray-800">Data Center</h1>

                    <div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @elseif (session('delete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('delete') }}</strong>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Center Data</h6>
                            <a href="{{ route('center.create') }}" class="btn btn-sm btn-primary">Add Center</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-bordered" id="dt_table" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Center Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($centers as $index => $center)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $center->name }}</td>
                                                <td>{{ $center->address }}</td>
                                                <td>{{ $center->phone_number }}</td>
                                                <td>{{ $center->email }}</td>
                                                <td>
                                                    <a href="{{ route('center.edit', $center->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <!-- Modal Konfirmasi -->
                                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Konfirmasi Penghapusan</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data center ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <form id="deleteForm"
                                                                        action="{{ route('center.delete', $center->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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
