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
                    <h1 class="h3 mb-4 text-gray-800">Manage Role for Account</h1>

                    <!-- Role List -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Assigned Roles</h5>
                            <p class="card-text">Below are the available roles that can be assigned to accounts.</p>

                            <!-- Table with role details -->
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('role.manage', $role->id) }}"
                                                    class="badge badge-info">
                                                    <i class="fas fa-cogs"></i> Manage
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
