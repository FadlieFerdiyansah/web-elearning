<x-app-layouts>
    <div class="card">
        <div class="card-header"><h3>Materi &raquo; {{ $materis[0]->matkul->nm_matkul ?? '?' }}</h3></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kelas</th>
                            {{-- <th>Dosen</th> --}}
                            <th>Kode Matkul</th>
                            <th>Pertemuan</th>
                            <th>Judul</th>
                            <th>Tipe</th>
                            <th>File/Link</th>
                            <th>Deskripsi</th>
                            <th>Dibuat pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materis as $i => $materi)
                        <tr>
                            <th scope="row">{{ $materis->firstItem() + $i }}</th>
                            <td>{{ $materi->kelas->kd_kelas }}</td>
                            {{-- <td>{{ $materi->dosen->nama }}</td> --}}
                            <td>{{ $materi->matkul->kd_matkul }}</td>
                            <td>{{ $materi->pertemuan }}</td>
                            <td>{{ $materi->judul }}</td>
                            <td>{{ $materi->tipe }}</td>
                            <td>
                                @if ($materi->tipe == 'youtube')
                                    <a class="btn btn-dark btn-sm" href="{{ $materi->file_or_link }}" target="_blank">Klik me</a>
                                @else
                                    <div class="btn btn-sm btn-dark">Download</div>
                                @endif
                            </td>
                            <td>{{ $materi->deskripsi }}</td>
                            <td>{{ $materi->created_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-secondary">Tidak ada materi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layouts>