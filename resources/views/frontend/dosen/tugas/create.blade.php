<x-app-layouts title="Buat tugas">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Buat Tugas</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <x-alert/>

            <form action="{{ route('tugas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jadwal" value="{{ Crypt::encrypt($jadwal->id) }}"/>
                <x-input type="text" attr="judul" label="Judul" />
                <x-input type="text" attr="pertemuan" label="Pertemuan" value="{{ $newtsPertemuan->pertemuan }}"
                    readonly />
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select class="form-control selectric @error('tipe') is-invalid @enderror" name="tipe" id="tipe">
                        <option disabled selected>Pilih Tipe</option>
                        <option value="file">File</option>
                        <option value="link">Link</option>
                    </select>
                    @error('tipe')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group" id="formLink">
                    <x-input type="text" label="Link" attr="file_or_link" id="link" />
                </div>
                <div class="form-group" id="formFile">
                    <x-input type="file" label="File" attr="file_or_link" id="file" />
                </div>
                <x-input type="datetime-local" attr="pengumpulan" label="Pengumpulan" />
                <x-textarea attr="deskripsi" label="Deskripsi"></x-textarea>

                <div class="d-flex">
                    <div class="mx-2">
                        <x-button>Submit</x-button>
                    </div>
                    <div>
                        <a href="{{ route('tugas', encrypt($jadwal->id)) }}" class="btn btn-warning text-uppercase">Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    @endpush
    @push('lastScripts')
    <script>
        $(document).ready(function(){
            $('#formLink').hide();
            $('#formFile').hide();
            $("#tipe").change(function() {
                if ($("#tipe option:selected").val() == 'file') {
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