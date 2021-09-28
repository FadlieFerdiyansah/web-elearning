
@can('jadwal mengajar')    
@include('components._partials.menu',[
'icon' => 'calendar',
'parentName' => 'Jadwal',
'nameRoute' => ['jadwalMengajar','jadwalMengajarPengganti'],
'countChild' => 2,
'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
])
@endcan

@can('management materi')
@include('components._partials.menu',[
'icon' => 'book-open',
'parentName' => 'Materi',
'nameRoute' => ['materi.upload','materi.table'],
'countChild' => 2,
'childName' => ['Upload Materi','Tabel Materi'],
])
@endcan

@can('management absensi')
@include('components._partials.menu',[
'icon' => 'clipboard',
'parentName' => 'Absensi',
'nameRoute' => ['absensi.table','absensi.kelas'],
'countChild' => 2,
'childName' => ['Absen','Kelas'],
])
@endcan

@can('management nilai')
<li class="dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="edit"></i><span>Nilai</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="icon-material.html">Dosen</a></li>
        <li><a class="nav-link" href="icon-font-awesome.html">Mahasiswa</a></li>
    </ul>
</li>
@endcan