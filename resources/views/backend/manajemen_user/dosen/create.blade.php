<x-app-layouts title="Tambah Dosen">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
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
                <x-select2 label="Mengajar Matakuliah" attr="matkul" :dataArray="$matkuls" valueOption="id" labelOption="nm_matkul" />
                <x-select2 label="Mengajar Kelas" attr="kelas" :dataArray="$kelas" valueOption="id" labelOption="kd_kelas" />
                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('lastScript')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
</x-app-layouts>