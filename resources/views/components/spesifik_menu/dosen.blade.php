
@can('jadwal mengajar')    
@include('components.spesifik_menu.partials.menu',[
'icon' => 'calendar',
'parentName' => 'Jadwal',
// 'nameRoute' => ['jadwals.mengajar','jadwals.mengajar_pengganti'],
'nameRoute' => ['jadwals.mengajar'],
'countChild' => 1,
// 'countChild' => 2,
// 'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
'childName' => ['Jadwal Kuliah'],
])
@endcan

{{-- @can('management materi')
@include('components.spesifik_menu.partials.menu',[
'icon' => 'book-open',
'parentName' => 'Materi',
'nameRoute' => ['materis.index','materis.create'],
'countChild' => 2,
'childName' => ['Table Materi','Upload Materi'],
])
@endcan --}}

{{-- @can('management absensi')
@include('components._partials.menu',[
'icon' => 'clipboard',
'parentName' => 'Absensi',
'nameRoute' => ['absensi.kelas','absensi.table'],
'countChild' => 2,
'childName' => ['Kelas','Absen'],
])
@endcan --}}

@can('management nilai')
<li class="dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="edit"></i><span>Nilai</span></a>
    <ul class="dropdown-menu">
        {{-- <li><a class="nav-link" href="icon-material.html">Dosen</a></li> --}}
        <li><a class="nav-link" href="{{ route('nilai.index') }}">Mahasiswa</a></li>
    </ul>
</li>
@endcan