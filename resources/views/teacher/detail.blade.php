<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    @include('templates.header')

    <style>
        .table {
            border-radius: 5px;
            overflow: hidden;
        }
    </style>
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
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <img class="rounded-circle mb-4" width="100px"
                                src="{{ asset('template/img/undraw_profile_1.svg') }}" alt="...">
                            <div class="d-flex justify-content-center">
                                <h1 class="h4 text-gray-800 mb-4">
                                    {{ $teacher->name }}
                                </h1>
                                <a href="{{ route('teacher.edit', $teacher->id) }}">
                                    <i class="fas fa-sm fa-pen ml-2 mt-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Table Basic Info --}}
                        <div class="col-4">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <i class="fas fa-home mr-1"></i>Informasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><b>{{ $teacher->name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><b>{{ $teacher->phone_number }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- Table Pembayaran --}}
                        <div class="col-4">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <i class="fas fa-dollar-sign mr-1"></i>Insentif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Invoices</td>
                                        <td>
                                            {{-- <a class="btn btn-sm btn-primary" href="#">Jumlah Murid Per Level</a> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- Table Kelas --}}
                        <div class="col-4">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <i class="fas fa-home mr-1"></i>Kelas
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lihat Absensi</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Absensi Guru</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Absensi Murid</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Absen</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">View Kelas</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
