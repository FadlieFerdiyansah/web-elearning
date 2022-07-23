<x-app-layouts title="Tabel Kelas">
<x-search action="{{ route('kelas.index') }}"/>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Table Kelas</h4>
            <a href="{{ route('kelas.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah
                Kelas</a>
        </div>
        <div class="card-body">
            <x-alert />
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
                                <form action="{{ route('kelas.destroy', $kls) }}" method="post"
                                    style="float:left;margin-right:5px;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-icon icon-left btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini ?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                <a href="{{ route('kelas.edit', $kls) }}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>

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
</x-app-layouts>
