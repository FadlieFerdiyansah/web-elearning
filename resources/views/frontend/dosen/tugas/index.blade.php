<x-app-layouts>
    <div class="card">
        <div class="card-header">
            @if ($newtsPertemuan)
            <a href="{{ route('tugas.create', encrypt($jadwal->id)) }}" class="btn btn-dark btn-sm"><i
                    class="fas fa-plus"></i> Buat Tugas</a>
            @else
            <a href="{{ route('absensi.create', encrypt($jadwal->id)) }}" class="btn btn-primary btn-sm"><i
                    class="fas fa-plus"></i> Buat absen terlebih dahulu</a>
            @endif
        </div>
        <div class="card-body">
            <x-alert />
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Pertemuan</th>
                        <th>Deskripsi</th>
                        <th>Pengumpulan</th>
                        <th>Diupload pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $i => $tgs)
                    <tr>
                        <td>{{ $tugas->firstItem() + $i }}</td>
                        <td>{{ $tgs->judul }}</td>
                        <td>
                            <div class="badge badge-dark">{{ $tgs->pertemuan }}</div>
                        </td>
                        <td>{{ $tgs->deskripsi }}</td>
                        <td>{{ date('d F Y ~ H:s', strtotime($tgs->pengumpulan)) }}</td>
                        <td>{{ date('d F Y ~ H:s', strtotime($tgs->created_at)) }}</td>
                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="{{ route('tugas.edit', $tgs) }}"><i class="fas fa-edit"></i>
                                        Edit</a>
                                    <form action="{{ route('tugas.destroy', $tgs) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" style="font-size:13px" class="dropdown-item has-icon font-sm"><i
                                                class="fas fa-trash"></i>
                                            Hapus</button>

                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layouts>