@canany(['jadwal kuliahd','jadwal kuliahm'])
@include('components._partials.menu',[,
'icon' => 'book-open',
'parentName' => 'Jadwal for Dosen',
'nameRoute' => ['jadwalKuliah','jadwalPengganti'],
'countChild' => 2,
'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
])
@endcanany

@can('management nilai')
<li class="dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Management
            Nilai</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="icon-material.html">Dosen</a></li>
        <li><a class="nav-link" href="icon-font-awesome.html">Mahasiswa</a></li>
    </ul>
</li>
@endcan

@can('management materi')
@include('components._partials.menu',[
'icon' => 'book-open',
'parentName' => 'Management Materi',
'nameRoute' => ['materi.upload','materi.table'],
'countChild' => 2,
'childName' => ['Upload Materi','Tabel Materi'],
])
@endcan

@can('management absensi')
@include('components._partials.menu',[
'icon' => 'book-open',
'parentName' => 'Management Absensi',
'nameRoute' => ['absensi.table','absensi.kelas'],
'countChild' => 2,
'childName' => ['Absen','Kelas'],
])
@endcan