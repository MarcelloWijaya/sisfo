<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    @include('templates.header')

    @php
        use Carbon\Carbon;
        
        $value = $payments->last()->payment_date;
        $newValue = \Carbon\Carbon::parse($value)
            ->addMonth()
            ->format('m-Y');
    @endphp
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


                    <div class="d-flex justify-content-between mb-4">
                        <h1 class="h4 text-gray-800">Invoices {{ $student->name }}</h1>
                        <div class="justify-content-end">
                            <a href="#" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                data-bs-target="#iuran-bulanan-modal">Buat Invoice Iuran Bulanan</a>
                            <a href="{{ route('student.detail', ['student_id' => $student->id]) }}"
                                class="btn btn-primary">Back to
                                profile</a>
                        </div>
                    </div>


                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="iuran-bulanan-tab" data-bs-toggle="tab"
                                data-bs-target="#iuran-bulanan" type="button" role="tab"
                                aria-controls="iuran-bulanan" aria-selected="true">Iuran Bulanan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="iuran-buku-tab" data-bs-toggle="tab"
                                data-bs-target="#iuran-buku" type="button" role="tab" aria-controls="iuran-buku"
                                aria-selected="false">Iuran Buku</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="iuran-bulanan" role="tabpanel"
                            aria-labelledby="iuran-bulanan-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Kupon</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Print</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $newValue }}</td>
                                        <form action="{{ route('payment.store') }}" method="POST">
                                            @csrf
                                            <td><button class="btn btn-sm btn-secondary" type="submit">Pay Now</button>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="no_kupon">No Kupon</label>
                                                    <input type="text" class="form-control" id="no_kupon"
                                                        name="no_kupon" placeholder="Masukkan No Kupon">
                                                </div>

                                                <div class="form-group">
                                                    <label for="diskon">Diskon</label>
                                                    <input type="number" class="form-control" id="diskon"
                                                        name="diskon" placeholder="Masukkan Diskon">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="jenis_pembayaran"
                                                        name="jenis_pembayaran">
                                                        <option value="Cash">Cash</option>
                                                        <option value="Debit">Debit</option>
                                                        <option value="EDC">EDC</option>
                                                        <option value="Kartu Kredit">Kartu Kredit</option>
                                                        <option value="Transfer">Transfer</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </form>
                                        <td></td>
                                        <td><a href="" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash"></i></a></td>
                                    </tr>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ date('m-Y', strtotime($payment->payment_date)) }}</td>
                                            <td>{{ $payment->status }}</td>
                                            <td>Kupon</td>
                                            <td>{{ $payment->payment_date }}</td>
                                            <td>Jenis</td>
                                            <td><i class="fas fa-print"></i></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="iuran-buku" role="tabpanel" aria-labelledby="iuran-buku-tab">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Tanggal</th>
                                        <th>Kurikulum</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>No Buku</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr class="text-center">
                                        <td>{{ date('m-Y', strtotime($payment->payment_date)) }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>Kupon</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>Jenis</td>
                                        <td><i class="fas fa-print"></i></td>
                                    </tr> --}}
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

    {{-- <!-- Modal Iuran Bulanan -->
    <div class="modal fade" id="iuran-bulanan-modal" tabindex="-1" role="dialog"
        aria-labelledby="iuran-bulanan-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iuran-bulanan-modal-label">Buat Invoice Iuran Bulanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Iuran Bulanan -->
                    <form action="{{ route('payment.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <input type="text" class="form-control" id="bulan" value="{{ $newValue }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="no_kupon">No Kupon</label>
                            <input type="text" class="form-control" id="no_kupon" name="no_kupon"
                                placeholder="Masukkan No Kupon">
                        </div>

                        <div class="form-group">
                            <label for="no_kupon">No Kupon</label>
                            <input type="text" class="form-control" id="no_kupon" name="no_kupon"
                                placeholder="Masukkan No Kupon">
                        </div>

                        <div class="form-group">
                            <label for="diskon">Diskon</label>
                            <input type="number" class="form-control" id="diskon" name="diskon"
                                placeholder="Masukkan Diskon">
                        </div>

                        <div class="form-group">
                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran">
                                <option value="Cash">Cash</option>
                                <option value="Debit">Debit</option>
                                <option value="EDC">EDC</option>
                                <option value="Kartu Kredit">Kartu Kredit</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </div>
            </div>
        </div>
    </div> --}}

    @include('templates.script')
</body>

</html>
