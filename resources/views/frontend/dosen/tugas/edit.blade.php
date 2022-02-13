<x-app-layouts title="Buat tugas">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Edit Tugas</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <x-alert />
            <form action="{{ route('tugas.edit', $tugas) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                {{-- <input type="hidden" name="jadwal" value="{{ Crypt::encrypt($jadwal->id) }}" /> --}}
                <x-input type="text" attr="judul" label="Judul" value="{{ $tugas->judul }}"/>
                <x-input type="text" attr="pertemuan" label="Pertemuan" value="{{ $tugas->pertemuan }}"
                    readonly />
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select class="form-control selectric @error('tipe') is-invalid @enderror" name="tipe" id="tipe">
                        <option disabled selected>Pilih Tipe</option>
                        <option value="file" {{ $tugas->tipe == 'file' ? 'selected' : '' }}>File</option>
                        <option value="link" {{ $tugas->tipe == 'link' ? 'selected' : '' }}>Link</option>
                    </select>
                    @error('tipe')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group" id="formLink">
                    <x-input type="text" label="Link" attr="file_or_link" id="link"  value="{{ $tugas->tipe == 'link' ? $tugas->file_or_link : '' }}" />
                </div>
                <div class="form-group" id="formFile">
                    <x-input type="file" label="File" attr="file_or_link" id="file" />
                </div>
                <x-input type="text" attr="pengumpulan" label="Pengumpulan" value="{{ $tugas->pengumpulan }}" />
                <x-textarea attr="deskripsi" label="Deskripsi">{{ $tugas->deskripsi }}</x-textarea>

                <div class="d-flex">
                    <div class="mx-2">
                        <x-button>Submit</x-button>
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