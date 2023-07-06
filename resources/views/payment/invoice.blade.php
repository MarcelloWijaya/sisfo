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

                    <!-- Invoice -->
                    <div class="invoice">
                        <div class="invoice-header">
                            <h1>Invoice</h1>
                        </div>
                        <div class="invoice-details">
                            <p>Center: {{ $payment->center->name }}</p>
                            <p>Address: {{ $payment->center->address }}</p>
                            <p>Phone: {{ $payment->center->phone_number }}</p>
                            <p>Invoice Number: {{ $invoice->invoice_number }}</p>
                            <p>Payment Date: {{ $invoice->payment_date }}</p>
                            <p>Student Name: {{ $student->name }}</p>
                            <p>NIS: {{ $student->nis }}</p>
                        </div>
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kupon Number</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kupon_number }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End of Invoice -->

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
