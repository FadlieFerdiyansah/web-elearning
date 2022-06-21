@auth('admin')
<li class="dropdown{{ request()->routeIs('fakultas.index') ? ' active' : '' }}">
    <a href="{{ route('fakultas.index') }}" class="nav-link"><i
            data-feather="briefcase"></i><span>Fakultas</span></a>
</li>
<li class="dropdown{{ request()->routeIs('kelas.index') ? ' active' : '' }}">
    <a href="{{ route('kelas.index') }}" class="nav-link"><i
            data-feather="layers"></i><span>Kelas</span></a>
</li>
<li class="dropdown{{ request()->routeIs('matkuls.index') ? ' active' : '' }}">
    <a href="{{ route('matkuls.index') }}" class="nav-link"><i
            data-feather="book-open"></i><span>Matakuliah</span></a>
</li>

@include('components.spesifik_menu.partials.menu',[
'icon' => 'calendar',
'parentName' => 'Jadwal',
// 'nameRoute' => ['jadwals.index','jadwals.pengganti'],
'nameRoute' => ['jadwals.index'],
'countChild' => 1,
// 'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
'childName' => ['Jadwal Kuliah'],
])

@can('management roles and permissions')
@include('components.spesifik_menu.partials.menu',[
'icon' => 'user-plus',
'parentName' => 'Create Users',
'nameRoute' => ['dosens.create','mahasiswa.create'],
'countChild' => 2,
'childName' => [ 'Create Dosen', 'Create Mahasiswa' ],
])
@endcan

@can('management users')
<li class="dropdown{{ request()->routeIs(['dosens.index','mahasiswa.index']) ? ' active' : '' }}">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>
            Users</span></a>
    <ul class="dropdown-menu">
        <li {{ request()->routeIs('dosens.index') ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('dosens.index') }}">Dosen</a></li>
        <li {{ request()->routeIs('mahasiswa.index') ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
    </ul>
</li>
@endcan

@endauth