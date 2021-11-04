<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <h4>Form Buat Absensi</h4>
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

            <form action="{{ route('absensi.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{ encrypt($jadwal->id) }}" name="jadwal">
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input disabled value="{{ $jadwal->kelas->kd_kelas }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="matkul">Matakuliah</label>
                        <input disabled value="{{ $jadwal->matkul->nm_matkul }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pertemuan">Pertemuan</label>
                    <input autofocus type="text" name="pertemuan"
                        class="form-control @error('pertemuan')is-invalid @enderror" id="pertemuan">
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
                    <x-button>Simpan</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layouts>