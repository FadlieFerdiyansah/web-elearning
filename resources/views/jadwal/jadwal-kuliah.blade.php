<x-app-layouts>
  <div class="row">
    @foreach ($jadwals as $jadwal)
    <div class="col-md-4">
      <div class="card {{ $jadwal->hari == $day ? 'card-primary' : 'card-light' }}">
        <div class="card-header">
          <h4><i data-feather="award"></i><span class="ml-2">{{ strtoupper($jadwal->hari) }} ~ {{ $jadwal->jam_masuk ."-". $jadwal->jam_keluar }}</span></h4>
          <div class="card-header-action">
            <a data-collapse="#{{ $jadwal->id }}" class="btn btn-icon btn-info" href="#"><i
                class="fas fa-minus"></i></a>
          </div>
        </div>
        <div class="collapse show" id="{{ $jadwal->id }}" style="">
          <div class="card-body background-primary color-primary">
            <table>
              <tr>
                <td class="font-bold">Kelas</td>
                <td class="pr-2">:</td>
                <td>{{ $jadwal->kelas->kd_kelas }}</td>
              </tr>
              <tr>
                <td class="font-bold">Mata Kuliah</td>
                <td>:</td>
                <td> {{ $jadwal->matkul->nm_matkul }}</td>
              </tr>
              <tr>
                <td class="font-bold">Dosen</td>
                <td>:</td>
                <td> {{ $jadwal->dosen->nama }}</td>
              </tr>
            </table>
          </div>
          <div class="card-footer">
            <div class="card-header-action">
              <div class="btn-group">
                <a href="#" class="btn btn-success">Absen</a>
                <a href="#" class="btn btn-primary">Diskusi</a>
                <a href="#" class="btn btn-warning">Materi</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-app-layouts>