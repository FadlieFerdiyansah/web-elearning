<x-app-layouts title="Form create tugas">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Upload Materi</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            

            <form action="{{ route('tugas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-input type="text" attr="judul" label="Judul" />
                <x-input type="text" attr="pertemuan" label="Pertemuan" />
                    {{-- <input type="text" value="pertemuan" class="form-control"> --}}
                <div class="form-group" id="formFile">
                    <label for="file">File</label>
                    <input type="file" name="file_or_link" class="form-control" id="file">
                </div>
                <x-input type="text" attr="pertemuan" label="Pertemuan" class="form-control datetimepicker" />
                <x-textarea attr="deskripsi" label="Deskripsi"></x-textarea>

                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    @endpush
</x-app-layouts>