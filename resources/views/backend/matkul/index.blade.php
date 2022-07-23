<x-app-layouts title="Tabel Matakuliah">
    <x-search action="{{ route('matkuls.index') }}" />

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Table Matakuliah</h4>
            <a href="{{ route('matkuls.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah
                Matakuliah</a>
        </div>
        <div class="card-body">
            <x-alert />
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
                                <button type="submit" class="btn btn-icon icon-left btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus matkul ini ?')"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            <a href="{{ route('matkuls.edit',$matkul->id) }}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
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
</x-app-layouts>