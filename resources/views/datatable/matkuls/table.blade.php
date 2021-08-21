<x-app-layouts title="Tabel Matakuliah">
    @push('styles')
    @endpush
        <div class="card">
            <div class="card-header">
                    <div class="row" style="width:100%;">
                        <div class="col-md-5">
                            <h4>Table Matakuliah</h4>
                        </div>
                        <div class="col-7">
                            <form class="d-flex justify-content-end" action="{{ route('search') }}" method="GET ">
                                <input class="form-control mr-4 col-md-5" type="search" placeholder="Search" aria-label="Search" name="query">
                                <button class="btn btn-outline-info" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="card-body">
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
                                <form action="{{ route('matkuls.destroy',$matkul) }}" method="post" style="float:left;margin-right:5px;">
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
                <div>
                    {{ $matkuls->links() }}
                </div>
            </div>
        </div>
    @push('scrips')
    @endpush
</x-app-layouts>