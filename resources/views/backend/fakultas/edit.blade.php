<x-app-layouts>
    @push('styles')
    @endpush
        <div class="card">
            <div class="card-header">
                <h4>Form Create Fakultas</h4>
            </div>
            <div class="card-body col-md-8 col-sm">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                            {!! session('success') !!}
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('fakultas.update',$fakulta) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="fakultas">Nama Fakultas</label>
                        <input type="text" name="nama" id="fakultas" class="form-control" value="{{ old('nama') ?? $fakulta->nama }}">
                    </div>

                    <x-button.button>Update</x-button.button>
                </form>
            </div>
        </div>
    @push('scrips')
    @endpush
</x-app-layouts>