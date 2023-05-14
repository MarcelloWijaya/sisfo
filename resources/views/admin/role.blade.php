<!DOCTYPE html>
<html lang="en">

<head>
    <title>Role</title>
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
                    {{-- Error Message --}}
                    <h1 class="h3 mb-2 text-gray-800">Role</h1>

                    <div>
                        @if (\Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                {{ \Session::get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Role </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($user_roles as $ur)
                                            <tr class="text-center">
                                                <td>{{ $ur->id }}</td>
                                                <td>{{ $ur->role_name }}</td>
                                                <td>
                                                    <a href="" class="badge badge-warning">Access</a>
                                                    <a href="" class="badge badge-success">Edit</a>
                                                    <a href="" class="badge badge-danger">Delete</a>
                                                </td>
                                                {{-- <td>
                                                    @if ($u->is_active == 0)
                                                        <a href="{{ route('admin.giveaccess', ['user_id' => $u->id]) }}"
                                                            type="button"
                                                            class="btn btn-sm btn-warning text-dark"><b>Give
                                                                Access</b></a>
                                                    @elseif($u->is_active == 1)
                                                        <a href="{{ route('admin.removeaccess', ['user_id' => $u->id]) }}"
                                                            type="button" class="btn btn-sm btn-danger"><b>Remove
                                                                Access</b></a>
                                                    @endif
                                                </td> --}}
                                                {{-- <td>
                                                    <div class="row justify-content-around">
                                                        <a href="" type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#newEditRoleModal{{ $u->id }}"><i
                                                                class="fas fa-pen"></i></a>
                                                        <form
                                                            action="{{ route('admin.deleteuser', ['user_id' => $u->id]) }}"
                                                            method="POST">
                                                            {{ method_field('DELETE') }}
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger"> <i
                                                                    class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr> --}}
                                                <!-- Modal Edit Role -->
                                                {{-- <div class="modal fade" id="newEditRoleModal{{ $u->id }}"
                                                tabindex="-1" aria-labelledby="newEditRoleModal{{ $u->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="newEditRoleModal{{ $u->id }}">Edit Role</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('admin.updateuser', ['user_id' => $u->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            {{ method_field('put') }}
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="role_ins">Edit Role</label>
                                                                    <select class="form-control" id="role_ins"
                                                                        name="role">
                                                                        <option value="">--select Role--</option>
                                                                        @foreach ($User_roles as $ur)
                                                                            @if ($u->role_id == $ur->id)
                                                                                <option value={{ $ur->id }}
                                                                                    selected>{{ $ur->name }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $ur->id }}>
                                                                                    {{ $ur->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
