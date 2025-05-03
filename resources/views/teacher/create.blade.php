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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Data Guru</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="teacher_name">Nama Lengkap Guru</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                        value="{{ old('teacher_name') }}" placeholder="Masukkan nama lengkap">
                                    @error('teacher_name')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <label for="center_id">Cabang</label>
                                <select class="form-control @error('center_id') is-invalid @enderror" id="center_id"
                                    name="center_id" required>
                                    <option value="">Pilih Cabang</option>
                                    @foreach ($centers as $center)
                                        <option value="{{ $center->id }}"
                                            {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                            {{ $center->name }} <!-- Asumsi ada field 'name' di model Center -->
                                        </option>
                                    @endforeach
                                </select>
                                @error('center_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="nickname">Nama Panggilan</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname"
                                        value="{{ old('nickname') }}" placeholder="Masukkan nama panggilan">
                                    @error('nickname')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="place_of_birth">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                        value="{{ old('place_of_birth') }}" placeholder="Masukkan tempat lahir">
                                    @error('place_of_birth')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="2" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number') }}" placeholder="Masukkan nomor telepon">
                                    @error('phone_number')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="last_education">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" id="last_education" name="last_education"
                                        value="{{ old('last_education') }}"
                                        placeholder="Contoh: S1 Pendidikan Matematika">
                                    @error('last_education')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="teacher_email">Alamat Email</label>
                                    <input type="email" class="form-control" id="teacher_email" name="teacher_email"
                                        value="{{ old('teacher_email') }}" placeholder="Masukkan alamat email">
                                    @error('teacher_email')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
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
