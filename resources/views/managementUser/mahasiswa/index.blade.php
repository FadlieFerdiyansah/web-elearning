<x-app-layouts>
    @push('styles')
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h4>{{ Str::plural('mahasiswa', $mahasiswas) }}</h4> --}}
                    <h4>Total {{ Str::plural('mahasiswa', $mahasiswas) }} {{ $mahasiswas }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="mahasiswa-table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Fakultas</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($mahasiswas as $mhs)
                                <tr>
                                    <td><img src="{{ $mhs->pictureDefault }}" alt="foto"
                                            style="width:75px; border-radius: 50px; margin-bottom:10px;"></td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->fakultas->nama }}</td>
                                    <td>{{ $mhs->kelas->kd_kelas }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                        <div>
                            {{-- {{ $mahasiswas }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('dataTables')
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        <script>
            $(function() {
                $('#mahasiswa-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('mahasiswa') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'foto',
                            "render": function (data, type, full, meta) {
                                if(data == 'default.png'){
                                    return "<img src=\"/assets/images/"+ data + "\" height=\"50\"/>";
                                }else{
                                    return "Nothing Picture";
                                }
                            }
                        },
                        { data: 'nim', name: 'nim'},
                        { data: 'nama' ,orderable: false, searchable: false},
                        { data: 'fakultas.nama' },
                        { data: 'kelas.kd_kelas' },
                        { data: 'created_at' },
                        { data: 'action'}
                    ]
                });
            });
        </script>
    @endpush
</x-app-layouts>