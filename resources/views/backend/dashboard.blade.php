<x-app-layouts title="Dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard Admin</h4>
                </div>
                <div class="card-body">
                    <h2>Hi, {{ Auth::user()->nama }}</h2>
                </div>
            </div>
        </div>
    </div>
</x-app-layouts>