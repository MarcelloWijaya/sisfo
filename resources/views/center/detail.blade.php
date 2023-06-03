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
                    @foreach ($centers as $center)
                        @if ($center->id === auth()->user()->center_id)
                            <h1 class="h3 mb-3 text-gray-800">{{ $center->center_name }}</h1>
                            <table class="table table-striped text-dark">
                                <tr>
                                    <td class="fw-bold"> Owner </td>
                                    <td>{{ $center->owner }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"> Alamat </td>
                                    <td>{{ $center->address }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"> No. Telp </td>
                                    <td>{{ $center->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"> Email </td>
                                    <td>{{ $center->email_center }}</td>
                                </tr>
                            </table>
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
