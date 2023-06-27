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
                            <form action="{{ route('center.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Center Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        required value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="owner">Owner</label>
                                    <input type="text" class="form-control" id="owner" name="owner" required
                                        value="{{ old('owner') }}">
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required
                                        value="{{ old('address') }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number') }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Center</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        required value="{{ old('email') }}">
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
