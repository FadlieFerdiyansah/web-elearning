<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <h4>Semua mahasiswa kelas : {{ $kelas->kd_kelas }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas->mahasiswas as $mhs)
                            <tr>
                                <td>{{ 1 }}</td>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->kelas->kd_kelas }}</td>
                                <td>{{ $mhs->absens()->whereDate('created_at', '2021-09-19')->first() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layouts>