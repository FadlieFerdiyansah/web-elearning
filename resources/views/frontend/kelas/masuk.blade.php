<x-app-layouts>
    <div class="row">
        <div class="col-md-3">
            <div class="pricing ">
                <div class="pricing-title">
                    presensi
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h3>{{ $jadwal->jam_masuk .' - '. $jadwal->jam_keluar }}</h3>
                        <div>Jam masuk - Jam keluar {{ $jadwal->kd_kelas }}</div>
                    </div>
                    <div>
                        <table class="table">
                            <thead>
                                <tr align="left">
                                    <th>Dosen</th>
                                    <td>{{ $jadwal->dosen->nama }}</td>
                                </tr>
                                <tr align="left">
                                    <th>Matakuliah</th>
                                    <td>{{ $jadwal->matkul->nm_matkul }}</td>
                                </tr>
                                <tr align="left">
                                    <th>SKS</th>
                                    <td>{{ $jadwal->matkul->sks }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @hasrole ('mahasiswa')
                    @if ($waktuAbsen)
                        <div class="pricing-cta bg-primary">
                            <form action="{{ route('absen') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ Crypt::encryptString($jadwal->id) }}">
                                <button class="btn btn-primary form-control">Absen <i class="fas fa-arrow-right"></i></button>
                            </form>
                        </div>
                    @else
                        <div class="pricing-cta bg-primary">
                            <button class="btn btn-primary form-control disabled">Absen <i class="fas fa-arrow-right"></i></button>
                        </div>
                    @endif
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
                                {{-- <a href="{{ route('materi', [$jadwal->kelas_id,$jadwal->matkul_id]) }}"> --}}
                                <a href="{{ route('materi', Crypt::encryptString($jadwal->id)) }}">
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
                                        <th>Matakuliah</th>
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
                                        <td>{{ $jadwal->matkul->nm_matkul }}</td>
                                        <td>{{ $absen->tanggal }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary">Tidak ada rekap absen</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $absens->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>