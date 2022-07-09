<x-app-layouts title="Lupa Password">
    <div class="container mt-3">
        <div class="row d-flex">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-1 col-xl-8">
                <div class="card card-primary">
                    <div class="card-header">
                        Lupa Kata Sandi
                    </div>
                    @if (session('token'))
                    <div class="d-flex justify-content-center bg-light">
                        <p class="p-1">Link riset password : </p>
                        <p class="p-1">
                            <a class="text-info" href="{{ session('token') }}" class="text-primary">
                                <b>Link ini akan hilang, Jika browser kamu ter refresh</b>
                            </a>
                        </p>
                    </div>
                    @endif
                    <div class="card-body">
                        <x-alert />
                        <form method="POST" action="{{ route('forgot.password') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Masukan Email
                                    Anda</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="d-flex col-md-12 offset-md-4">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        Kirim Link Password Riset
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-light">
                                        Kembali ke Login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>