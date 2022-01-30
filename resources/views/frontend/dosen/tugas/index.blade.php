<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('tugas.create', encrypt($jadwal->id)) }}" class="btn btn-success btn-sm"><i
                    class="fas fa-plus"></i> Buat Tugas</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {!! session('success') !!}
                </div>
            </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Pertemuan</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th>Diupload pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $i => $tgs)
                        <tr>
                            <td>{{ $tugas->firstItem() + $i }}</td>
                            <td>{{ $tgs->judul }}</td>
                            <td>{{ $tgs->pertemuan }}</td>
                            <td>{{ $tgs->deskripsi }}</td>
                            <td>{{ $tgs->pengumpulan }}</td>
                            <td>{{ $tgs->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layouts>