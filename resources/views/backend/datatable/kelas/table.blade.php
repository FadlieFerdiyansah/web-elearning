<x-app-layouts title="Tabel Kelas">
    @push('styles')
    @endpush
        <div class="card">
            <div class="card-header">
                    <div class="row" style="width:100%;">
                        <div class="col-md-5">
                            <h4>Table Kelas</h4>
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
                                    <form action="{{ route('kelas.destroy',$kls) }}" method="post" style="float:left;margin-right:5px;">
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