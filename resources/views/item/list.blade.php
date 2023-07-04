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

                    <div class="row">
                        @foreach ($items as $item)
                            <div class="col-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <img src="{{ asset('storage/images/' . $item->image) }}" width="100px"
                                                class="img-fluid" alt="...">
                                            <div class="card-text ml-4">
                                                <div>{{ $item->name }}</div>
                                                <div class="mb-4"><b>IDR {{ $item->price }},-</b></div>
                                                <div class="mt-4"><button class="btn btn-sm btn-secondary">Add to Cart
                                                        <i class="fas fa-shopping-cart"></i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
