<x-app-layouts title="Seluruh nilai mahasiswa">
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
                    <table border="1px" class="table">
                        <thead>
                            <tr>
                              <td style="background:#8D8DAA; color:white">MAHASISWA</td>
                              @foreach ($mahasiswa as $key => $mhs)
                                  @if ($mhs->kelas_id == $kls->id)
                                      <td style="background:{{ $key % 2 == 0 ? '#DFDFDE' : '' }}">
                                        <li class="media">
                                            <img alt="image" class="mr-3 rounded-circle" width="50"
                                                src="{{ $mhs->foto == 'default.png' ?  $mhs->pictureDefault : $mhs->picture }}">
                                            <div class="media-body">
                                                <div class="media-title">{{ $mhs->nama }}</div>
                                                <div class="text-job">{{ $mhs->nim }}</div>
                                            </div>
                                        </li>  
                                      </td>
                                  @endif
                              @endforeach
                            </tr>
                            @for ($i = 1; $i <= 16; $i++)
                            <tr>
                              <td style="background:#8D8DAA; color:white">PERTEMUAN {{ $i }}</td>
                              @foreach ($mahasiswa as $key => $mhs)
                                @if ($mhs->kelas_id == $kls->id)
                                <td style="background:{{ $key % 2 == 0 ? '#DFDFDE' : '' }}">
                                  @foreach($mhs->tugas as $tugas)
                                      @if ($tugas->pertemuan == $i)
                                        {{ $tugas->nilai->nilai ?? 'Belum dinilai' }}
                                      @endif
                                  @endforeach
                                </td>
                                @endif
                              @endforeach
                            </tr>
                            @endfor
                        </thead>
                        <tbody>
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