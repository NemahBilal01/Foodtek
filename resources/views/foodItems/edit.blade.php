<!-- resources/views/foodItems/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Food Item Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>Restaurant</th>
            <td>{{ $foodItem->restaurant ? $foodItem->restaurant->name : 'No Restaurant' }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $foodItem->category ? $foodItem->category->name : 'No Category' }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $foodItem->name }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $foodItem->description }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $foodItem->price }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td><img src="{{ asset('storage/' . $foodItem->image_path) }}" alt="{{ $foodItem->name }}" class="img-fluid" /></td>
        </tr>
        <tr>
            <th>Is Available</th>
            <td>{{ $foodItem->is_available ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $foodItem->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $foodItem->updated_at }}</td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary">Update Food Item</button>
        <a href="{{ route('foodItems.index') }}" class="btn btn-secondary">Cancel</a>
</div>
@endsection
