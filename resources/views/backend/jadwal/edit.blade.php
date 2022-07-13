<x-app-layouts title="Edit Jadwal">
    <div id="edit-jadwal" endpoint="{{ route('jadwals.update', $jadwal->id) }}" data="{{ $jadwal }}" title="Form Edit Jadwal">
    </div>

    @push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    @endpush
</x-app-layouts>