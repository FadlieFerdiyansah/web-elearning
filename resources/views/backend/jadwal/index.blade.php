<x-app-layouts title="Tabel Jadwal">
  <div id="table" endpoint="{{ route('jadwals.index') }}" routeCreate={{ route('jadwals.create') }} title="Table Jadwal">
  </div>

  @push('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
  @endpush
</x-app-layouts>