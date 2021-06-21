<x-app-layouts>
  <div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
          @foreach ($jadwal as $jad)
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4><i data-feather="award"></i><span class="ml-2">{{ strtoupper($jad->hari) }} ~ {{ $jad->jam_masuk ."-". $jad->jam_keluar }}</span></h4>
                <div class="card-header-action">
                  <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i
                      class="fas fa-minus"></i></a>
                </div>
              </div>
              <div class="collapse show" id="mycard-collapse" style="">
                <div class="card-body background-primary color-primary">
                  <table>
                    <tr>
                      <td class="font-bold">Kelas</td>
                      <td class="pr-2">:</td>
                      <td>{{ $jad->kelas->kode_kelas }}</td>
                    </tr>
                    <tr>
                      <td class="font-bold">Mata Kuliah</td>
                      <td>:</td>
                      <td> {{ $jad->matkul->nm_matkul }}</td>
                    </tr>
                  </table>
                </div>
                <div class="card-footer">
                  Card Footer
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
  </div>
</x-app-layouts>