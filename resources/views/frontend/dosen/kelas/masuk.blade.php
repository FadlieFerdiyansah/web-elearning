<x-app-layouts>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
    @endpush
    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                <h4>Popular Browser</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-4 mb-lg-0 text-center">
                        {{-- <a href="{{ route('materi', [$jadwal->kelas_id,$jadwal->matkul_id]) }}"> --}}
                        <a href="{{ route('kelas.materi', Crypt::encryptString($jadwal->id)) }}">
                            <i data-feather="book-open"></i>
                            <div class="mt-2 font-weight-bold">Materi</div>
                            <div class="text-small text-muted"><span class="text-primary"><i
                                        class="fas fa-caret-up"></i></span> 38%</div>
                        </a>
                    </div>
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="file"></i>
                        <div class="mt-2 font-weight-bold">Tugas</div>
                        <div class="text-small text-muted"><span class="text-primary"><i
                                    class="fas fa-caret-up"></i></span> 22%</div>
                    </div>
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="message-square"></i>
                        <div class="mt-2 font-weight-bold">Diskusi</div>
                        <div class="text-small text-muted"><span class="text-danger"><i
                                    class="fas fa-caret-down"></i></span> 27%</div>
                    </div>

                    <div class="col mb-4 mb-lg-0 text-center">
                        <a href="{{ route('absensi.create', Crypt::encryptString($jadwal->id)) }}">
                            <i data-feather="clipboard"></i>
                            <div class="mt-2 font-weight-bold">Absensi</div>
                            <div class="text-small text-muted"><span class="text-primary"><i
                                        class="fas fa-caret-up"></i></span> 38%</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h4>Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        </div>
                        @endif
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
                                                <input type="radio" name="status[]{{ $i }}" value="1" {{ $mhs->userAbsen ? 'checked' : '' }}>
                                                <div class="state p-primary-o">
                                                    <label>Hadir</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-default p-round p-thick">
                                                <input type="radio" name="status[]{{ $i }}" value="0" {{ !$mhs->userAbsen ? 'checked' : '' }}>
                                                <div class="state p-danger-o">
                                                    <label>Tidak Hadir</label>
                                                </div>
                                            </div>
                                        </td>

                                        @once
                                        @if ($absen)
                                        <button type="submit" class="btn btn-primary btn-sm mb-3"><i
                                                class="fas fa-save"></i> Simpan Absen</button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-warning mb-3">Silahkan create absen
                                            terlebih dahulu</button>
                                        @endif
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