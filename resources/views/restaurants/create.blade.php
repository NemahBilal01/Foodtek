@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Restaurant</h5>
                
                <form action="{{ route('restaurants.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="owner_id">Owner ID</label>
                        <input type="text" class="form-control" name="owner_id" id="owner_id" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Restaurant Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="logo_url">Logo URL</label>
                        <input type="text" class="form-control" name="logo_url" id="logo_url">
                    </div>
                    <div class="form-group mb-3">
                        <label for="opening_time">Opening Time</label>
                        <input type="time" class="form-control" name="opening_time" id="opening_time" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="closing_time">Closing Time</label>
                        <input type="time" class="form-control" name="closing_time" id="closing_time" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="is_active">Is Active</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Restaurant</button>
                    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
