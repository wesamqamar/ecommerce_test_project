<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="my-4 text-center">Products List</h2>

    <form method="GET" action="{{ route('dashboard.products.index') }}" class="d-flex">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search for products...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
