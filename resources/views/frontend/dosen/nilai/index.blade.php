<x-app-layouts>
  <div class="card">
      <div class="card-header">
          {{-- <a href="{{ route('materis.create', encrypt($jadwal->id)) }}" class="btn btn-sm btn-dark"><i
                  class="fas fa-plus"></i> Tambah materi</a> --}}
      </div>
      <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- List Tab --}}
            @foreach ($kelas as $key => $kls)
              <li class="nav-item">
                  <a class="nav-link{{ $loop->index == 0 ? ' active' : '' }}" data-toggle="tab" href="#content-{{ $key }}" role="tab"
                      aria-controls="{{ $kls->kd_kelas }}" aria-selected="true">{{ $kls->kd_kelas }}</a>
              </li> 
            @endforeach
            {{-- End List Tab --}}
          </ul>

          <div class="tab-content" id="myTabContent">

              {{-- Tab pane --}}
              @foreach ($kelas as $key => $kls)
                <div class="tab-pane fade{{ $loop->index == 0 ? ' show active' : '' }}" id="content-{{ $key }}" role="tabpanel" aria-labelledby="{{ $kls->kd_kelas }}-tab">
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <td>Mahasiswa</td>
                              @foreach ($mahasiswa as $mhs)
                                  @if ($mhs->kelas_id == $kls->id)
                                      <td>{{ $mhs->nama }}</td>
                                  @endif
                              @endforeach
                            </tr>
                            @for ($i = 1; $i <= 14; $i++)
                            <tr>
                              <td style="inline">Pertemuan {{ $i }}</td>
                            </tr>
                            @endfor
                        </thead>
                        <tbody>
                            {{-- @foreach ($mahasiswa as $i => $mhs)
                              <tr>
                              </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                  </div>
                </div>
              @endforeach
              {{-- End Tab Pane --}}

          </div>
      </div>
  </div>

</x-app-layouts>