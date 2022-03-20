<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <h5 class="text-uppercase">Buat absen untuk kelas <b>{{ $jadwal->kelas->kd_kelas }}</b></h5>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('absensi.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{ encrypt($jadwal->id) }}" name="jadwal">
                <input type="hidden" name="kelas" value="{{ $jadwal->kelas->id }}">
                <x-input attr="matkul" label="Matakuliah" readonly value="{{ $jadwal->matkul->nm_matkul }}" />
                <div class="form-group">
                    <label for="pertemuan">Pertemuan</label>
                    <input autofocus type="text" name="pertemuan"
                        class="form-control @error('pertemuan')is-invalid @enderror" id="pertemuan"
                        value="{{ $absen->pertemuan ?? '' }}">
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