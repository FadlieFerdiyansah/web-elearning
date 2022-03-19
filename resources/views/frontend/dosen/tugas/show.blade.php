<x-app-layouts>
    <x-alert />

    <div class="card">
        <div class="card-header">
            <h4 class="text-uppercase text-muted">Tugas yang dibuat dosen</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pertemuan</th>
                        <th>Deskripsi</th>
                        <th>Pengumpulan</th>
                        <th>Diupload pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $tugas->judul }}</td>
                        <td>
                            <div class="badge badge-dark">{{ $tugas->pertemuan }}</div>
                        </td>
                        <td>{{ $tugas->deskripsi }}</td>
                        <td>{{ date('d F Y ~ H:s', strtotime($tugas->pengumpulan)) }}</td>
                        <td>{{ date('d F Y ~ H:s', strtotime($tugas->created_at)) }}</td>
                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="{{ route('tugas.edit', $tugas) }}"><i class="fas fa-edit"></i>
                                        Edit</a>
                                    <form action="{{ route('tugas.destroy', $tugas) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" style="font-size:13px" class="dropdown-item has-icon font-sm"><i
                                                class="fas fa-trash"></i>
                                            Hapus</button>

                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="text-uppercase text-muted">Tugas yang dikumpulkan Mahasiswa</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Komentar dosen</th>
                        <th>Dikumpulkan pada</th>
                        <th>Diubah pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugasMahasiswa as $tgsMhs)
                    <tr>
                        <td>{{ $tgsMhs->mahasiswa->nim }}</td>
                        <td>{{ $tgsMhs->mahasiswa->nama }}</td>
                        <td><h5>{{ $tgsMhs->nilai->nilai ?? '' }}</h5></td>
                        <td>{{ $tgsMhs->nilai->komentar_dosen ?? '' }}</td>
                        <td>{{ date('d F Y ~ H:i', strtotime($tgsMhs->created_at)) }}</td>
                        <td>{{ date('d F Y ~ H:i', strtotime($tgsMhs->updated_at)) }}</td>
                        <td>
                            <a href="{{ route('nilai.create', $tgsMhs) }}" class="btn btn-primary btn-sm"><i class="fas fa-balance-scale"></i> Tanggapi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layouts>