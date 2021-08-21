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
                        <div>Jam masuk - Jam keluar {{ $kelas_mhs->kelas->kd_kelas }}</div>
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
                <div class="pricing-cta bg-primary">
                    <form action="#" method="post">
                        <button class="btn btn-primary form-control">Absen <i class="fas fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td><span class="badge badge-success">Hadir</span></td>
                                    <td>1</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><span class="badge badge-danger">Tidak hadir</span></td>
                                    <td>2</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>hadir</td>
                                    <td>3</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>