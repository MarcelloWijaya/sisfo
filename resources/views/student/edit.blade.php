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
                    <h1 class="h3 mb-4 text-gray-800">Edit Data Student</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('student.update', $student->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="center_id">Center</label>
                                    <select class="form-control" id="center_id" name="center_id" required>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id', $student->center_id) == $center->id ? 'selected' : '' }}>
                                                {{ $center->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Student Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name', $student->name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male"
                                            {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required
                                        value="{{ old('address', $student->address) }}">
                                </div>

                                <div class="form-group">
                                    <label for="place_of_birth">Place of Birth</label>
                                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                        required value="{{ old('place_of_birth', $student->place_of_birth) }}">
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        required value="{{ old('date_of_birth', $student->date_of_birth) }}">
                                </div>

                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control" id="religion" name="religion" required>
                                        <option value="">-- Select Religion --</option>
                                        <option value="Buddha"
                                            {{ old('religion', $student->religion) == 'Buddha' ? 'selected' : '' }}>
                                            Buddha</option>
                                        <option value="Hindu"
                                            {{ old('religion', $student->religion) == 'Hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="Islam"
                                            {{ old('religion', $student->religion) == 'Islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="Katholik"
                                            {{ old('religion', $student->religion) == 'Katholik' ? 'selected' : '' }}>
                                            Katholik</option>
                                        <option value="Kristen"
                                            {{ old('religion', $student->religion) == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number', $student->phone_number) }}">
                                </div>

                                <div class="form-group">
                                    <label for="school_name">School Name</label>
                                    <input type="text" class="form-control" id="school_name" name="school_name"
                                        required value="{{ old('school_name', $student->school_name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="parent_name">Parent Name</label>
                                    <input type="text" class="form-control" id="parent_name" name="parent_name"
                                        required value="{{ old('parent_name', $student->parent_name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="entry_date">Entry Date</label>
                                    <input type="date" class="form-control" id="entry_date" name="entry_date"
                                        required value="{{ old('entry_date', $student->entry_date) }}">
                                </div>

                                <div class="form-group">
                                    <label for="registration_date">Registration Date</label>
                                    <input type="date" class="form-control" id="registration_date"
                                        name="registration_date" required
                                        value="{{ old('registration_date', $student->registration_date) }}">
                                </div>

                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level" name="level"
                                        required value="{{ old('level', $student->level) }}">
                                </div>

                                <div class="form-group">
                                    <label for="book_start">Book Start</label>
                                    <input type="text" class="form-control" id="book_start" name="book_start"
                                        required value="{{ old('book_start', $student->book_start) }}">
                                </div>

                                <div class="form-group">
                                    <label for="parent_email">Parent Email</label>
                                    <input type="email" class="form-control" id="parent_email" name="parent_email"
                                        required value="{{ old('parent_email', $student->parent_email) }}">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="Aktif"
                                            {{ old('status', $student->status) == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Non Aktif"
                                            {{ old('status', $student->status) == 'Non Aktif' ? 'selected' : '' }}>Non
                                            Aktif</option>
                                        <option value="Cuti"
                                            {{ old('status', $student->status) == 'Cuti' ? 'selected' : '' }}>Cuti
                                        </option>
                                        <option value="Keluar"
                                            {{ old('status', $student->status) == 'Keluar' ? 'selected' : '' }}>Keluar
                                        </option>
                                        <option value="Lulus"
                                            {{ old('status', $student->status) == 'Lulus' ? 'selected' : '' }}>Lulus
                                        </option>
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
