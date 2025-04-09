@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Food Items</h5>
                <a href="{{ route('foodItems.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Restaurant</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image Path</th>
                            <th scope="col">Is Available</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foodItems as $foodItem)
                            <tr>
                                <th scope="row">{{ $foodItem->id }}</th>
                                <td>{{ $foodItem->restaurant ? $foodItem->restaurant->name : 'N/A' }}</td>
                                <td>{{ $foodItem->category ? $foodItem->category->name : 'N/A' }}</td> 
                                <td>{{ $foodItem->name }}</td>
                                <td>{{ $foodItem->description }}</td>
                                <td>{{ $foodItem->price }}</td>
                                <td>{{ $foodItem->image_path }}</td>
                                <td>{{ $foodItem->is_available ? 'Yes' : 'No' }}</td>
                                <td>{{ $foodItem->created_at }}</td>
                                <td>{{ $foodItem->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('foodItems.edit', $foodItem->id) }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>
                                    
                                    <form action="{{ route('foodItems.destroy', $foodItem->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Delete</button>
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
@endsection
