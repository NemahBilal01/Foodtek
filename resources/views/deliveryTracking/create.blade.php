@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Delivery Tracking</h5>

                <form action="{{ route('deliveryTracking.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="order_id">Order ID</label>
                        <input type="number" name="order_id" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="latitude">Latitude</label>
                        <input type="number" name="latitude" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="longitude">Longitude</label>
                        <input type="number" name="longitude" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_updated_at">Last Updated At</label>
                        <input type="datetime-local" name="last_updated_at" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create </button>
                    <a href="{{ route('deliveryTracking.index') }}" class="btn btn-secondary">Cancel</a>
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

