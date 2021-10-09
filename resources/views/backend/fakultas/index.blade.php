<x-app-layouts title="Tabel Fakultas">
    @push('styles')
    @endpush
    <div class="d-flex justify-content-end mb-4">
        <form class="form-inline" action="{{ route('search') }}" method="GET ">
            <input class="form-control mr-4 col-md" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-icon icon-left btn-primary"><i class="fas fa-search"></i> Cari</button>
        </form>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
                <h4>Table Kelas</h4>
            <a href="{{ route('fakultas.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah
                Fakultas</a>
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
                        <th>Kode</th>
                        <th>Fakultas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fakultas as $index => $fk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $fk->kd_fk }}</td>
                        <td>{{ $fk->nama }}</td>
                        <td>
                            <form action="{{ route('fakultas.destroy',$fk) }}" method="post"
                                style="float:left;margin-right:5px;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('fakultas.edit',$fk) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-secondary">Tidak ada Fakultas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>