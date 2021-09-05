<x-app-layouts>
    <div class="row">
        <div class="col-md-3">
            <div class="pricing ">
                <div class="pricing-title">
                    presensi
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h3>{{ $kelas_mhs->jam_masuk .' - '. $kelas_mhs->jam_keluar }}</h3>
                        <div>Jam masuk - Jam keluar {{ $kelas_mhs->kd_kelas }}</div>
                    </div>
                    <div>
                        <table class="table">
                            <thead>
                                <tr align="left">
                                    <th>Dosen</th>
                                    <td>{{ $kelas_mhs->dosen->nama }}</td>
                                </tr>
                                <tr align="left">
                                    <th>Matakuliah</th>
                                    <td>{{ $kelas_mhs->matkul->nm_matkul }}</td>
                                </tr>
                                <tr align="left">
                                    <th>SKS</th>
                                    <td>{{ $kelas_mhs->matkul->sks }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @hasrole ('mahasiswa')
                <div class="pricing-cta bg-primary">
                    <form action="{{ route('absen', $kelas_mhs->id  ) }}" method="post">
                        @csrf
                        <button class="btn btn-primary form-control">Absen <i class="fas fa-arrow-right"></i></button>
                    </form>
                </div>
                @endhasrole
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Popular Browser</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mb-4 mb-lg-0 text-center">
                                {{-- <a href="{{ route('materi', [$kelas_mhs->kelas_id,$kelas_mhs->matkul_id]) }}"> --}}
                                <a href="{{ route('materi', Crypt::encryptString($kelas_mhs->id)) }}">
                                    <i data-feather="book-open"></i>
                                    <div class="mt-2 font-weight-bold">Materi</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 38%</div>
                                </a>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <i data-feather="clipboard"></i>
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
                            {{-- <div class="col mb-4 mb-lg-0 text-center">
                                <div class="browser browser-opera"></div>
                                <div class="mt-2 font-weight-bold">Opera</div>
                                <div class="text-small text-muted">9%</div>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <div class="browser browser-internet-explorer"></div>
                                <div class="mt-2 font-weight-bold">IE</div>
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 4%</div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Rekap Absen</h4>
                        <p>{{ Auth::user()->nama }}</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Pertemuan</th>
                                        <th>Kode Matakuliah</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($absens as $i => $absen)
                                    <tr>
                                        <th scope="row">{{ $absens->firstItem() + $i }}</th>
                                        <td><span
                                                class="badge badge-{{ $absen->status == 1 ? 'success' : 'danger' }}">{{ $absen->status == 1 ? 'Hadir' : 'Tidak Hadir' }}</span>
                                        </td>
                                        <td>{{ $absen->pertemuan }}</td>
                                        <td>{{ $kelas_mhs->matkul->kd_matkul }}</td>
                                        <td>{{ $absen->tanggal }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary">Tidak ada rekap absen</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>