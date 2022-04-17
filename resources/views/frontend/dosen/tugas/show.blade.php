<x-app-layouts title="{{ $tugas->judul }}">
    <x-alert />

    <div class="card">
        <div class="card-header">
            <h4 class="text-uppercase text-muted">Tugas yang dibuat dosen</h4>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pertemuan</th>
                            <th>Deskripsi</th>
                            <th>Pengumpulan</th>
                            <th>Diupload pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $tugas->judul }}</td>
                            <td>
                                <div class="badge badge-dark">{{ $tugas->pertemuan }}</div>
                            </td>
                            <td>{{ $tugas->deskripsi }}</td>
                            <td>{{ date('d F Y ~ H:s', strtotime($tugas->pengumpulan)) }}</td>
                            <td>{{ date('d F Y ~ H:s', strtotime($tugas->created_at)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-cyan">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="pull-right">Total Mahasiswa kelas {{ $mahasiswa[0]->kelas->kd_kelas
                            ?? '' }}</h4>
                    </div>
                    <div class="card-body pull-right">
                        {{ $mahasiswa->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-purple">
                    <i class="fas fa-file-export"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="pull-right">Mahasiswa yang mengumpulkan</h4>
                    </div>
                    <div class="card-body pull-right">
                        {{ $tugasMahasiswa->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-danger">
                    <i class="fas fa-file-excel"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="pull-right">Mahasiswa yang tidak mengumpulkan</h4>
                    </div>
                    <div class="card-body pull-right">
                        30
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h4 class="text-uppercase text-muted">Tugas yang dikumpulkan Mahasiswa</h4>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Nilai</th>
                            <th>Komentar dosen</th>
                            <th>Dikumpulkan pada</th>
                            <th>Diubah pada</th>
                            <th>Link tugas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugasMahasiswa as $tgsMhs)
                        <tr class="{{ $tgsMhs->id % 2 == 0 ? 'border-top' : '' }}">
                            <td>
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{ $tgsMhs->mahasiswa->foto == 'default.png' ?  $tgsMhs->mahasiswa->pictureDefault : $tgsMhs->mahasiswa->picture }}">
                                    <div class="media-body">
                                        <div class="media-title">{{ $tgsMhs->mahasiswa->nama }}</div>
                                        <div class="text-job text-muted">{{ $tgsMhs->mahasiswa->nim }}</div>
                                    </div>
                                </li>
                            </td>
                            <td>
                                <h5>{{ $tgsMhs->nilai->nilai ?? '' }}</h5>
                            </td>
                            <td>{{ $tgsMhs->nilai->komentar_dosen ?? '' }}</td>
                            <td>{{ date('d F Y ~ H:i', strtotime($tgsMhs->created_at)) }}</td>
                            <td>{{ date('d F Y ~ H:i', strtotime($tgsMhs->updated_at)) }}</td>
                            <td><a href="{{ $tgsMhs->file_or_link }}" target="_blank">{{ $tgsMhs->file_or_link }}</a></td>
                            <td>
                                <a href="{{ route('nilai.create', $tgsMhs) }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-balance-scale"></i> Tanggapi</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $tugasMahasiswa->links() }}
        </div>
    </div>
</x-app-layouts>