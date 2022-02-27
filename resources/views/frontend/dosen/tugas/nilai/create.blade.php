<x-app-layouts title="Tanggapi">
    <div class="card">
        <div class="card-header">
            <h4 class="text-uppercase">Tanggapi hasil tugas mahasiswa</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="" method="post">
                @csrf

                <label class="text-uppercase text-muted"><b>mahasiswa</b> <hr></label>

                <div class="row d-flex justify-content-between">
                    <div class="col-md-5">
                        <x-input type="text" attr="nama" value="{{ $tugas->mahasiswa->nama }}" label="Nama" readonly/>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <x-input type="text" attr="nim" value="{{ $tugas->mahasiswa->nim }}" label="NIM" readonly/>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <x-input type="text" attr="kelas" value="{{ $tugas->mahasiswa->kelas->kd_kelas }}" label="Kelas" readonly/>
                    </div>
                </div>

                <label class="text-uppercase text-muted"><b>tugas pertemuan {{ $tugasParent->pertemuan }}</b> <hr></label>
                <x-input type="text" attr="judul" value="{{ $tugasParent->judul }}" label="Judul" readonly/>
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-6 col-md-4">
                        <x-input type="text" attr="created_at" value="{{ date('d F Y H:i', strtotime($tugas->created_at)) }}" label="Tugas dibuat pada" readonly/>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <x-input type="text" attr="updated_at" value="{{ date('d F Y H:i', strtotime($tugas->updated_at)) }}" label="Tugas diedit pada" readonly/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <x-input type="text" attr="pengumpulan" value="{{ date('d F Y H:i', strtotime($tugas->pengumpulan)) }}" label="Batas Pengumpulan Tugas" readonly/>
                    </div>
                    <div class="col-md-12">
                        <x-textarea attr="deskripsi" label="Deskripsi" readonly>{{ $tugasParent->deskripsi }}</x-textarea>
                    </div>
                </div>

                <label class="text-uppercase text-muted"><b>nilai dan komentar dosen</b> <hr></label>
                <x-input type="number" attr="nilai" label="Nilai" placeholder="Masukan nilai"/>
                <x-textarea attr="komentar_dosen" label="Komentar Dosen" placeholder="Berikan komentar..."></x-textarea>
                
                <x-button>Submit</x-button>
            </form>
        </div>
    </div>
</x-app-layouts>