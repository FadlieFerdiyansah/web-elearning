<x-app-layouts>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
    @endpush
    <div class="row justify-content-center">
        <div class="card col-sm-12 col-lg-5">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-4 mb-lg-0 text-center">
                        <a href="{{ route('kelas.materi',encrypt($jadwal->id)) }}">
                            <i data-feather="book-open" style="width: 80px; height: 60px; color: #6c757d"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">Materi</div>
                        </a>
                    </div>
                    <a href="{{ route('tugas', encrypt($jadwal->id)) }}" class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="file" style="width: 80px; height: 60px; color: #6c757d"></i>
                        <div class="mt-2 font-weight-bold" style="color: #6c757d;">Tugas</div>
                    </a>
                    <div class="col mb-4 mb-lg-0 text-center">
                        <a href="{{ route('absensi.create', encrypt($jadwal->id)) }}">
                            <i data-feather="clipboard" style="width: 80px; height: 60px; color: #6c757d;"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">Absensi</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-sm-12 col-lg-6 mx-1">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="users" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Total Mahasiswa</div>
                        <h6 class="badge badge-dark">{{ $mahasiswa->count() }}</h6>
                    </div>
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-check" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Hadir</div>
                        <h6 class="badge badge-info">{{ $mahasiswaHadir }}</h6>
                    </div>
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-x" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Tidak Hadir</div>
                        <h6 class="badge badge-danger">{{ $mahasiswaTidakHadir }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="table-responsive">
                        <x-alert />
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mahasiswa</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('kelas.store_absen') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $jadwal->id }}" name='jadwal'>
                                    <input type="hidden" value="{{ $absen->id ?? '' }}" name='parent'>
                                    <input type="hidden" name="pertemuan" value="{{ $absen->pertemuan ?? '' }}">

                                    @foreach ($mahasiswa as $i => $mhs)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <li class="media">
                                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                                    src="{{ $mhs->foto == 'default.png' ?  $mhs->pictureDefault : $mhs->picture }}">
                                                <div class="media-body">
                                                    <div class="media-title">{{ $mhs->nama }}</div>
                                                    <div class="text-job text-muted">{{ $mhs->nim }}</div>
                                                </div>
                                            </li>
                                        </td>

                                        <td>
                                            <input type="hidden" value="{{ $mhs->id }}" name="mahasiswa[]">
                                            <div class="pretty p-default p-round p-thick">
                                                <input type="radio" name="status[]{{ $i }}" value="1" {{
                                                    $mhs->mahasiswaAbsenHariIni ? 'checked' : '' }}>
                                                <div class="state p-primary-o">
                                                    <label>Hadir</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-default p-round p-thick">
                                                <input type="radio" name="status[]{{ $i }}" value="0" {{
                                                    !$mhs->mahasiswaAbsenHariIni ? 'checked' : '' }}>
                                                <div class="state p-danger-o">
                                                    <label>Tidak Hadir</label>
                                                </div>
                                            </div>
                                        </td>

                                        @once
                                        {{-- @if ($absen) --}}
                                        <button type="submit" class="btn btn-primary btn-sm mb-3"><i
                                                class="fas fa-save"></i> Simpan Absen</button>
                                                <code class="ml-3">Note : Klik Simpan Absen jika ada perubahan Absensi dibawah</code>
                                        {{-- @else
                                        <button type="button" class="btn btn-sm btn-warning mb-3">Silahkan create absen
                                            terlebih dahulu</button> --}}
                                        {{-- @endif --}}
                                        @endonce

                                    </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>