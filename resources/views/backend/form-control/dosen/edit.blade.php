<x-app-layouts>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
    <style>
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #e4e6fc;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e4e6fc;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove,
        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-results__option[aria-selected="true"],
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rebeccapurple;
            color: #fff;
        }
    </style>
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Update Dosen</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
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

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </div>
            @endif
            <form action="{{ route('dosen.edit',$dosen) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="foto">Foto Profile</label>
                    <input type="file" name="foto" class="form-control" id="foto">
                </div>
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control" id="nip" value="{{ $dosen->nip }}" disabled>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ $dosen->nama }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $dosen->email }}">
                </div>
                <div class="form-group">
                    <label for="matkul">Mengajar Matakuliah</label>
                    <select name="matkul[]" id="matkul" class="form-control select2" multiple="">
                        @foreach ($matkuls as $matkul)
                            <option {{ $dosen->matkuls->find($matkul->id) ? 'selected' : '' }} value="{{ $matkul->id }}">{{ $matkul->nm_matkul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">Mengajar Kelas</label>
                    <select name="kelas[]" id="kelas" class="form-control select2" multiple="">
                        @foreach ($kelas as $kls)
                        <option {{ $dosen->kelas()->find($kls->id) ? 'selected' : '' }} value="{{ $kls->id }}">{{ $kls->kd_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach ($kelas as $kls)
                                <option {{ $mahasiswa->kelas_id == $kls->id ? 'selected' : null }}
                value="{{ $kls->id }}">{{ $kls->kd_kelas }}</option>
                @endforeach
                </select>
        </div> --}}

        <x-button.button>Update</x-button.button>
        </form>
    </div>
    </div>
    @push('dataTables')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
</x-app-layouts>