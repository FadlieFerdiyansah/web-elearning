<x-app-layouts>
  @push('styles')
  @endpush

    <div id="table" endpoint="{{ route('jadwals.datatable') }}" title="Table Jadwal">
    </div>

    @push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    @endpush
</x-app-layouts>