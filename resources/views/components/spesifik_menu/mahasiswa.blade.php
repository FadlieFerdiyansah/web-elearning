{{-- @canany(['jadwal kuliahd','jadwal kuliahm']) --}}
@auth('mahasiswa')
@include('components._partials.menu',[
    'icon' => 'calendar',
    'parentName' => 'Jadwal for Mahasiswa',
    'nameRoute' => ['jadwalKuliah','jadwalPengganti'],
    'countChild' => 2,
    'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
    ])
@endauth
{{-- @endcanany --}}