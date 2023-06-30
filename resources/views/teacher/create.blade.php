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
                    <h1 class="h3 mb-4 text-gray-800">Create Teacher Data</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher.store') }}" method="POST">
                                @csrf
                                @if (Auth::user()->center_id == null)
                                    <div class="form-group">
                                        <label for="center_id">Center</label>
                                        <select class="form-control" id="center_id" name="center_id">
                                            <option value="">-- Select Center --</option>
                                            @foreach ($centers as $center)
                                                <option value="{{ $center->id }}"
                                                    {{ old('center_id') == $center->id || (Auth::check() && Auth::user()->center_id == $center->id) ? 'selected' : '' }}>
                                                    {{ $center->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('center_id')
                                            <span class="text-danger"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="entry_date">Entry Date</label>
                                    <input type="date" class="form-control" id="entry_date" name="entry_date"
                                        value="{{ old('entry_date') }}" placeholder="Enter entry date">
                                    @error('entry_date')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Teacher Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter teacher name">
                                    @error('name')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nickname">Nickname</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname"
                                        value="{{ old('nickname') }}" placeholder="Enter nickname">
                                    @error('nickname')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address') }}" placeholder="Enter address">
                                    @error('address')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="place_of_birth">Place of Birth</label>
                                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                        value="{{ old('place_of_birth') }}" placeholder="Enter place of birth">
                                    @error('place_of_birth')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}" placeholder="Enter date of birth">
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
                                        <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>
                                            Hindu
                                        </option>
                                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>
                                            Islam
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
                                        value="{{ old('phone_number') }}" placeholder="Enter phone number">
                                    @error('phone_number')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="last_education">Last Education</label>
                                    <input type="text" class="form-control" id="last_education"
                                        name="last_education" value="{{ old('last_education') }}"
                                        placeholder="Enter last education">
                                    @error('last_education')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Teacher Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter email">
                                    @error('email')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="training_date">Training Date</label>
                                    <input type="date" class="form-control" id="training_date"
                                        name="training_date" value="{{ old('training_date') }}"
                                        placeholder="Enter training date">
                                    @error('training_date')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status_id">Status</label>
                                    <select class="form-control" id="status_id" name="status_id">
                                        <option value="">-- Select Status --</option>
                                        @foreach ($teacherStatuses as $status)
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
