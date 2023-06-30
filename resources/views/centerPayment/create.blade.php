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
                    <h1 class="h3 mb-4 text-gray-800">Create Data Center</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('centerPayment.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="center_id">Center</label>
                                    <select class="form-control @error('center_id') is-invalid @enderror" id="center_id"
                                        name="center_id">
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
                                    <label for="registration_fee_old">Registration Fee Old</label>
                                    <input type="text"
                                        class="form-control @error('registration_fee_old') is-invalid @enderror"
                                        id="registration_fee_old" name="registration_fee_old"
                                        value="{{ old('registration_fee_old') }}">
                                    @error('registration_fee_old')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_old">Equipment Fee Old</label>
                                    <input type="text"
                                        class="form-control @error('equipment_fee_old') is-invalid @enderror"
                                        id="equipment_fee_old" name="equipment_fee_old"
                                        value="{{ old('equipment_fee_old') }}">
                                    @error('equipment_fee_old')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_old">Course Fee Old</label>
                                    <input type="text"
                                        class="form-control @error('course_fee_old') is-invalid @enderror"
                                        id="course_fee_old" name="course_fee_old" value="{{ old('course_fee_old') }}">
                                    @error('course_fee_old')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="registration_fee_new">Registration Fee New</label>
                                    <input type="text"
                                        class="form-control @error('registration_fee_new') is-invalid @enderror"
                                        id="registration_fee_new" name="registration_fee_new"
                                        value="{{ old('registration_fee_new') }}">
                                    @error('registration_fee_new')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_new">Equipment Fee New</label>
                                    <input type="text"
                                        class="form-control @error('equipment_fee_new') is-invalid @enderror"
                                        id="equipment_fee_new" name="equipment_fee_new"
                                        value="{{ old('equipment_fee_new') }}">
                                    @error('equipment_fee_new')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_new">Course Fee New</label>
                                    <input type="text"
                                        class="form-control @error('course_fee_new') is-invalid @enderror"
                                        id="course_fee_new" name="course_fee_new" value="{{ old('course_fee_new') }}">
                                    @error('course_fee_new')
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
