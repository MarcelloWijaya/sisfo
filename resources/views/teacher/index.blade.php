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
                    <h1 class="h3 mb-2 text-gray-800">Teacher Data</h1>
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
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Teacher Data</h6>
                            <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-primary">Add Teacher</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover">
                                <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            @if (Auth::user()->center_id == null)
                                                <th>Center</th>
                                            @endif
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Profile</th>
                                            @auth
                                                @if (Auth::user()->role_id == 1)
                                                    <th>Action</th>
                                                @endif
                                            @endauth
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>No</th>
                                            @if (Auth::user()->center_id == null)
                                                <th>Center</th>
                                            @endif
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Profile</th>
                                            @auth
                                                @if (Auth::user()->role_id == 1)
                                                    <th>Action</th>
                                                @endif
                                            @endauth
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($teachers as $teacher)
                                            @if (Auth::user()->center_id == null)
                                                <tr class="text-center"
                                                    onclick="window.location='{{ route('teacher.edit', $teacher->id) }}';">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $teacher->center->name }}</td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->status->name }}</td>
                                                    <td>
                                                        <a href="mailto:{{ $teacher->email }}"
                                                            class="btn btn-sm btn-secondary">Email</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('teacher.detail', $teacher->id) }}"
                                                            class="btn btn-sm btn-secondary">Profile</a>
                                                    </td>
                                                    @auth
                                                        @if (Auth::user()->role_id == 1)
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{ route('teacher.edit', $teacher->id) }}"
                                                                        class="btn btn-sm btn-primary mx-1"><i
                                                                            class="fas fa-pen"></i></a>
                                                                    <form id="delete-form-{{ $teacher->id }}"
                                                                        action="{{ route('teacher.delete', $teacher->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-danger mx-1">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @endauth
                                                </tr>
                                            @elseif ($teacher->center_id == Auth::user()->center_id)
                                                <tr class="text-center"
                                                    onclick="window.location='{{ route('teacher.edit', $teacher->id) }}';">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->status->name }}</td>
                                                    @if ($teacher->email)
                                                        <td>
                                                            <a href="mailto:{{ $teacher->email }}"
                                                                class="btn btn-sm btn-secondary">Email</a>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('teacher.detail', $teacher->id) }}"
                                                            class="btn btn-sm btn-secondary">Profile</a>
                                                    </td>
                                                    @auth
                                                        @if (Auth::user()->role_id == 1)
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{ route('teacher.edit', $teacher->id) }}"
                                                                        class="btn btn-sm btn-primary mx-1"><i
                                                                            class="fas fa-pen"></i></a>
                                                                    <form id="delete-form-{{ $teacher->id }}"
                                                                        action="{{ route('teacher.delete', $teacher->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-danger mx-1">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @endauth
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

    @include('templates.script')
</body>

</html>
