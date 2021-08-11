<x-app-layouts>
  @push('styles')
      <style>
        td:nth-child(2){
          width: 20px;
          text-align: center
        }
      </style>
  @endpush
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
            <h6>{{ $jadwal->matkul->nm_matkul }}</h6>
            <hr>
            <table>
              <tr>
                <th>Kelas</th>
                <td>:</td>
                <td>{{ $jadwal->kelas->kd_kelas }}</td>
              </tr>
              <tr>
                <th>Kode Matkul</th>
                <td>:</td>
                <td> {{ $jadwal->matkul->kd_matkul }}</td>
              </tr>
              <tr>
                <th>Dosen</th>
                <td>:</td>
                <td> {{ $jadwal->dosen->nama ?? ' ' }}</td>
              </tr>
            </table>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-icon icon-left btn-primary form-control"><i class=" fas fa-briefcase"></i>Masuk Kelas</a>
            <div class="d-flex justify-content-around mt-3">
              <a href="{{ route('materi.show',$jadwal->matkul->id) }}" class="btn btn-icon icon-left btn-dark"><i class="far fa-file-alt"></i>Materi</a>
              <a href="#" class="btn btn-icon icon-left btn-dark"><i class="fas fa-tasks"></i>Tugas</a>
              <a href="#" class="btn btn-icon icon-left btn-dark"><i class="fab fa-discourse"></i>Diskusi</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-app-layouts>