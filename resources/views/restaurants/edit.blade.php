@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Restaurant</h5>

                <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name">Restaurant Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $restaurant->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required>{{ old('description', $restaurant->description) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="logo_url">Logo URL</label>
                        <input type="text" class="form-control" name="logo_url" id="logo_url" value="{{ old('logo_url', $restaurant->logo_url) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="opening_time">Opening Time</label>
                        <input type="time" class="form-control" name="opening_time" id="opening_time" value="{{ old('opening_time', $restaurant->opening_time) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="closing_time">Closing Time</label>
                        <input type="time" class="form-control" name="closing_time" id="closing_time" value="{{ old('closing_time', $restaurant->closing_time) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="is_active">Is Active</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1" {{ $restaurant->is_active == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $restaurant->is_active == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Restaurant</button>
                    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

                @if ($errors->any())
                    <div style="color: red; margin-top: 20px;">
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
