<x-app-layouts title="Tabel Kelas">
    @push('styles')
    @endpush
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Table Kelas</h4>
            <a href="{{ route('kelas.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah
                Kelas</a>
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
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelas as $index => $kls)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kls->kd_kelas }}</td>
                        <td>
                            <form action="{{ route('kelas.destroy',$kls) }}" method="post"
                                style="float:left;margin-right:5px;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('kelas.edit',$kls) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-secondary">Tidak ada Kelas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>