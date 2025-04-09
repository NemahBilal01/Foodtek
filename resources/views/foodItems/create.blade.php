@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Food Item</h5>

                <form action="{{ route('foodItems.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Restaurant Selection -->
                    <div class="form-group mb-3">
                        <label for="restaurant_id">Restaurant</label>
                        <select name="restaurant_id" class="form-control" required>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Name Field -->
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Price Field -->
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>

                    <!-- Image Path Field (for uploading an image) -->
                    <div class="form-group mb-3">
                        <label for="image_path">Image Path</label>
                        <input type="file" name="image_path" class="form-control" required>
                    </div>

                    <!-- Is Available Field (checkbox for availability) -->
                    <div class="form-group mb-3">
                        <label for="is_available">Is Available</label>
                        <input type="checkbox" name="is_available" value="1" class="form-check-input">
                    </div>

                    <!-- Created At (auto-filled) -->
                    <div class="form-group mb-3">
                        <label for="created_at">Created At</label>
                        <input type="datetime-local" name="created_at" class="form-control" value="{{ now()->toDateTimeLocalString() }}" readonly>
                    </div>

                    <!-- Updated At (auto-filled) -->
                    <div class="form-group mb-3">
                        <label for="updated_at">Updated At</label>
                        <input type="datetime-local" name="updated_at" class="form-control" value="{{ now()->toDateTimeLocalString() }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Food Item</button>
                    <a href="{{ route('foodItems.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

                @if ($errors->any())
                    <div class="text-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
