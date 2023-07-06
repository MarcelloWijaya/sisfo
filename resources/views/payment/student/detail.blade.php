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


                    <div class="d-flex justify-content-between mb-4">
                        <h1 class="h4 text-gray-800">Invoices {{ $student->name }}</h1>
                        <div class="justify-content-end">
                            <a href="#" class="btn btn-primary mr-2" onclick="toggleFormRow()">Buat Invoice Iuran
                                Bulanan</a>
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
                                    @foreach ($payments as $payment)
                                        <tr id="form-row" style="display: none;">
                                            <td>{{ date('m-Y', strtotime($payment->payment_date)) }}</td>
                                            <form action="{{ route('payment.store', ['student_id' => $student->id]) }}"
                                                method="POST">
                                                @csrf
                                                <td><button class="btn btn-sm btn-secondary" type="submit">Pay
                                                        Now</button>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="coupon_number">No Kupon</label>
                                                        <input type="text" class="form-control" id="coupon_number"
                                                            name="coupon_number" placeholder="Masukkan No Kupon">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="discount">Diskon</label>
                                                        <input type="number" class="form-control" id="discount"
                                                            name="discount" placeholder="Masukkan Diskon">
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control" id="payment_type"
                                                            name="payment_type">
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
                                            <td>    
                                                <a href="" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @if ($payment->status_id == 1)
                                            <tr>
                                                <td>{{ date('m-Y', strtotime($payment->payment_date)) }}</td>
                                                <td>{{ $payment->status->name }}</td>
                                                <td>{{ $payment->coupun_number }}</td>
                                                <td>{{ $payment->payment_date }}</td>
                                                <td>{{ $payment->payment_type }}</td>
                                                <td><a
                                                        href="{{ route('payment.invoice', ['payment_id' => $payment->id]) }}"><i
                                                            class="fas fa-print"></i></a></td>
                                            </tr>
                                        @endif
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

    <script>
        function toggleFormRow() {
            const formRow = document.getElementById('form-row');
            formRow.style.display = formRow.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
    @include('templates.script')
</body>

</html>
