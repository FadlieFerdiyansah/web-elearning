<x-app-layouts>
    @push('styles')
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Update Kelas</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            <form action="{{ route('kelas.update',$kela) }}" method="post">
                @method('put')
                @csrf
                <x-input type="text" attr="kelas" label="Kelas" value="{{ $kela->kd_kelas }}" />
                <x-button>Update</x-button>
            </form>
        </div>
    </div>
    @push('scrips')
    @endpush
</x-app-layouts>