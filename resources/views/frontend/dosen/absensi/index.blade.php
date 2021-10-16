<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <h4>Absensi Hari Ini</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kelas</th>
                            <th>Matkul</th>
                            <th>Pertemuan</th>
                            <th>Berita Acara</th>
                            <th>Rangkuman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $i => $absen)
                        <tr>
                    <tbody>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $absen->jadwal->kelas->kd_kelas }}</td>
                        <td>{{ $absen->jadwal->matkul->nm_matkul }}</td>
                        <td>{{ $absen->pertemuan }}</td>
                        <td>{{ $absen->berita_acara }}</td>
                        <td>{{ $absen->rangkuman }}</td>
                        <td>
                            <form action="{{ route('absensi.delete', Crypt::encryptString($absen->id)) }}" method="post" class="float-left mr-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus absensi ? ')">Delete</button>
                            </form>
                            <a href="{{ route('absensi.edit', Crypt::encryptString($absen->id)) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('kelas.masuk', Crypt::encryptString($absen->jadwal_id)) }}" class="btn btn-success btn-sm">Detail</a>
                        </td>
                    </tbody>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layouts>