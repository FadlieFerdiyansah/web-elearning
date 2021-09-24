<x-app-layouts>
    <div class="card">
        <div class="card-header"><h3>Materi &raquo; {{ $jadwal->matkul->nm_matkul }}</h3> ini buat dosen</div>
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
                            <th>File/Link</th>
                            <th>Deskripsi</th>
                            <th>Diupload pada</th>
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
                            <td>
                                @if ($materi->tipe == 'youtube')
                                    <a href="{{ $materi->file_or_link }}" target="_blank">Klik me</a>
                                @else
                                    <a class="btn btn-dark btn-sm" href="{{ asset("/storage/$materi->file_or_link") }}" download>Download</a>
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
                {{ $materis->links() }}
            </div>
        </div>
    </div>
</x-app-layouts>