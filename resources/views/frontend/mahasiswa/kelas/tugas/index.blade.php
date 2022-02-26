<x-app-layouts>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="mt-2">{{ $jadwal->matkul->nm_matkul .' - '. $jadwal->kelas->kd_kelas }}</h6>
                {{-- <h6 class="mt-2">{{ $jadwal->kelas->kd_kelas }}</h6> --}}
            </div>
            <x-alert />
            <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tugas-tab" data-toggle="tab" href="#tugas" role="tab"
                        aria-controls="tugas" aria-selected="true">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ntugas-tab" data-toggle="tab" href="#nilaiTugas" role="tab"
                        aria-controls="ntugas" aria-selected="false">Nilai Tugas</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                {{-- tugas --}}
                <div class="tab-pane fade show active" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                    <div class="table-responsive">
                        {{-- <h4 class="mt-2">{{ $jadwal->matkul->nm_matkul .' - '. $jadwal->matkul->kd_matkul}}</h4>
                        <hr> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kd Matkul</th>
                                    <th>Judul</th>
                                    <th>Pertemuan</th>
                                    <th>Deskripsi</th>
                                    <th>Pengumpulan</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $i => $tgs)
                                <tr>
                                    <td>{{ $tugas->firstItem() + $i }}</td>
                                    <td>{{ $jadwal->matkul->kd_matkul }}</td>
                                    <td>{{ $tgs->judul }}</td>
                                    <td><span class="badge badge-dark">{{ $tgs->pertemuan }}</span></td>
                                    <td>{{ $tgs->deskripsi }}</td>
                                    <td>{{ date('d F Y ~ H:s', strtotime($tgs->pengumpulan)) }}</td>
                                    <td>{{ date('d F Y', strtotime($tgs->created_at)) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-info dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon"
                                                    href="{{ route('sendTugas', [encrypt($jadwal->id), $tgs->id]) }}"><i
                                                        class="fas fa-file-export"></i> Kirim Tugas</a>
                                                @if ($tgs->tipe == 'file')
                                                <a href="{{ asset(" /storage/$tgs->file_or_link") }}"
                                                    class="dropdown-item has-icon font-sm" download><i
                                                        class="fas fa-download"></i> Download</a>
                                                @else
                                                <a href="{{ $tgs->file_or_link }}" target="_blank"
                                                    class="dropdown-item has-icon font-sm"><i
                                                        class="fas fa-angle-double-right"></i> Kunjungi</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- Nilai Tugas --}}
                <div class="tab-pane fade" id="nilaiTugas" role="tabpanel" aria-labelledby="ntugas-tab">
                    <div class="table-responsive">
                        {{-- <h4 class="mt-2">{{ $jadwal->matkul->nm_matkul .' - '. $jadwal->matkul->kd_matkul}}</h4>
                        <hr> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kd Matkul</th>
                                    <th>Judul</th>
                                    <th>Link Tugas</th>
                                    <th>Komentar Dosen</th>
                                    <th>Nilai</th>
                                    <th>Dibuat</th>
                                    <th>Diubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugasHasBeenSent as $i => $thbs)
                                <tr>
                                    <td>{{ $tugasHasBeenSent->firstItem() + $i }}</td>
                                    <td>{{ $jadwal->matkul->kd_matkul }}</td>
                                    <td>{{ $thbs->judul }}</td>
                                    <td><a href="{{ $thbs->file_or_link }}" target="_blank">{{ $thbs->file_or_link }}</a></td>
                                    <td>{{ $thbs->deskripsi }}</td>
                                    <td>
                                        80
                                    </td>
                                    <td>{{ date('d F Y ~ H:s', strtotime($thbs->created_at)) }}</td>
                                    <td>{{ date('d F Y ~ H:s', strtotime($thbs->updated_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layouts>