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
                    <!-- Page Heading -->
                    @foreach ($centerPayments as $centerPayment)
                        @if ($centerPayment->center_id === auth()->user()->center_id)
                            <form action="{{ route('centerPayment.update', $centerPayment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="registration_fee_old">Registration Fee Old</label>
                                    <input type="text" class="form-control" id="registration_fee_old"
                                        name="registration_fee_old" required
                                        value="{{ old('registration_fee_old', $centerPayment->registration_fee_old) }}">
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_old">Equipment Fee</label>
                                    <input type="text" class="form-control" id="equipment_fee_old"
                                        name="equipment_fee_old" required
                                        value="{{ old('equipment_fee_old', $centerPayment->equipment_fee_old) }}">
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_old">Course Fee</label>
                                    <input type="text" class="form-control" id="course_fee_old" name="course_fee_old"
                                        required value="{{ old('course_fee_old', $centerPayment->course_fee_old) }}">
                                </div>

                                <div class="form-group">
                                    <label for="registration_fee_new">Registration Fee New</label>
                                    <input type="text" class="form-control" id="registration_fee_new"
                                        name="registration_fee_new" required
                                        value="{{ old('registration_fee_new', $centerPayment->registration_fee_old) }}">
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_new">Equipment Fee New</label>
                                    <input type="text" class="form-control" id="equipment_fee_new"
                                        name="equipment_fee_new" required
                                        value="{{ old('equipment_fee_new', $centerPayment->equipment_fee_old) }}">
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_new">Course Fee New</label>
                                    <input type="text" class="form-control" id="course_fee_new" name="course_fee_new"
                                        required value="{{ old('course_fee_new', $centerPayment->course_fee_old) }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        @break
                    @endif
                @endforeach
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
