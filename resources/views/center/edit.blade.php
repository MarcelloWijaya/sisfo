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
                    <h1 class="h3 mb-4 text-gray-800">Edit Center</h1>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('center.update', $center->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="center_name">Center Name</label>
                                    <input type="text" class="form-control" id="center_name" name="center_name"
                                        required value="{{ old('center_name', $center->center_name) }}">
                                </div>

                                <div class="form-group">
                                    <label for="owner">Owner</label>
                                    <input type="text" class="form-control" id="owner" name="owner" required
                                        value="{{ old('owner', $center->owner) }}">
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required
                                        value="{{ old('address', $center->address) }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number', $center->phone_number) }}">
                                </div>

                                <div class="form-group">
                                    <label for="email_center">Email Center</label>
                                    <input type="email" class="form-control" id="email_center" name="email_center"
                                        required value="{{ old('email_center', $center->email_center) }}">
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
