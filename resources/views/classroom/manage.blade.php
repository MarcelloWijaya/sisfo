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
                                            <th>Hari dan Jam</th>
                                            <th>Center</th>
                                            <th>Ruang</th>
                                            <th>Guru</th>
                                            <th>Murid</th>
                                            <th>Action</th>
                                            <th>Status Kelas</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>Hari dan Jam</th>
                                            <th>Center</th>
                                            <th>Ruang</th>
                                            <th>Guru</th>
                                            <th>Murid</th>
                                            <th>Action</th>
                                            <th>Status Kelas</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($grouped_classrooms as $classroom)
                                            <tr class="text-center">
                                                <td>{{ $classroom->first()->classroom->day->name }} <br>
                                                    {{ $classroom->first()->classroom->start_time }} -
                                                    {{ $classroom->first()->classroom->end_time }}</td>
                                                <td>{{ $classroom->first()->classroom->center->name }}</td>
                                                <td>{{ $classroom->first()->classroom->name }}</td>
                                                <td>{{ $classroom->first()->classroom->teacher->name }}</td>
                                                <td>
                                                    @foreach ($classroom as $manage_classroom)
                                                        @if ($manage_classroom->student)
                                                            <a
                                                                href="{{ route('student.detail', $manage_classroom->student->id) }}"><b>{{ $manage_classroom->student->name }}</b></a>
                                                            <a href="{{ route('classroom.removeMurid', ['manageClassroom_id' => $manage_classroom->id]) }}"
                                                                onclick="event.preventDefault(); document.getElementById('remove-murid-form-{{ $manage_classroom->id }}').submit();">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                            <form id="remove-murid-form-{{ $manage_classroom->id }}"
                                                                action="{{ route('classroom.removeMurid', ['manageClassroom_id' => $manage_classroom->id]) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <br>
                                                        @else
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#addMuridModal-{{ $classroom->first()->classroom->id }}">Add
                                                        Murid</button>
                                                </td>
                                                <!-- addMurid Modal -->
                                                <div class="modal fade"
                                                    id="addMuridModal-{{ $classroom->first()->classroom->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="addMuridModalLabel"
                                                    aria-hidden="true">
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
                                                                    method="POST"
                                                                    id="addMuridForm-{{ $classroom->first()->classroom->id }}">
                                                                    @csrf
                                                                    <input type="hidden" name="classroom_id"
                                                                        value="{{ $classroom->first()->classroom->id }}">
                                                                    <div class="form-group">
                                                                        <label for="student_id">Student Name</label>
                                                                        <select class="form-control" id="student_id"
                                                                            name="student_id">
                                                                            </option>
                                                                            @foreach ($students as $student)
                                                                                @if (!$classroom->pluck('student_id')->contains($student->id))
                                                                                    <option
                                                                                        value="{{ $student->id }}">
                                                                                        {{ $student->name }}</option>
                                                                                @endif
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
                                                    <button type="button" class="btn btn-secondary">Non Aktif</button>
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
