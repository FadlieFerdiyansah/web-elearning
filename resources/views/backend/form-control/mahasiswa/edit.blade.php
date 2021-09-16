<x-app-layouts>
    @push('styles')
    @endpush
        <div class="card">
            <div class="card-header">
                <h4>Edit &raquo; {{ $mahasiswa->nama }}</h4>
            </div>
            <div class="card-body col-md-8 col-sm">
                <form action="{{ route('mahasiswa.edit',$mahasiswa) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <img src="{{ $mahasiswa->foto == 'default.png' ? $mahasiswa->pictureDefault : $mahasiswa->picture  }}" alt="foto" style="width:100px;" class="mb-3 rounded">
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" value="{{ $mahasiswa->nim }}" class="form-control" name="nim" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" value="{{ $mahasiswa->nama }}" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="{{ $mahasiswa->email }}" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="fakultas">Fakultas</label>
                        <select name="fakultas" id="fakultas" class="form-control">
                            @foreach ($fakultas as $fk)
                                <option {{ $mahasiswa->fakultas_id == $fk->id ? 'selected' : null }} value="{{ $fk->id }}">{{ $fk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach ($kelas as $kls)
                                <option {{ $mahasiswa->kelas_id == $kls->id ? 'selected' : null }} value="{{ $kls->id }}">{{ $kls->kd_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @push('scrips')
    @endpush
</x-app-layouts>