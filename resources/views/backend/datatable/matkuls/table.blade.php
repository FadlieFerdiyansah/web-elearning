<x-app-layouts title="Tabel Matakuliah">
    @push('styles')
    @endpush
    <div class="d-flex justify-content-end mb-4">
        <form class="form-inline" action="{{ route('search') }}" method="GET ">
            <input class="form-control mr-4 col-md" type="search" placeholder="Search" aria-label="Search"
                name="query">
            <button class="btn btn-icon icon-left btn-primary"><i class="fas fa-search"></i> Cari</button>
        </form>    
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Table Matakuliah</h4>
            <a href="{{ route('matkuls.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Matakuliah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Matakuliah</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($matkuls as $index => $matkul)
                    <tr>
                        <td>{{ $matkuls->firstItem() + $index }}</td>
                        <td>{{ $matkul->kd_matkul }}</td>
                        <td>{{ $matkul->nm_matkul }}</td>
                        <td>
                            <form action="{{ route('matkuls.destroy',$matkul) }}" method="post"
                                style="float:left;margin-right:5px;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('matkuls.edit',$matkul->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-secondary">Tidak ada Matakuliah</td>
                    </tr>
                    @endforelse
                </table>
            </div>
            <div>
                {{ $matkuls->links() }}
            </div>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>