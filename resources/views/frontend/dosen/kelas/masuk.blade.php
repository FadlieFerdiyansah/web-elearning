<x-app-layouts>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Popular Browser</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mb-4 mb-lg-0 text-center">
                                {{-- <a href="{{ route('materi', [$jadwal->kelas_id,$jadwal->matkul_id]) }}"> --}}
                                <a href="{{ route('materi', Crypt::encryptString($jadwal->id)) }}">
                                    <i data-feather="book-open"></i>
                                    <div class="mt-2 font-weight-bold">Materi</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 38%</div>
                                </a>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <i data-feather="clipboard"></i>
                                <div class="mt-2 font-weight-bold">Tugas</div>
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 22%</div>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <i data-feather="message-square"></i>
                                <div class="mt-2 font-weight-bold">Diskusi</div>
                                <div class="text-small text-muted"><span class="text-danger"><i
                                            class="fas fa-caret-down"></i></span> 27%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>