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
                    <h1 class="h3 mb-4 text-gray-800">Edit Teacher</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher.update', $teacher->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="center_id">Center</label>
                                    <select class="form-control" id="center_id" name="center_id" required>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id', $teacher->center_id) == $center->id ? 'selected' : '' }}>
                                                {{ $center->center_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="teacher_name">Teacher Name</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                        required value="{{ old('teacher_name', $teacher->teacher_name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="nickname">Nickname</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" required
                                        value="{{ old('nickname', $teacher->nickname) }}">
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required
                                        value="{{ old('address', $teacher->address) }}">
                                </div>

                                <div class="form-group">
                                    <label for="place_of_birth">Place of Birth</label>
                                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                        required value="{{ old('place_of_birth', $teacher->place_of_birth) }}">
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        required value="{{ old('date_of_birth', $teacher->date_of_birth) }}">
                                </div>

                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control" id="religion" name="religion" required>
                                        <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>
                                            Buddha</option>
                                        <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Katholik" {{ old('religion') == 'Katholik' ? 'selected' : '' }}>
                                            Katholik</option>
                                        <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number', $teacher->phone_number) }}">
                                </div>

                                <div class="form-group">
                                    <label for="last_education">Last Education</label>
                                    <input type="text" class="form-control" id="last_education" name="last_education"
                                        required value="{{ old('last_education', $teacher->last_education) }}">
                                </div>

                                <div class="form-group">
                                    <label for="teacher_email">Email</label>
                                    <input type="email" class="form-control" id="teacher_email" name="teacher_email"
                                        required value="{{ old('teacher_email', $teacher->teacher_email) }}">
                                </div>

                                <div class="form-group">
                                    <label for="training_date">Training Date</label>
                                    <input type="date" class="form-control" id="training_date" name="training_date"
                                        required value="{{ old('training_date', $teacher->training_date) }}">
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
