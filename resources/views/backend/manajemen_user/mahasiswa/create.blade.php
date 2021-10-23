<x-app-layouts title="Tambah Mahasiswa">
    @push('styles')
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Create</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </div>
            @endif
            <form action="{{ route('mahasiswa.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="foto">Foto</label>
                    {{-- <img
                        src="{{ $mahasiswa->foto == 'default.png' ? $mahasiswa->pictureDefault : $mahasiswa->picture  }}"
                        alt="foto" style="width:100px;" class="mb-3 rounded"> --}}
                    <input type="file" class="form-control" name="foto" id="foto">
                </div>
                <x-input type="text" attr="nim" label="NIM" />
                <x-input type="text" attr="nama" label="Nama" />
                <x-input type="text" attr="email" label="Email" />
                <x-input type="password" attr="password" label="Password" />
                <x-select label="Fakultas" attr="fakultas" :dataArray="$fakultas" valueOption="id" labelOption="nama" />
                <x-select label="Kelas" attr="kelas" :dataArray="$kelas" valueOption="id" labelOption="kd_kelas" />

                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>