<x-app-layouts>
    <div class="card">
        <div class="card-body col-8">
            <form action="{{ route('sendTugas', [encrypt($jadwal->id), $tugas->id]) }}" method="post">
                @csrf
                <x-input type="text" attr="judul" label="Judul tugas" value="{{ $tugas->judul }}" readonly/>
                <x-input type="text" attr="pertemuan" label="Pertemuan" value="{{ $tugas->pertemuan }}" readonly/>
                <x-input type="text" attr="pengumpulan" label="Pengumpulan" value="{{ date('d F Y, H:i', strtotime($tugas->pengumpulan)) }}" readonly/>
                <x-input type="text" attr="link" label="Link" placeholder="https://drive.google.com/file/d/1mU8zaLNczVQ_hmvLtAxEdTotAIj95gl1/view?usp=sharing" autofocus/>
                <x-textarea attr="deskripsi" label="Deskripsi" readonly>{{ $tugas->deskripsi }}</x-textarea>
                <x-button>Kirim</x-button>
            </form>
        </div>
    </div>

</x-app-layouts>