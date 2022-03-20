<x-app-layouts title="Jadwal Kuliah">
	@push('styles')
	<style>
		td:nth-child(2) {
			width: 20px;
			text-align: center
		}
	</style>
	@endpush
	<div class="row">
		@forelse ($jadwals as $jadwal)
		<div class="col-12 col-md-4 col-lg-4">
			<div class="pricing{{ $jadwal->hari == $day ? ' pricing-highlight' : '' }}">
				<div class="pricing-title">
					{{ $jadwal->jam_masuk .'-'.$jadwal->jam_keluar }}
				</div>
				<div class="pricing-padding">
					<div class="pricing-price">
						<div>{{ strtoupper($jadwal->hari) }}</div>
						<div>{{ $jadwal->matkul->nm_matkul }}</div>
					</div>
					<div>
						<div class="py-4">
							<p class="clearfix">
								<span class="float-left font-bold">
									Kelas
								</span>
								<span class="float-right text-muted">
									{{ $jadwal->kelas->kd_kelas }}
								</span>
							</p>
							<p class="clearfix">
								<span class="float-left font-bold">
									Nama Dosen
								</span>
								<span class="float-right text-muted">
									{{ $jadwal->dosen->nama }}
								</span>
							</p>
							<p class="clearfix">
								<span class="float-left font-bold">
									Kode Matkul
								</span>
								<span class="float-right text-muted">
									{{ $jadwal->matkul->kd_matkul }}
								</span>
							</p>
							<p>
								<span class="float-left font-bold">
									SKS
								</span>
								<span class="float-right text-muted">
									{{ $jadwal->matkul->sks }}
								</span>
							</p>
						</div>
					</div>
				</div>
				<div class="pricing-cta">
					<a href="{{ route('mahasiswa.masukKelas',Crypt::encrypt($jadwal->id)) }}">Masuk <i
							class="fas fa-arrow-right"></i></a>
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
						<h2>Tidak menemukan jadwal kuliah</h2>
						<p class="lead">
							Silahkan Hubungi <a href="mailto:help@mybest.com">help@mybest.com</a>
						</p>
					</div>
				</div>
			</div>
		@endforelse
	</div>
</x-app-layouts>