{{-- @canany(['jadwal kuliahd','jadwal kuliahm']) --}}
@auth('mahasiswa')
@include('components.spesifik_menu.partials.menu',[
    'icon' => 'calendar',
    'parentName' => 'Jadwal for Mahasiswa',
    'nameRoute' => ['jadwalKuliah','jadwalPengganti'],
    'countChild' => 2,
    'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
    ])
@endauth
{{-- @endcanany --}}