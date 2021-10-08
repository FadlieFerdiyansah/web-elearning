<x-app-layouts>

    <div class="row">
        @foreach ($jadwals as $jadwal)
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $jadwal->hari }}</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>{{ $jadwal->matkul->nm_matkul }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layouts>