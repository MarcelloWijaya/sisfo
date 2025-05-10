<!DOCTYPE html>
<html lang="id">

<head>
    <title>{{ $title }}</title>
    @include('templates.header')
</head>

<body id="page-top">

    <div id="wrapper">
        @include('templates.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('templates.topbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Data Biaya</h1>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('fee.update', $fee->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="center_id">Pilih Center</label>
                                    <select class="form-control" name="center_id">
                                        <option disabled>-- Pilih Center --</option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->id }}"
                                                {{ old('center_id', $fee->center_id) == $center->id ? 'selected' : '' }}>
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
                                        value="{{ old('academic_year', $fee->academic_year) }}">
                                    @error('academic_year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="payment_type">Jenis Pembayaran</label>
                                    <select class="form-control" name="payment_type">
                                        <option value="3 Bulan"
                                            {{ old('payment_type', $fee->payment_type) == '3 Bulan' ? 'selected' : '' }}>
                                            3 Bulan</option>
                                        <option value="6 Bulan"
                                            {{ old('payment_type', $fee->payment_type) == '6 Bulan' ? 'selected' : '' }}>
                                            6 Bulan</option>
                                        <option value="12 Bulan"
                                            {{ old('payment_type', $fee->payment_type) == '12 Bulan' ? 'selected' : '' }}>
                                            12 Bulan</option>
                                    </select>
                                    @error('payment_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="registration_fee_display">Biaya Pendaftaran</label>
                                    <input type="text" class="form-control rupiah" id="registration_fee_display"
                                        value="{{ old('registration_fee', 'Rp. ' . number_format($fee->registration_fee, 0, ',', '.')) }}"
                                        placeholder="Masukkan biaya pendaftaran">
                                    <input type="hidden" name="registration_fee" id="registration_fee"
                                        value="{{ old('registration_fee', $fee->registration_fee) }}">
                                    @error('registration_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="equipment_fee_display">Biaya Peralatan</label>
                                    <input type="text" class="form-control rupiah" id="equipment_fee_display"
                                        value="{{ old('equipment_fee', 'Rp. ' . number_format($fee->equipment_fee, 0, ',', '.')) }}"
                                        placeholder="Masukkan biaya peralatan">
                                    <input type="hidden" name="equipment_fee" id="equipment_fee"
                                        value="{{ old('equipment_fee', $fee->equipment_fee) }}">
                                    @error('equipment_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="course_fee_display">Biaya Kursus</label>
                                    <input type="text" class="form-control rupiah" id="course_fee_display"
                                        value="{{ old('course_fee', 'Rp. ' . number_format($fee->course_fee, 0, ',', '.')) }}"
                                        placeholder="Masukkan biaya kursus">
                                    <input type="hidden" name="course_fee" id="course_fee"
                                        value="{{ old('course_fee', $fee->course_fee) }}">
                                    @error('course_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="note">Catatan</label>
                                    <textarea class="form-control" name="note" rows="3">{{ old('note', $fee->note) }}</textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update Biaya</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            @include('templates.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('templates.script')
</body>

</html>
