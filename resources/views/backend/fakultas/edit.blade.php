<x-app-layouts>
    @push('styles')
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Create Fakultas</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('fakultas.update',$fakulta) }}" method="post">
                @method('put')
                @csrf
                <x-input type="text" attr="nama" label="Nama Fakultas" value="{{ $fakulta->nama }}" />
                <x-button>Update</x-button>
            </form>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>
