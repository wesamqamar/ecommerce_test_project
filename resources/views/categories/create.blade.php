@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <h4 class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <div>{{ __('Create Category') }}</div>
                    <div>
                        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </h4>

                <div class="card-body">
                    <form action="{{ route('dashboard.categories.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group mb-4">
                            <label for="name"><b>Category Name</b></label>
                            <input type="text" name="name" class="form-control mt-2 {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Insert Category Name ...">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <br>
                        <button type="submit" class="btn btn-success w-100 btn-lg">
                            <i class="fas fa-save"></i> Save Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
