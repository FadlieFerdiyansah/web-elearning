@auth('admin')
<li class="dropdown{{ request()->routeIs('fakultas.table') ? ' active' : '' }}">
    <a href="{{ route('fakultas.table') }}" class="nav-link"><i
            data-feather="briefcase"></i><span>Fakultas</span></a>
</li>
<li class="dropdown{{ request()->routeIs('kelas.table') ? ' active' : '' }}">
    <a href="{{ route('kelas.table') }}" class="nav-link"><i
            data-feather="layers"></i><span>Kelas</span></a>
</li>
<li class="dropdown{{ request()->routeIs('matkuls.table') ? ' active' : '' }}">
    <a href="{{ route('matkuls.table') }}" class="nav-link"><i
            data-feather="book-open"></i><span>Matakuliah</span></a>
</li>

@include('components._partials.menu',[
'icon' => 'calendar',
'parentName' => 'Jadwal',
'nameRoute' => ['jadwals.kuliah','jadwals.pengganti'],
'countChild' => 2,
'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
])

@can('management roles and permissions')
@include('components._partials.menu',[
'icon' => 'shield-off',
'parentName' => 'Roles & Permissions',
'nameRoute' => ['dosen.table','dosen.table'],
'countChild' => 2,
'childName' => [ 'Roles', 'Permissions' ],
])
@endcan

@can('management roles and permissions')
@include('components._partials.menu',[
'icon' => 'user-plus',
'parentName' => 'Create Users',
'nameRoute' => ['dosen.create','mahasiswa.create'],
'countChild' => 2,
'childName' => [ 'Create Dosen', 'Create Mahasiswa' ],
])
@endcan

@can('management users')
<li class="dropdown{{ request()->routeIs(['dosen.table','mahasiswa.table']) ? ' active' : '' }}">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>
            Users</span></a>
    <ul class="dropdown-menu">
        <li {{ request()->routeIs('dosen.table') ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('dosen.table') }}">Dosen</a></li>
        <li {{ request()->routeIs('mahasiswa.table') ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('mahasiswa.table') }}">Mahasiswa</a></li>
    </ul>
</li>
@endcan

{{-- @can('management users')
@include('components._partials.menu',[
'icon' => 'layout',
'parentName' => 'Form Control',
'nameRoute' =>
['matkuls.create','kelas.create','fakultas.create','mahasiswa.create','dosen.create'],
'countChild' => 5,
'childName' => [ 'Buat Matakuliah', 'Buat Kelas', 'Buat Fakultas', 'Buat Mahasiswa', 'Buat
Dosen', ],
])
@endcan --}}

{{-- @can('management datatable')
@include('components._partials.menu',[
'icon' => 'layout',
'parentName' => 'Data Table',
'nameRoute' => ['matkuls.table','kelas.table','fakultas.table'],
'countChild' => 3,
'childName' => [ 'Matakuliah', 'Kelas', 'Fakultas'],
])
@endcan --}}







@endauth