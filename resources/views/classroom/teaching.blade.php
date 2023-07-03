<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    @include('templates.header')
</head>

<body id="page-top">

    <div id="wrapper">
        @include('templates.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            @include('templates.topbar')

            <div id="content">
                <div class="container-fluid">

                    <div class="d-flex justify-content-end mb-2">
                        <div class="mt-2 mr-2">
                            <h1 class="h6 text-gray-800">Guru :</h1>
                        </div>
                        <div class="col-2">
                            <form id="teacher-form" action="/teaching" method="GET">
                                <div class="input-group">
                                    <select class="form-control" id="teacher" name="selected_teacher_id">
                                        <option value=""></option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="hidden" style="display: none;">
                        <div id="teacher-name">Teacher Name : {{ $selected_teacher_id }}</div>
                        <div>Total Students : {{ $selected_teacher_id }}</div>

                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="m-0 mt-1 font-weight-bold text-primary">Teaching Schedule</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Center</th>
                                                <th>Guru</th>
                                                <th>Jam</th>
                                                <th>Senin</th>
                                                <th>Selasa</th>
                                                <th>Rabu</th>
                                                <th>Kamis</th>
                                                <th>Jumat</th>
                                                <th>Sabtu</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th>Center</th>
                                                <th>Guru</th>
                                                <th>Jam</th>
                                                <th>Senin</th>
                                                <th>Selasa</th>
                                                <th>Rabu</th>
                                                <th>Kamis</th>
                                                <th>Jumat</th>
                                                <th>Sabtu</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($grouped_classrooms as $classrooms)
                                                @if ($classrooms->first()->classroom->teacher_id == $selected_teacher_id)
                                                    <tr class="text-center">
                                                        <td>{{ $classrooms->first()->classroom->center->name }}</td>
                                                        <td>{{ $classrooms->first()->classroom->teacher->name }}</td>
                                                        <td>{{ $classrooms->first()->classroom->start_time }} -
                                                            {{ $classrooms->first()->classroom->end_time }}</td>
                                                        @for ($i = 1; $i <= 6; $i++)
                                                            <td>
                                                                @if ($classrooms->first()->classroom->day_id == $i)
                                                                    @foreach ($classrooms as $classroom)
                                                                        @php
                                                                            $student = $students->find($classroom->student_id);
                                                                        @endphp
                                                                        @if ($student)
                                                                            <div>{{ $student->name }}</div>
                                                                        @else
                                                                            <div></div>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('templates.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('templates.script')
</body>

</html>
