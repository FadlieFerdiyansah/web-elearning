<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('materis.create', Crypt::encrypt($jadwal->id)) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-plus"></i> Tambah materi</a>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="materi-tab" data-toggle="tab" href="#materi" role="tab"
                        aria-controls="materi" aria-selected="true">Materi Tambahan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="vidio-tab" data-toggle="tab" href="#vidio" role="tab" aria-controls="vidio"
                        aria-selected="false">Video Pembelajaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="slide-tab" data-toggle="tab" href="#slide" role="tab" aria-controls="slide"
                        aria-selected="false">Slide Pembelajaran</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                {{-- Materi Pdf --}}
                <div class="tab-pane fade show active" id="materi" role="tabpanel" aria-labelledby="materi-tab">
                    <div class="table-responsive">
                        <h4 class="mt-2">{{ $materis[0]->matkul->nm_matkul ?? '' }}</h4>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pertemuan</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Diupload pada</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($materis as $i => $materi)
                                @if ($materi->tipe == 'pdf')
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $materi->pertemuan }}</td>
                                    <td>{{ $materi->judul }}</td>

                                    <td>
                                        <div style="width: 350px">{{ $materi->deskripsi }}</div>
                                    </td>
                                    <td>{{ $materi->created_at }}</td>
                                    <td>
                                        {{-- <a class="btn btn-dark btn-sm" href="{{ asset("/storage/$materi->file_or_link") }}"
                                        download>Download</a> --}}
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-dark dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item has-icon"
                                                    href="{{ asset("/storage/$materi->file_or_link") }}" download><i
                                                        class="fas fa-download"></i> Download</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ route('materis.edit', encrypt($materi->id)) }}"><i
                                                        class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('materis.destroy', $materi->id) }}" method="post"
                                                    style="font-size: 13px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item has-icon btn-sm"><i
                                                            class="fas fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-secondary">Tidak ada materi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Video Materi --}}
                <div class="tab-pane fade" id="vidio" role="tabpanel" aria-labelledby="vidio-tab">
                    <div class="row mt-4">
                        @forelse ($materis as $materi)
                        @if ($materi->tipe == 'youtube')
                        <div class="col-12 col-md-7 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ $materi->judul }}</h4>
                                    <div class="card-header-action">
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-dark dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item has-icon"
                                                    href="{{ route('materis.edit', encrypt($materi->id)) }}"><i
                                                        class="fas fa-edit"></i> Edit</a>
                                                {{-- <a class="dropdown-item has-icon" href="#"><i class="fas fa-trash"></i>
                                                        Delete</a> --}}
                                                <form action="{{ route('materis.destroy', $materi->id) }}" method="post"
                                                    style="font-size: 13px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item has-icon btn-sm"><i
                                                            class="fas fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2 text-muted d-flex justify-content-between">
                                        <small>Pertemuan {{ $materi->pertemuan }}</small>
                                        <small>Tanggal: {{ $materi->created_at }}</small>
                                    </div>
                                    <div class="chocolat-parent" style="margin: 0 -25px;">
                                        <div class="mb-3">
                                            <iframe frameborder="0" allowfullscreen="1" title="YouTube video player"
                                                class="w-100" height="200" style="object-fit: cover;"
                                                src="https://www.youtube.com/embed/{{ $materi->file_or_link }}"></iframe>
                                        </div>
                                    </div>
                                    <p>{{ Str::limit($materi->deskripsi, 200) }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        <div class="col-4">
                            <div class="alert alert-info mt-3">
                                Tidak ada vidio materi
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>


                {{-- SLIDE --}}
                <div class="tab-pane fade" id="slide" role="tabpanel" aria-labelledby="slide-tab">
                    Mungkin berisi slide pelajaran
                </div>
            </div>
        </div>
    </div>

</x-app-layouts>