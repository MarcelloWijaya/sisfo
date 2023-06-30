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
                    <h1 class="h3 mb-4 text-gray-800">Create Data Student</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('student.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="center_id">Center</label>
                                    <select class="form-control" id="center_id" name="center_id">
                                        <option value="">-- select Center --</option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                                {{ $center->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('center_id')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis"
                                        value="{{ old('nis') }}">
                                    @error('nis')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Student Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="place_of_birth">Place of Birth</label>
                                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                        value="{{ old('place_of_birth') }}">
                                    @error('place_of_birth')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control" id="religion" name="religion">
                                        <option value="">-- Select Religion --</option>
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
                                    @error('religion')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="school_name">School Name</label>
                                    <input type="text" class="form-control" id="school_name" name="school_name"
                                        value="{{ old('school_name') }}">
                                    @error('school_name')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="parent_name">Parent Name</label>
                                    <input type="text" class="form-control" id="parent_name" name="parent_name"
                                        value="{{ old('parent_name') }}">
                                    @error('parent_name')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="entry_date">Entry Date</label>
                                    <input type="date" class="form-control" id="entry_date" name="entry_date"
                                        value="{{ old('entry_date') }}">
                                    @error('entry_date')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="registration_date">Registration Date</label>
                                    <input type="date" class="form-control" id="registration_date"
                                        name="registration_date" value="{{ old('registration_date') }}">
                                    @error('registration_date')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level" name="level"
                                        value="{{ old('level') }}">
                                    @error('level')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="book_start">Book Start</label>
                                    <input type="text" class="form-control" id="book_start" name="book_start"
                                        value="{{ old('book_start') }}">
                                    @error('book_start')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="parent_email">Parent Email</label>
                                    <input type="email" class="form-control" id="parent_email" name="parent_email"
                                        value="{{ old('parent_email') }}">
                                    @error('parent_email')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status_id">Status</label>
                                    <select class="form-control" id="status_id" name="status_id">
                                        <option value="">-- Select Status --</option>
                                        @foreach ($studentStatuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
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
