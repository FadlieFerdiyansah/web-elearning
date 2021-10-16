<x-app-layouts title="Buat Fakultas">
    @push('styles')
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Create Fakultas</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('fakultas.store') }}" method="post">
                @csrf
                <x-input type="text" attr="nama" label="Nama Fakultas" autofocus="autofocus"/>
                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>