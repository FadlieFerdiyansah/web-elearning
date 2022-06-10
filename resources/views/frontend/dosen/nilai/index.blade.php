<x-app-layouts>
  <div class="card">
      <div class="card-header">
          {{-- <a href="{{ route('materis.create', encrypt($jadwal->id)) }}" class="btn btn-sm btn-dark"><i
                  class="fas fa-plus"></i> Tambah materi</a> --}}
      </div>
      <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- List Tab --}}
            <li class="nav-item">
                <a class="nav-link active" id="materi-tab" data-toggle="tab" href="#materi" role="tab"
                    aria-controls="materi" aria-selected="true">Materi Tambahan</a>
            </li>
            {{-- End List Tab --}}
          </ul>

          <div class="tab-content" id="myTabContent">

              {{-- Tab pane --}}
              <div class="tab-pane fade" id="vidio" role="tabpanel" aria-labelledby="vidio-tab">
                  <div class="row mt-4">
                      
                  </div>
              </div>
              {{-- End Tab Pane --}}

          </div>
      </div>
  </div>

</x-app-layouts>