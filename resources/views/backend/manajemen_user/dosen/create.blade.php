<x-app-layouts title="Tambah Dosen">
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
            background-color: #6777ef;
            color: #fff;
        }
    </style>
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Create Dosen</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('dosens.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-input type="file" attr="foto" label="Foto Profile" />
                <x-input type="text" attr="nip" label="NIP" />
                <x-input type="text" attr="nama" label="Nama Lengkap" />
                <x-input type="email" attr="email" label="Email" />
                <x-input type="password" attr="password" label="Password" />
                <div class="form-group">
                    <label for="matkul">Mengajar Matakuliah</label>
                    <select name="matkul[]" id="matkul" class="form-control select2" multiple="">
                        @foreach ($matkuls as $matkul)
                        <option value="{{ $matkul->id }}">{{ $matkul->nm_matkul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">Mengajar Kelas</label>
                    <select name="kelas[]" id="kelas" class="form-control select2" multiple="">
                        @foreach ($kelas as $kls)
                        <option value="{{ $kls->id }}">{{ $kls->kd_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('dataTables')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
</x-app-layouts>