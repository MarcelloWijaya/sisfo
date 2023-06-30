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

                    <div class="d-flex justify-content-end mb-2">
                        <div class="mt-2 mr-2">
                            <h1 class="h6 text-gray-800">Hari :</h1>
                        </div>
                        <div class="col-1,">
                            <select class="form-control" id="day" name="day">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
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
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Manage Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Center</th>
                                            <th>Hari dan Jam</th>
                                            <th>Ruang</th>
                                            <th>Guru</th>
                                            <th>Murid</th>
                                            <th>Action</th>
                                            <th>Status Kelas</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>Center</th>
                                            <th>Hari dan Jam</th>
                                            <th>Ruang</th>
                                            <th>Guru</th>
                                            <th>Murid</th>
                                            <th>Action</th>
                                            <th>Status Kelas</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($grouped_classrooms as $classrooms)
                                            <tr class="text-center">
                                                <td>{{ $classrooms->first()->center->name }}</td>
                                                <td>{{ $classrooms->first()->classroom->day }} <br>
                                                    {{ $classrooms->first()->classroom->start_time }} -
                                                    {{ $classrooms->first()->classroom->end_time }}</td>
                                                <td>{{ $classrooms->first()->classroom->name }}</td>
                                                <td>{{ $classrooms->first()->classroom->teacher->name }}</td>
                                                <!-- addMurid Modal -->
                                                <div class="modal fade" id="addMuridModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="addMuridModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addMuridModalLabel">Add
                                                                    Murid</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('classroom.addMurid') }}"
                                                                    method="POST" id="addMuridForm">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="center_id">Center</label>
                                                                        <input class="form-control" name="center_id"
                                                                            value="{{ $classrooms }}">
                                                                        <label for="classroom_id">Classroom</label>
                                                                        <input class="form-control" name="classroom_id"
                                                                            value="{{ $classrooms }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="student_id">Student Name</label>
                                                                        <select class="form-control" id="student_id"
                                                                            name="student_id">
                                                                            @foreach ($students as $student)
                                                                                <option value="{{ $student->id }}">
                                                                                    {{ $student->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td>
                                                    <div>
                                                        @foreach ($classrooms as $classroom)
                                                            @php
                                                                $student = App\Models\Student::find($classroom['student_id']);
                                                            @endphp
                                                            <div>
                                                                <a
                                                                    href="{{ route('student.detail', $student->id) }}"><b>{{ $student->name }}</b></a>
                                                                <a href="{{ route('classroom.deleteClass', ['manageClassroom_id' => $student->id]) }}"
                                                                    onclick="event.preventDefault(); document.getElementById('remove-murid-form-{{ $student->id }}').submit();">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                                <form id="remove-murid-form-{{ $student->id }}"
                                                                    action="{{ route('classroom.deleteClass', ['manageClassroom_id' => $student->id]) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#addMuridModal">Add Murid</button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary">Non
                                                        Aktif</button>
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
