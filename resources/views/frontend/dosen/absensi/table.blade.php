<x-app-layouts>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Absen hari ini</h4>

            <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Buat Absen</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Matakuliah</th>
                            <th>Berita Acara</th>
                            <th>Rangkuman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensiHariIni as $absen)
                        <tr>
                            <td>{{ $absen->kelas }}</td>
                            <td>{{ $absen->matkul }}</td>
                            <td>{{ $absen->berita_acara }}</td>
                            <td>{{ $absen->rangkuman }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-md">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layouts>