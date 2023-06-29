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
                                    <label for="registration_fee">Registration Fee</label>
                                    <input type="text" class="form-control" id="registration_fee"
                                        name="registration_fee" required
                                        value="{{ old('registration_fee', $centerPayment->registration_fee) }}">
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee">Equipment Fee</label>
                                    <input type="text" class="form-control" id="equipment_fee" name="equipment_fee"
                                        required value="{{ old('equipment_fee', $centerPayment->equipment_fee) }}">
                                </div>

                                <div class="form-group">
                                    <label for="course_fee">Course Fee</label>
                                    <input type="text" class="form-control" id="course_fee" name="course_fee"
                                        required value="{{ old('course_fee', $centerPayment->course_fee) }}">
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
