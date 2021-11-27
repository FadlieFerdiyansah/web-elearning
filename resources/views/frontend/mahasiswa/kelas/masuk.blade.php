<x-app-layouts>
    <div class="row">
        <div class="col-md-3">
            <div class="pricing">
                <div class="pricing-title">
                    presensi
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h2>{{ $jadwal->hari }}</h2>
                        <h5>{{ $jadwal->jam_masuk .' - '. $jadwal->jam_keluar }}</h5>
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
                @if ($waktuAbsen && $allowMhsAbsen)
                <div class="pricing-cta bg-primary">
                    <form action="{{ route('absen') }}" method="post">
                        @csrf
                        <input type="hidden" name="jadwal" value="{{ encrypt($jadwal->id) }}">
                        <button class="btn btn-primary form-control">{{ $isAbsen ? 'Sudah Absen' : 'Absen' }} <i class="fas fa-arrow-right"></i></button>
                    </form>
                </div>
                @else
                <div class="pricing-cta bg-primary">
                    <button class="btn btn-primary form-control disabled">Absen <i
                            class="fas fa-arrow-right"></i></button>
                </div>
                @endif
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
                                <a href="{{ route('materi.mhs', encrypt($jadwal->id)) }}">
                                    <i data-feather="book-open"></i>
                                    <div class="mt-2 font-weight-bold">Materi</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 38%</div>
                                </a>
                            </div>
                            <a href="{{ route('tugas.mhs', encrypt($jadwal->id)) }}" class="col mb-4 mb-lg-0 text-center">
                                <i data-feather="clipboard"></i>
                                <div class="mt-2 font-weight-bold">Tugas</div>
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 22%</div>
                            </a>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <i data-feather="message-square"></i>
                                <div class="mt-2 font-weight-bold">Diskusi</div>
                                <div class="text-small text-muted"><span class="text-danger"><i
                                            class="fas fa-caret-down"></i></span> 27%</div>
                            </div>
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
                                        <th>Matakuliah</th>
                                        <th>Pertemuan</th>
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
                                        <td>{{ $jadwal->matkul->nm_matkul }}</td>
                                        <td>{{ $absen->pertemuan }}</td>
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