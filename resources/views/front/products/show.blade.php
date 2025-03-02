@extends('layouts.front')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <h4 class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold">{{ __('Show Product') }}</span>
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm">Back</a>
                    </div>
                </h4>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center mb-4">
                            <img class="img-fluid rounded" style="max-width: 100%; height: auto;"
                                src="{{ asset($product->image) }}" alt="Product Image">
                        </div>

                        <div class="col-md-6">
                            <h3 class="text-primary fw-bold">{{ $product->name }}</h3>
                            <p class="text-muted"><b>Category:</b> {{ $product->category->name }}</p>
                            <p><b>Price:</b> <span class="text-success fw-bold">${{ number_format($product->price, 2) }}</span></p>
                            <p><b>Stock:</b> <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}
                            </span></p>

                            <hr>
                            <p class="text-secondary"><b>Description:</b></p>
                            <p>{{ $product->description }}</p>
                            <p class="text-secondary"><b>Rate:
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
                                    <span
                                        class="small text-muted">({{ number_format($product->average_rating, 1) }})</span>
                                </span>
                        </p> </b>
                        </div>
                    </div>
<hr>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Review
                        </button>
                    </div>
                </div>
            </div>

            <br>

            <div class="card shadow-sm mb-5">
                <h4 class="card-header">{{ __('Product Reviews') }}</h4>

                <div class="card-body">
                    @if($product->reviews->count() > 0)
                        @foreach($product->reviews as $review)
                            <div class="row mb-3">
                                <div class="col-md-2 text-center">
                                    <img class="rounded-circle" style="width: 60px;"
                                        src="{{ asset('images/person.png') }}" alt="User">
                                    <p class="text-muted small">{{ $review->user->name }}</p>
                                </div>

                                <div class="col-md-10">
                                    <p class="text-muted small">{{ $review->created_at->diffForHumans() }}</p>
                                    <span class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                        @endfor
                                    </span>
                                    <p class="bg-light p-3 rounded mt-2">{{ $review->comment }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <p class="text-center text-muted">No reviews yet. Be the first to review this product!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('products.modals._add-review-to-product')

@endsection
