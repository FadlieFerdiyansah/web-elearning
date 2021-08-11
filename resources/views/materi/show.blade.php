<x-app-layouts>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h4>Total {{ Str::plural('materi', $materis) }} {{ $materis }}</h4> --}}
                    {{-- {{ dd($matkul) }} --}}
                    {{ Str::title('ini adalah setiap awal huruf besar') }}
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover" id="table-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>KODE MATKUL</th>
                                    <th>KELAS</th>
                                    <th>JUDUL</th>
                                    <th>DESKRIPSI</th>
                                    <th>Link/File</th>
                                    <th>Dibuat pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($materis as $i => $materi)
                                <tr>
                                    <td>{{ $materis->firstItem() + $i }}</td>
                                    <td>{{ $materi->matkul->kd_matkul }}</td>
                                    <td>{{ $materi->kelas->kd_kelas }}</td>
                                    <td>{{ $materi->judul }}</td>
                                    <td>{{ $materi->deskripsi }}</td>
                                    @if ($materi->tipe == 'youtube')
                                        <td><a href="{{ $materi->file_or_link }}">Klik disini</a></td>
                                    @else
                                        <td><button class="btn btn-sm btn-dark" type="submit">download</button></td>
                                    @endif
                                    <td>{{ $materi->created_at }}</td>
                                </tr>
                                @empty
                                <td colspan="7" class="text-center">Materi tidak ditemukan!</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>