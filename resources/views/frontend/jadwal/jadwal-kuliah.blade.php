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
						<p>{{ $jadwal->id }}</p>
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
					<a href="{{ route('kelas.masuk',Crypt::encryptString($jadwal->id)) }}">Masuk <i
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


//Maybe will be executed
{{-- <div class="row">
	<div class="col-md-4">
		<div class="card card-primary">
			<div class="card-header">
				<h4>Senin</h4>
			</div>
			<div class="card-body">
				<label><b>Kelas :</b> 17.2A.12</label>
				<label><b>Dosen :</b> Rimuru Ahmed Julian S.MPD</label>
				<label><b>Kode Matkul :</b> BI</label> <br>
				<label><b>SKS :</b> 4</label>
			</div>
			<div class="d-flex justify-content-center">
				<div class="btn-group">
					<a href="#" class="btn btn-success">Masuk Kelas</a>
					<a href="#" class="btn btn-primary">
						<i style="width: 15px;" data-feather="book-open"></i>
					</a>
					<a href="#" class="btn btn-primary">
						<i style="width: 15px;" data-feather="clipboard"></i>
					</a>
					<a href="#" class="btn btn-primary">
						<i style="width: 15px;" data-feather="message-square"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div> --}}