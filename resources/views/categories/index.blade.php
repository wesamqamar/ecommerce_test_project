@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow"> <!-- Added shadow for better visibility -->
                <h4 class="card-header d-flex justify-content-between align-items-center bg-primary text-white"> <!-- Improved header styling -->
                    <div>{{ __('Categories') }}</div>
                    <div>
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-light"> <!-- Changed button style -->
                            <i class="fas fa-plus"></i> Create New <!-- Added icon -->
                        </a>
                    </div>
                </h4>

                <div class="card-body">
                    <table class="table table-hover table-bordered text-center">
                        <thead class="table-dark"> <!-- Dark header for better contrast -->
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Products Count</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        @if( $category->status == 0 )
                                            <span class="badge bg-danger">Inactive</span>
                                        @elseif( $category->status == 1 )
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.categories.edit' , $category->id) }}" class="btn btn-warning btn-sm"> <!-- Added btn-sm for smaller buttons -->
                                            <i class="fas fa-edit"></i> Edit <!-- Added icon -->
                                        </a>

                                        <form action="{{ route('dashboard.categories.destroy' , $category->id) }}" method="POST" style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm delete" style="cursor:pointer"> <!-- Added btn-sm for smaller buttons -->
                                                <i class="fas fa-trash"></i> Delete <!-- Added icon -->
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
