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
                    <h1 class="h3 mb-4 text-gray-800">Edit Biaya Center</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('centerPayment.update', $centerPayment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="center_id">Center</label>
                                    <select class="form-control" id="center_id" name="center_id" required>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id', $centerPayment->center_id) == $center->id ? 'selected' : '0' }}>
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
                                    <input type="text" class="form-control" id="registration_fee_old"
                                        name="registration_fee_old" required
                                        value="{{ old('registration_fee_old', $centerPayment->registration_fee_old ?? '0') }}">
                                    @error('registration_fee_old')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_old">Equipment Fee Old</label>
                                    <input type="text" class="form-control" id="equipment_fee_old"
                                        name="equipment_fee_old" required
                                        value="{{ old('equipment_fee_old', $centerPayment->equipment_fee_old ?? '0') }}">
                                    @error('equipment_fee_old')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_old">Course Fee Old</label>
                                    <input type="text" class="form-control" id="course_fee_old" name="course_fee_old"
                                        required
                                        value="{{ old('course_fee_old', $centerPayment->course_fee_old ?? '0') }}">
                                    @error('course_fee_old')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="registration_fee_new">Registration Fee New</label>
                                    <input type="text" class="form-control" id="registration_fee_new"
                                        name="registration_fee_new" required
                                        value="{{ old('registration_fee_new', $centerPayment->registration_fee_new ?? '0') }}">
                                    @error('registration_fee_new')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_new">Equipment Fee New</label>
                                    <input type="text" class="form-control" id="equipment_fee_new"
                                        name="equipment_fee_new" required
                                        value="{{ old('equipment_fee_new', $centerPayment->equipment_fee_new ?? '0') }}">
                                    @error('equipment_fee_new')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_new">Course Fee New</label>
                                    <input type="text" class="form-control" id="course_fee_new" name="course_fee_new"
                                        required
                                        value="{{ old('course_fee_new', $centerPayment->course_fee_new ?? '0') }}">
                                    @error('course_fee_new')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
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

</html
