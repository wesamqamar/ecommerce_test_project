@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Discover Our Products</h2>

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="position-relative">
                        <img src="{{ asset($product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Product Image">
                        <span class="position-absolute top-0 start-0 m-2 px-2 py-1 rounded bg-{{ $product->stock > 0 ? 'success' : 'danger' }} text-white small">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <h6 class="fw-bold text-dark mb-1">{{ Str::limit($product->name, 22) }}</h6>
                        <p class="small text-muted">Category: <span class="fw-semibold text-secondary">{{ $product->category->name }}</span></p>
                        <p class="fw-bold text-success mb-2 fs-5">${{ number_format($product->price, 2) }}</p>

                        <div>
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
                        </div>

                        <p class="small text-truncate mt-2 text-muted">{{ Str::limit($product->description, 60) }}</p>

                        <a href="{{ route('front.products.show', $product->id) }}" class="btn btn-outline-primary mt-auto rounded-pill">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection
