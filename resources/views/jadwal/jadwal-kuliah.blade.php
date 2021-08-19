<x-app-layouts>
	@push('styles')
	<style>
		td:nth-child(2) {
			width: 20px;
			text-align: center
		}
	</style>
	@endpush
	<div class="row">
		@foreach ($jadwals as $jadwal)
		<div class="col-12 col-md-4 col-lg-4">
			<div class="pricing{{ $jadwal->hari == $day ? ' pricing-highlight' : '' }}">
				<div class="pricing-title">
					{{ $jadwal->jam_masuk .'-'.$jadwal->jam_keluar }}
				</div>
				<div class="pricing-padding">
					<div class="pricing-price">
						<div>{{ $jadwal->hari }}</div>
						<div>{{ $jadwal->matkul->nm_matkul }}</div>
						{{ $jadwal->kelas_id }}
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
					<a href="{{ route('kelas.masuk',Crypt::encryptString($jadwal->matkul_id)) }}">Masuk <i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</x-app-layouts>