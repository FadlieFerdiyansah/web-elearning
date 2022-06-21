<x-app-layouts title="Seluruh absensi mahasiswa">
    @push('styles')
        <style>
            td:nth-child(1) {
              width: 8em;
              min-width: 23em;
              /* max-width: 33em; */
              word-break: break-all;
            }
        </style>
    @endpush
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
                    <hr>
                      <h5>{{ auth()->user()->matkuls->find($kls->pivot->matkul_id)->nm_matkul ?? '' }}</h5>
                    <hr>
                    <div class="table-responsive">
                      <table border="0px" class="table">
                          <thead>
                              <tr>
                                <td class="bg-secondary text-center font-weight-bold">MAHASISWA</td>
                                @for ($i = 1; $i <= 16; $i++)
                                  <td class="text-center bg-secondary font-weight-bold">P {{ $i }}</td>
                                @endfor
                              </tr>
                              @foreach ($mahasiswa as $key => $mhs)
                                  <tr>
                                    @if ($mhs->kelas_id == $kls->id)
                                        <td style="background:{{ $key % 2 == 0 ? '#6FB2D2' : '' }}; border: 1px solid; border-color: #3A5BA0">
                                          <li class="media">
                                              <img alt="image" class="mr-3 rounded-circle" width="50"
                                                  src="{{ $mhs->foto == 'default.png' ?  $mhs->pictureDefault : $mhs->picture }}">
                                              <div class="media-body">
                                                  <div class="media-title">{{ $mhs->nama }}</div>
                                                  <div class="text-job">{{ $mhs->nim }}</div>
                                              </div>
                                          </li>  
                                        </td>
                                      @if ($mhs->kelas_id == $kls->id)
                                        @for ($i = 1; $i <= 16; $i++)
                                          <td style="background:{{ $key % 2 == 0 ? '#6FB2D2' : '' }}; text-align: center; font-size: 18px; font-weight: bold; border: 1px solid; border-color: #3A5BA0">
                                            @foreach($mhs->absens as $absen)
                                                @if ($absen->pertemuan == $i && $kls->pivot->matkul_id == $absen->jadwal->matkul_id)
                                                {{ $absen->status ? '✓' : '-' }}
                                                @endif
                                            @endforeach
                                          </td>
                                        @endfor
                                      @endif
                                    @endif
                                  </tr>
                              @endforeach
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
  
    {{-- @push('lastScripts')
        <script>
            $(document).ready(function () {
                // when klik tab parsing data matkul to controller
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var kelas = $(e.target).text();
                    $.ajax({
                        url: "{{ route('laporan.absensi') }}",
                        type: "GET",
                        data: {
                            matkul: kelas
                        },
                        success: function (data) {
                            $('tbody').html(data);
                        }
                    });
                });
            })
        </script>
    @endpush --}}
  </x-app-layouts>