<x-app-layouts title="Upload Materi">
    <div class="row">
    @forelse ($jadwalsActive as $jadwal)
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-cyan">
                    <i class="fas fa-bookmark"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $jadwal->kelas->kd_kelas }}
                            </h3>
                            <span class="text-muted"><a href="{{ route('absensi.detail',$jadwal->kelas->kd_kelas) }}">Lihat Absen.</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card">
            <div class="card-body">
                <div class="empty-state" data-height="200">
                    <div class="empty-state-icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <h2>Tidak ada kelas</h2>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</x-app-layouts>