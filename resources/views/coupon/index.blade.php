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
                    <h1 class="h3 mb-2 text-gray-800">Coupon Data</h1>
                    <div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                <b>{{ \Session::get('success') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (\Session::has('delete'))
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                <b>{{ \Session::get('delete') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h6 class="m-0 mt-1 font-weight-bold text-primary">Coupon Data</h6>
                            {{-- <a href="{{ route('coupon.create') }}" class="btn btn-sm btn-primary">Add Coupon</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover">
                                <table id="dt_table" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Center</th>
                                            <th>Order Date</th>
                                            <th>Bundle</th>
                                            <th style="width: 200px;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Center</th>
                                            <th>Order Date</th>
                                            <th>Bundle</th>
                                            <th style="width: 200px;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($coupons as $coupon)
                                            <tr class="text-center">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $coupon->coupon_bundle->center->name }}</td>
                                                <td>{{ $coupon->coupon_bundle->order_date }}</td>
                                                <td>{{ $coupon->coupon_bundle->quantity }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('coupon.updateStatus', ['coupon_bundle_id' => $coupon->coupon_bundle->id]) }}"
                                                        method="POST">
                                                        {{ method_field('PUT') }}
                                                        @csrf
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-auto">
                                                                <select class="form-control" id="statusInput"
                                                                    name="status_id">
                                                                    @foreach ($coupon_statuses as $status)
                                                                        <option value="{{ $status->id }}"
                                                                            {{ $coupon->status_id == $status->id ? 'selected' : '' }}>
                                                                            {{ $status->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-auto">
                                                                <button type="submit" class="btn btn-sm btn-success">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td></td>
                                                {{-- <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('coupon.edit', $coupon->id) }}"
                                                            class="btn btn-sm btn-primary mx-1">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $coupon->id }}"
                                                            action="{{ route('coupon.destroy', $coupon->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger mx-1">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td> --}}
                                            </tr>
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
