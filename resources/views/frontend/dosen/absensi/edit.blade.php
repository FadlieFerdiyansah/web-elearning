<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Absensi</h4>
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

            <form action="{{ route('absensi.update', Crypt::encryptString($absensi->id)) }}" method="post">
                @csrf
                @method('patch')
                {{-- <input type="hidden" value="{{ Crypt::encryptString($jadwal->id) }}" name="jadwal"> --}}
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input disabled value="{{ $absensi->jadwal->kelas->kd_kelas }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="matkul">Matakuliah</label>
                        <input disabled value="{{ $absensi->jadwal->matkul->nm_matkul }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pertemuan">Pertemuan</label>
                    <input type="text" name="pertemuan" class="form-control @error('pertemuan')is-invalid @enderror"
                        id="pertemuan" value="{{ $absensi->pertemuan }}" readonly>
                    @error('pertemuan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rangkuman">Rangkuman</label>
                    <textarea name="rangkuman" id="rangkuman" class="form-control"></textarea>
                    <code>
                        Note: Boleh di isi diakhir pelajaran
                    </code>
                </div>

                <div class="form-group">
                    <label for="berita_acara">Berita Acara</label>
                    <textarea name="berita_acara" id="berita_acara" class="form-control"></textarea>
                    <code>
                        Note: Boleh di isi diakhir pelajaran
                    </code>
                </div>


                <div class="form-group">
                    <x-button>Update</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layouts>