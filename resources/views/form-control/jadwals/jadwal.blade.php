<x-app-layouts>
    @push('styles')
    @endpush

    <div id="jadwal" endpoint="{{ route('jadwals.create') }}" title="Form Jadwal">
    </div>

      @push('scripts')
      <script src="{{ asset('js/app.js') }}"></script>
      @endpush
</x-app-layouts>