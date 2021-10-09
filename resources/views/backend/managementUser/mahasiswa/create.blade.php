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
                        {{-- <img src="{{ $mahasiswa->foto == 'default.png' ? $mahasiswa->pictureDefault : $mahasiswa->picture  }}" alt="foto" style="width:100px;" class="mb-3 rounded"> --}}
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" class="form-control" name="nim" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="fakultas">Fakultas</label>
                        <select name="fakultas" id="fakultas" class="form-control">
                            @foreach ($fakultas as $fk)
                                <option value="{{ $fk->id }}">{{ Str::title($fk->nama) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->kd_kelas }}</option>
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