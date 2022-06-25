<x-app-layouts title="Dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard Mahasiswa</h4>
                    <p>Role : {{ Auth::guard('mahasiswa')->user()->hasRole('mahasiswa') ? 'mahasiswa' : 'bukan' }}</p>
                </div>
                <div class="card-body">
                    <h2>Hi, {{ Auth::user()->nama }}</h2>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>