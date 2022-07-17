<div class="d-flex justify-content-end mb-4">
    <form class="form-inline" action="{{ $action }}" method="GET">
        <input class="form-control mr-4 col-md" type="search" placeholder="Search" aria-label="Search" name="q" value="{{ request('q') }}">
        <button class="btn btn-icon icon-left btn-primary"><i class="fas fa-search"></i> Cari</button>
    </form>
</div>