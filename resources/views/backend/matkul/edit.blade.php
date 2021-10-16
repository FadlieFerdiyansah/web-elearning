<x-app-layouts>
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Matakuliah &raquo; {{ $matkul->nm_matkul }}</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('matkuls.update',$matkul->id) }}" method="post">
                @csrf
                @method('put')
                <x-input type="text" attr="nm_matkul" label="Matakuliah" value="{{ $matkul->nm_matkul }}" />
                <x-input type="text" attr="sks" label="SKS" value="{{ $matkul->sks }}" />
                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
</x-app-layouts>