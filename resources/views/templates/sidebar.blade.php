<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homepage') }}">
        <div class="sidebar-brand-text mx-1">Absensi</div>
        {{-- <img src="{{ asset('template/img/Logo Removed.png') }}" width="100%" alt="..."> --}}
    </a>
    @auth
        @if (Auth::user()->role_id == 1)
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('homepage') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.role') }}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Role</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Control
            </div>

            <!-- Data Management -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData"
                    aria-expanded="true" aria-controls="collapseData">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Data Management</span>
                </a>
                <div id="collapseData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('teacher.index') }}">Data Guru</a>
                        <a class="collapse-item" href="{{ route('student.index') }}">Data Siswa</a>
                        <a class="collapse-item" href="{{ route('classroom.index') }}">Data Kelas</a>
                        <a class="collapse-item" href="{{ route('presence.index') }}">Data Kehadiran</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main Navigation
            </div>

            <!-- Role -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRole"
                    aria-expanded="true" aria-controls="collapseRole">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Role</span>
                </a>
                <div id="collapseRole" class="collapse" aria-labelledby="headingRole" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('role.index') }}">Data</a>
                    </div>
                </div>
            </li>

            <!-- Center -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCenter"
                    aria-expanded="true" aria-controls="collapseCenter">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Center</span>
                </a>
                <div id="collapseCenter" class="collapse" aria-labelledby="headingCenter" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('center.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('center.create') }}">Tambah</a>
                    </div>
                </div>
            </li>

            <!-- Fee -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFee"
                    aria-expanded="true" aria-controls="collapseFee">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Biaya</span>
                </a>
                <div id="collapseFee" class="collapse" aria-labelledby="headingFee" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('fee.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('fee.create') }}">Tambah</a>
                    </div>
                </div>
            </li>

            <!-- Pembayaran -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembayaran"
                    aria-expanded="true" aria-controls="collapsePembayaran">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Pembayaran</span>
                </a>
                <div id="collapsePembayaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('payment.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('payment.create') }}">Tambah</a>
                    </div>
                </div>
            </li>

            <!-- Guru -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGuru"
                    aria-expanded="true" aria-controls="collapseGuru">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Guru</span>
                </a>
                <div id="collapseGuru" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('teacher.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('teacher.create') }}">Tambah</a>
                        <a class="collapse-item" href="{{ route('classroom.teaching') }}">Jadwal Mengajar</a>
                        <a class="collapse-item" href="#">Absensi</a>
                        <a class="collapse-item" href="#">Buat Permintaan Training</a>
                    </div>
                </div>
            </li>

            <!-- Murid -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMurid"
                    aria-expanded="true" aria-controls="collapseMurid">
                    <i class="fas fa-fw fa-child"></i>
                    <span>Murid</span>
                </a>
                <div id="collapseMurid" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('student.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('student.create') }}">Tambah</a>
                        <a class="collapse-item" href="#">Absensi</a>
                    </div>
                </div>
            </li>

            <!-- Kelas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelas"
                    aria-expanded="true" aria-controls="collapseKelas">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Kelas</span>
                </a>
                <div id="collapseKelas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('classroom.index') }}">Data</a>
                        <a class="collapse-item" href="#">Absensi Hari ini</a>
                        <a class="collapse-item" href="{{ route('classroom.manage') }}">Manage Kelas</a>
                    </div>
                </div>
            </li>

            <!-- Kehadiran -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKehadiran"
                    aria-expanded="true" aria-controls="collapseKehadiran">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Kehadiran</span>
                </a>
                <div id="collapseKehadiran" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('presence.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('presence.create') }}">Absensi</a>
                        <a class="collapse-item" href="{{ route('presence.report') }}">Laporan</a>
                    </div>
                </div>
            </li>
        @elseif (Auth::user()->role_id == 2)
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main Navigation
            </div>

            <!-- Guru -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGuru"
                    aria-expanded="true" aria-controls="collapseGuru">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Guru</span>
                </a>
                <div id="collapseGuru" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('teacher.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('teacher.create') }}">Tambah</a>
                        <a class="collapse-item" href="{{ route('classroom.teaching') }}">Jadwal Mengajar</a>
                        <a class="collapse-item" href="#">Absensi</a>
                        <a class="collapse-item" href="#">Buat Permintaan Training</a>
                    </div>
                </div>
            </li>

            <!-- Murid -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMurid"
                    aria-expanded="true" aria-controls="collapseMurid">
                    <i class="fas fa-fw fa-child"></i>
                    <span>Murid</span>
                </a>
                <div id="collapseMurid" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('student.index') }}">Data</a>
                        <a class="collapse-item" href="{{ route('student.create') }}">Tambah</a>
                        <a class="collapse-item" href="#">Absensi</a>
                    </div>
                </div>
            </li>

            <!-- Kelas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelas"
                    aria-expanded="true" aria-controls="collapseKelas">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Kelas</span>
                </a>
                <div id="collapseKelas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('classroom.index') }}">Data</a>
                        <a class="collapse-item" href="#">Absensi Hari ini</a>
                        <a class="collapse-item" href="{{ route('classroom.manage') }}">Manage Kelas</a>
                    </div>
                </div>
            </li>
        @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
