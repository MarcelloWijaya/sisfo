<!DOCTYPE html>
<html lang="id">

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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Data Biaya</h1>

                    {{-- Notifikasi pesan sukses/gagal --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('fee.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="center_id">Pilih Center</label>
                                    <select class="form-control" name="center_id">
                                        <option value="" disabled selected>-- Pilih Center --</option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                                {{ $center->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('center_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="academic_year">Tahun Akademik</label>
                                    <input type="text" class="form-control" name="academic_year"
                                        value="{{ old('academic_year') }}" placeholder="Masukkan tahun akademik">
                                    @error('academic_year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="payment_type">Jenis Pembayaran</label>
                                    <select class="form-control" name="payment_type">
                                        <option value="Monthly"
                                            {{ old('payment_type') == 'Monthly' ? 'selected' : '' }}>Bulanan</option>
                                        <option value="Quarterly"
                                            {{ old('payment_type') == 'Quarterly' ? 'selected' : '' }}>Triwulan
                                        </option>
                                        <option value="Semester"
                                            {{ old('payment_type') == 'Semester' ? 'selected' : '' }}>Semester</option>
                                        <option value="Yearly" {{ old('payment_type') == 'Yearly' ? 'selected' : '' }}>
                                            Tahunan</option>
                                    </select>
                                    @error('payment_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="registration_fee">Biaya Pendaftaran</label>
                                    <input type="number" class="form-control" name="registration_fee"
                                        value="{{ old('registration_fee') }}" placeholder="Masukkan biaya pendaftaran">
                                    @error('registration_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee">Biaya Peralatan</label>
                                    <input type="number" class="form-control" name="equipment_fee"
                                        value="{{ old('equipment_fee') }}" placeholder="Masukkan biaya peralatan">
                                    @error('equipment_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_fee">Biaya Kursus</label>
                                    <input type="number" class="form-control" name="course_fee"
                                        value="{{ old('course_fee') }}" placeholder="Masukkan biaya kursus">
                                    @error('course_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="note">Catatan</label>
                                    <textarea class="form-control" name="note" rows="3" placeholder="Masukkan catatan">{{ old('note') }}</textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah Fee</button>
                            </form>
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
