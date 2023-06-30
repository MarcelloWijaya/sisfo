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
                    <div class="h3 mb-2 text-gray-800">Teacher Name : Irma Damayanti</div>
                    <div class="h3 mb-2 text-gray-800">Total Students : </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Teaching Schedule</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt_table" class="table" cellspacing="0" width="100%">
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
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($grouped_classrooms as $classrooms)
                                            <tr class="text-center">
                                                <td>{{ $classrooms->first()->center->name }}</td>
                                                <td>{{ $classrooms->first()->classroom->teacher->name }}</td>
                                                <td>{{ $classrooms->first()->classroom->day }} <br>
                                                    {{ $classrooms->first()->classroom->start_time }} -
                                                    {{ $classrooms->first()->classroom->end_time }}</td>
                                                <td>
                                                    @foreach ($classrooms as $classroom)
                                                        @php
                                                            $student = App\Models\Student::find($classroom['student_id']);
                                                        @endphp
                                                        <div>
                                                            {{ $student->name }}
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($classrooms as $classroom)
                                                        @php
                                                            $student = App\Models\Student::find($classroom['student_id']);
                                                        @endphp
                                                        <div>
                                                            {{ $student->name }}
                                                        </div>
                                                    @endforeach
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
