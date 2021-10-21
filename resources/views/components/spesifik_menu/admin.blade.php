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
'nameRoute' => ['jadwals.index','jadwals.pengganti'],
'countChild' => 2,
'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
])

@can('management roles and permissions')
@include('components.spesifik_menu.partials.menu',[
'icon' => 'shield-off',
'parentName' => 'Roles & Permissions',
'nameRoute' => ['dosens.index','dosens.index'],
'countChild' => 2,
'childName' => [ 'Roles', 'Permissions' ],
])
@endcan

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
<li class="dropdown{{ request()->routeIs(['dosens.index','mahasiswa.table']) ? ' active' : '' }}">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>
            Users</span></a>
    <ul class="dropdown-menu">
        <li {{ request()->routeIs('dosens.index') ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('dosens.index') }}">Dosen</a></li>
        <li {{ request()->routeIs('mahasiswa.table') ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('mahasiswa.table') }}">Mahasiswa</a></li>
    </ul>
</li>
@endcan

{{-- @can('management users')
@include('components.spesifik_menu.partials.menu',[
'icon' => 'layout',
'parentName' => 'Form Control',
'nameRoute' =>
['matkuls.create','kelas.create','fakultas.create','mahasiswa.create','dosens.create'],
'countChild' => 5,
'childName' => [ 'Buat Matakuliah', 'Buat Kelas', 'Buat Fakultas', 'Buat Mahasiswa', 'Buat
Dosen', ],
])
@endcan --}}

{{-- @can('management datatable')
@include('components.spesifik_menu.partials.menu',[
'icon' => 'layout',
'parentName' => 'Data Table',
'nameRoute' => ['matkuls.index','kelas.index','fakultas.table'],
'countChild' => 3,
'childName' => [ 'Matakuliah', 'Kelas', 'Fakultas'],
])
@endcan --}}







@endauth