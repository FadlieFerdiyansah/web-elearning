@can('jadwal kuliah')
    @include('components.spesifik_menu.partials.menu',[
        'icon' => 'calendar',
        'parentName' => 'Jadwal',
        // 'nameRoute' => ['jadwalKuliah','jadwalPengganti'],
        'nameRoute' => ['jadwalKuliah'],
        'countChild' => 1,
        // 'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
        'childName' => ['Jadwal Kuliah'],
        ])
@endcan