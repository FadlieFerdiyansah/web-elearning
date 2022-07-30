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
                                <h6 class="mb-1"><img width="36" height="36" alt="GitHub Logomark" class="height-auto" src="https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_youtube-512.png"></h6>
                                <h6 class="mb-1">Youtube</h6>
                            </div>
                        </a>
                        <a href="https://github.com/fadlieFerdiyansah/web-elearning" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1"><img width="40" height="40" alt="GitHub Logomark" class="height-auto" src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png"></h6>
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
                    <h6 class="text-muted">Profile</h6>
                </div>
                <div class="card-body">
                    <x-alert />

                    <div class="table-responsive">
                        <form action="{{ route('dashboard.mahasiswa_updateProfile') }}" method="post">
                            @csrf
                            <table class="table">
                                <tr>
                                    <td style="width: 150px !important">NIM</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->nim }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>
                                        {{ auth()->user()->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password saat ini</td>
                                    <td>:</td>
                                    <td>
                                        <input type="password" name="password_saat_ini"
                                            class="form-control @error('password_saat_ini') is-invalid @enderror"
                                            placeholder="masukan password saat ini" required>
                                        @error('password_saat_ini')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password Baru</td>
                                    <td>:</td>
                                    <td>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="masukan password baru" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>Konfirmasi Password Baru</td>
                                    <td>:</td>
                                    <td>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="konfirmasi password baru"
                                            autocomplete="new-password" required>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>

                                        <ul class="list-group">
                                            {{ auth()->user()->kelas->kd_kelas }}
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>