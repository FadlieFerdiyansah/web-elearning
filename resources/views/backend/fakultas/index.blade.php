<x-app-layouts title="Tabel Fakultas">
    <x-search action="{{ route('fakultas.index') }}" />
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Table Kelas</h4>
            <a href="{{ route('fakultas.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah
                Fakultas</a>
        </div>
        <div class="card-body">
            <x-alert />
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
                                <form action="{{ route('fakultas.destroy', $fk) }}" method="post"
                                    style="float:left;margin-right:5px;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-icon icon-left btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus fakultas ini ?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                <a href="{{ route('fakultas.edit', $fk) }}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
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
</x-app-layouts>
