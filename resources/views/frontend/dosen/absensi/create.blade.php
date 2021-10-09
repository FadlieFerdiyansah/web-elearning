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
            <form action="{{ route('absensi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ Crypt::encryptString($jadwal->id) }}" name="jadwal">
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select name="kelas" id="kelas" class="form-control">
                        @foreach ($kelasActive as $active)
                        <option value="{{ $active->kelas->id }}">{{ $active->kelas->kd_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="matkul">Matakuliah</label>
                    <select name="matkul" id="matkul" class="form-control">
                        @foreach ($kelasActive as $active)
                        <option value="{{ $active->matkul->id }}">{{ $active->matkul->nm_matkul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pertemuan">Pertemuan</label>
                    <input type="text" name="pertemuan" class="form-control" id="pertemuan">
                </div>
                {{-- <div class="form-group">
                    <label for="rangkuman">Rangkuman</label>
                    <textarea name="rangkuman" id="rangkuman" class="form-control"></textarea>
                    <code>
                        Note: Dapat di isi ketika sudah diakhir waktu
                    </code>
                </div>
                <div class="form-group">
                    <label for="berita_acara">Berita Acara</label>
                    <textarea name="berita_acara" id="berita_acara" class="form-control"></textarea>
                </div> --}}


                <div class="form-group">
                    <x-button.button>Simpan</x-button.button>
                </div>
            </form>
        </div>
    </div>
</x-app-layouts>