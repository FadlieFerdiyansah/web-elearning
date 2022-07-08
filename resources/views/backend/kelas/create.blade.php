<x-app-layouts title="Buat Kelas">
    <div class="card">
        <div class="card-header">
            <h4>Form Create Kelas</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('kelas.store') }}" method="post">
                @csrf
                <x-input type="text" attr="kelas" label="Kelas" autofocus="autofocus" />
                <x-button>Simpan</x-button>
            </form>
        </div>
    </div>
</x-app-layouts>