
@can('jadwal mengajar')    
@include('components.spesifik_menu.partials.menu',[
'icon' => 'calendar',
'parentName' => 'Jadwal',
'childName' => ['Jadwal Kuliah'],
'nameRoute' => ['jadwals.mengajar'],
'countChild' => 1,
// 'nameRoute' => ['jadwals.mengajar','jadwals.mengajar_pengganti'],
// 'countChild' => 2,
// 'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
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
@include('components.spesifik_menu.partials.menu',[
'icon' => 'bar-chart-2',
'parentName' => 'Laporan',
'childName' => ['Nilai', 'Absensi'],
'nameRoute' => ['laporan.nilai', 'laporan.absensi'],
'countChild' => 2,
])
@endcan