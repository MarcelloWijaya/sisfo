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
                    <h1 class="h3 mb-2 text-gray-800">Data Presence</h1>

                    <!-- Form Pencarian -->
                    <form action="{{ route('presence.loadTable') }}" method="POST">
                        @csrf
                        <div class="row mb-3 justify-content-start">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tingkat">Tingkat</label>
                                    <select class="form-control" id="tingkat" name="gradeId">
                                        <option value="">-- Select Grade --</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" id="kelas" name="classroomId">
                                        <option value="">-- Select Classroom --</option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id_siswa">ID Siswa</label>
                                    <select class="form-control" id="student_id" name="studentId">
                                        <option value="">-- Select Student --</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mt-auto mb-3">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>

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
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Presence Data</h6>
                            <a href="{{ route('presence.create') }}" class="btn btn-sm btn-primary">Add Presence</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Grade</th>
                                            <th>Classroom</th>
                                            <th>Student Name</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Grade</th>
                                            <th>Classroom</th>
                                            <th>Student Name</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </tfoot>
                                    @if ()
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($presences as $presence)
                                            <tr class="text-center"
                                                onclick="window.location='{{ route('presence.edit') }}';">
                                                <td>{{ $no++ }}</td>
                                                {{-- <td>{{ $presence->classroom->grade->name }}</td> --}}
                                                {{-- <td>{{ $presence->classroom->name }}</td>
                                                <td>{{ $presence->customer_id }}</td> --}}
                                                <td>{{ $presence->customer_id }}</td>
                                                <td>{{ $presence->date_and_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($presences as $presence)
                                            <tr class="text-center"
                                                onclick="window.location='{{ route('presence.edit') }}';">
                                                <td>{{ $no++ }}</td>
                                                {{-- <td>{{ $presence->classroom->grade->name }}</td> --}}
                                                {{-- <td>{{ $presence->classroom->name }}</td>
                                                <td>{{ $presence->customer_id }}</td> --}}
                                                <td>{{ $presence->customer_id }}</td>
                                                <td>{{ $presence->date_and_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @endif
                                    
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
