<x-app-layouts title="Upload Materi">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
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
            <h4>Form Upload Materi</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <x-alert/>

            <form action="{{ route('materis.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-select attr="kelas_id" label="Kelas" :data="$jadwal" valueOption="kelas_id" relasi="kelas"
                    labelOption="kd_kelas" />
                <x-select attr="matkul_id" label="Matakuliah" :data="$jadwal" valueOption="matkul_id" relasi="matkul"
                    labelOption="nm_matkul" />
                <x-input type="text" attr="judul" label="Judul" />
                <x-input type="text" attr="pertemuan" label="Pertemuan" value="{{ $jadwal->absenParent->pertemuan ?? '' }}" />
                    {{-- <input type="text" value="pertemuan" class="form-control"> --}}
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select class="form-control selectric" name="tipe" id="tipe">
                        <option disabled selected>Pilih Tipe</option>
                        <option value="pdf">PDF</option>
                        <option value="youtube">YouTube</option>
                    </select>
                </div>
                <div class="form-group" id="formLink">
                    <label for="link">Link</label>
                    <input type="text" name="file_or_link" class="form-control" id="link">
                </div>
                <div class="form-group" id="formFile">
                    <label for="file">File</label>
                    <input type="file" name="file_or_link" class="form-control" id="file">
                </div>
                <x-textarea attr="deskripsi" label="Deskripsi"></x-textarea>
                <input type="hidden" name="jadwal" value="{{ encrypt($jadwal->id) }}">
                
                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('lastScripts')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script>
            $(document).ready(function(){
                $('#formLink').hide();
                $('#formFile').hide();
                $("#tipe").change(function() {
                    if ($("#tipe option:selected").val() == 'pdf') {
                            $('#formLink').hide();
                            $('#formFile').show();
                        } else {
                            $('#formFile').hide();
                            $('#formLink').show();
                        }
                    });
                });
    </script>
    @endpush
</x-app-layouts>