<x-app-layouts title="Buat Kelas">
    @push('styles')
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Create Kelas</h4>
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
            <form action="{{ route('kelas.store') }}" method="post">
                @csrf
                <x-input attr="kelas"> Kelas </x-input>

                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>