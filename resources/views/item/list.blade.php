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
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myCartModal">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>

                    <!-- Cart Modal -->
                    <div class="modal fade" id="myCartModal" tabindex="-1" role="dialog"
                        aria-labelledby="myCartModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myCartModalLabel">
                                        <i class="fas fa-shopping-cart"></i>
                                        My Cart
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($cart->cart_items as $cart_item)
                                        <div class="row align-items-center">
                                            <div class="col-1">
                                                <img src="{{ asset('storage/images/' . $cart_item->item->image) }}"
                                                    width="34px" class="img-fluid mr-4" alt="...">
                                            </div>
                                            <div class="col-3">{{ $cart_item->item->name }}</div>
                                            <div class="col-2">
                                                IDR {{ number_format($cart_item->item->price, 0, ',', '.') }},-
                                            </div>
                                            <div class="col-2">
                                                <form
                                                    action="{{ route('item.updateQuantity', ['item_id' => $cart_item->item->id]) }}"
                                                    method="POST"
                                                    oninput="updateTotal({{ $cart_item->item->id }}, this.elements['quantity'].value * {{ $cart_item->item->price }})">
                                                    {{ method_field('PUT') }}
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="number" class="form-control"
                                                            value="{{ $cart_item->quantity }}" id="quantityInput"
                                                            name="quantity">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-3">
                                                IDR {{ number_format($cart_item->total, 0, ',', '.') }},-
                                            </div>
                                            <div class="col-1">
                                                <form
                                                    action="{{ route('item.removeFromCart', ['item_id' => $cart_item->item->id]) }}"
                                                    method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{ route('item.checkout') }}" method="POST">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                <b>{{ \Session::get('success') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (\Session::has('delete'))
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                <b>{{ \Session::get('delete') }}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

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
                                                <div class="mb-4"><b>IDR
                                                        {{ number_format($item->price, 0, ',', '.') }},-</b></div>
                                                <form action="{{ route('item.addToCart', ['item_id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-secondary">Add to
                                                        Cart<i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                </form>
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
