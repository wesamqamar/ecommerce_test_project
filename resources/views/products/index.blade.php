@extends('layouts.master')

@section('content')
<div class="container">
    @include('partials.filter')

    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">All Products</h5>
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-light">+ Add Product</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="Product Image" class="rounded shadow img-fluid" style="width: 50px;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }} €</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="mt-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product->average_rating))
                                                <i class="fas fa-star text-warning small"></i>
                                            @elseif ($i == ceil($product->average_rating) && $product->average_rating - floor($product->average_rating) >= 0.5)
                                                <i class="fas fa-star-half-alt text-warning small"></i>
                                            @else
                                                <i class="far fa-star text-warning small"></i>
                                            @endif
                                        @endfor
                                        <span class="small text-muted">({{ number_format($product->average_rating, 1) }})</span>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('dashboard.products.show', $product->id) }}" class="dropdown-item">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard.products.edit', $product->id) }}" class="dropdown-item">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('dashboard.products.updateStatus', $product->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        @if($product->status)
                                                            <i class="fa fa-times-circle text-danger"></i> Deactivate
                                                        @else
                                                            <i class="fa fa-check-circle text-success"></i> Activate
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
