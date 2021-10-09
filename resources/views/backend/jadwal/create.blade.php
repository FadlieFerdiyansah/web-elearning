<x-app-layouts title="Buat Jadwal">
    @push('styles')
    @endpush

    <div id="jadwal" endpoint="{{ route('jadwals.store') }}" title="Form Jadwal">
    </div>

      @push('scripts')
      <script src="{{ asset('js/app.js') }}"></script>
      @endpush
</x-app-layouts>