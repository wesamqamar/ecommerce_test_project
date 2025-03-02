@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <h4 class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">{{ __('Show Product') }}</span>
                        <div>
                            <a href="{{ route('dashboard.products.index') }}" class="btn btn-danger btn-sm">Back</a>
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
                                <p><b>Price:</b> <span
                                        class="text-success fw-bold">${{ number_format($product->price, 2) }}</span></p>
                                <p><b>Stock:</b> <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}
                                    </span></p>
                                <p><b>Updated At:</b>
                                    {{ $product->status_updated_at}}
                                </p>
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

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
