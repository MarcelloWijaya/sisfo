<!DOCTYPE html>
<html lang="en">

<head>
    <title>SB Admin 2 - Blank</title>
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
                    <h1 class="h3 mb-3 text-gray-800"> </h1>
                    <table class="table table-bordered">
                        <tr>
                        <tr>
                            <td class="fw-bold" style="width: 20%;"> Center </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="fw-bold"> Owner </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="fw-bold"> Alamat </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="fw-bold"> No. Telp </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="fw-bold"> Email </td>
                            <td></td>
                        </tr>
                        </tr>
                    </table>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    @include('templates.script')
</body>

</html>
