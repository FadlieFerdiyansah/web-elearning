<x-app-layouts>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
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
            <form action="{{ route('dosens.update',$dosen) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <img src="{{ $dosen->foto == 'default.png' ? $dosen->pictureDefault : $dosen->picture  }}"
                        alt="foto" style="width:100px;" class="mb-3 rounded">
                    <input type="file" name="foto" class="form-control" id="foto">
                </div>
                <x-input type="text" attr="nip" label="NIP" value="{{ $dosen->nip }}" />
                <x-input type="text" attr="nama" label="Nama" value="{{ $dosen->nama }}" />
                <x-input type="text" attr="email" label="Email" value="{{ $dosen->email }}" />
                <x-select2 :isSelected="$dosen->matkuls" label="Mengajar Matakuliah" attr="matkul" :dataArray="$matkuls"
                    valueOption="id" labelOption="nm_matkul" />
                <x-select2 :isSelected="$dosen->kelas" label="Mengajar Kelas" attr="kelas" :dataArray="$kelas"
                    valueOption="id" labelOption="kd_kelas" />
                <x-button>Update</x-button>
            </form>
        </div>
    </div>
    @push('dataTables')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
</x-app-layouts>