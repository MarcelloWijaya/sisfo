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
                    <h1 class="h3 mb-4 text-gray-800">Edit Data Classroom</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('classroom.update', $classroom->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="center_id">Center</label>
                                    <select class="form-control" id="center_id" name="center_id" required>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id', $classroom->center_id) == $center->id ? 'selected' : '' }}>
                                                {{ $center->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="day">Hari</label>
                                    <select class="form-control" id="day" name="day" required>
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="Senin"
                                            {{ old('day', $classroom->day) == 'Senin' ? 'selected' : '' }}>Senin
                                        </option>
                                        <option value="Selasa"
                                            {{ old('day', $classroom->day) == 'Selasa' ? 'selected' : '' }}>Selasa
                                        </option>
                                        <option value="Rabu"
                                            {{ old('day', $classroom->day) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis"
                                            {{ old('day', $classroom->day) == 'Kamis' ? 'selected' : '' }}>Kamis
                                        </option>
                                        <option value="Jumat"
                                            {{ old('day', $classroom->day) == 'Jumat' ? 'selected' : '' }}>Jumat
                                        </option>
                                        <option value="Sabtu"
                                            {{ old('day', $classroom->day) == 'Sabtu' ? 'selected' : '' }}>Sabtu
                                        </option>
                                        <option value="Minggu"
                                            {{ old('day', $classroom->day) == 'Minggu' ? 'selected' : '' }}>Minggu
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time"
                                        required value="{{ old('start_time', $classroom->start_time) }}">
                                </div>

                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time" required
                                        value="{{ old('end_time', $classroom->end_time) }}">
                                </div>

                                <div class="form-group">
                                    <label for="teacher_id">Teacher</label>
                                    <select class="form-control" id="teacher_id" name="teacher_id" required>
                                        <option value="">-- Select Teacher --</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ old('teacher_id', $classroom->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="class_name">Class Name</label>
                                    <input type="text" class="form-control" id="class_name" name="class_name"
                                        required value="{{ old('class_name', $classroom->class_name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="aktif">Aktif</label>
                                    <select class="form-control" id="aktif" name="aktif" required>
                                        <option value="1"
                                            {{ old('aktif', $classroom->aktif) == 1 ? 'selected' : '' }}>
                                            Aktif</option>
                                        <option value="0"
                                            {{ old('aktif', $classroom->aktif) == 0 ? 'selected' : '' }}>
                                            Non-Aktif</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
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
