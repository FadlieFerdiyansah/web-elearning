<x-app-layouts title="Dashboard">
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-muted">Info</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{ auth()->user()->foto == 'default.png' ? auth()->user()->pictureDefault : auth()->user()->picture }}"
                            alt="{{ auth()->user()->nama }}" style="width: 10em" class="img-fluid rounded mb-3">
                    </div>

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-center">
                                <h6 class="mb-1">Panduan Penggunaan</h6>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1"><img width="36" height="36" alt="GitHub Logomark" class="height-auto"
                                        src="https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_youtube-512.png">
                                </h6>
                                <h6 class="mb-1">Youtube</h6>
                            </div>
                        </a>
                        <a href="https://github.com/fadlieFerdiyansah/web-elearning" target="_blank"
                            class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1"><img width="40" height="40" alt="GitHub Logomark" class="height-auto"
                                        src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png">
                                </h6>
                                <h6 class="mb-1 mt-2">Github</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-muted">Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-user-graduate fa-3x"></i>
                                        <div class="mt-3 font-weight-bold">
                                            <h5>Mahasiswa</h5>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span class="text-primary">
                                                <i class="fas fa-caret-up"></i>
                                            </span>
                                            <h5 style="margin-top: -15px">
                                                {{ $mahasiswas }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-user fa-3x"></i>
                                        <div class="mt-3 font-weight-bold">
                                            <h5>Dosen</h5>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span class="text-primary">
                                                <i class="fas fa-caret-up"></i>
                                            </span>
                                            <h5 style="margin-top: -15px">
                                                {{ $dosens }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-layer-group fa-3x"></i>
                                        <div class="mt-3 font-weight-bold">
                                            <h5>Kelas</h5>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span class="text-primary">
                                                <i class="fas fa-caret-up"></i>
                                            </span>
                                            <h5 style="margin-top: -15px">
                                                {{ $kelas }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-book-open fa-3x"></i>
                                        <div class="mt-3 font-weight-bold">
                                            <h5>Matakuliah</h5>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span class="text-primary">
                                                <i class="fas fa-caret-up"></i>
                                            </span>
                                            <h5 style="margin-top: -15px">
                                                {{ $matkuls }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-briefcase fa-3x"></i>
                                        <div class="mt-3 font-weight-bold">
                                            <h5>Fakultas</h5>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span class="text-primary">
                                                <i class="fas fa-caret-up"></i>
                                            </span>
                                            <h5 style="margin-top: -15px">
                                                {{ $fakultas }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-calendar fa-3x"></i>
                                        <div class="mt-3 font-weight-bold">
                                            <h5>Jadwal</h5>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span class="text-primary">
                                                <i class="fas fa-caret-up"></i>
                                            </span>
                                            <h5 style="margin-top: -15px">
                                                {{ $jadwals }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>