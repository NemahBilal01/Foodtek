@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Delivery Tracking</h5>

                <form action="{{ route('deliveryTracking.update', $deliveryTrack->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="order_id">Order ID</label>
                        <input type="number" name="order_id" class="form-control" value="{{ $deliveryTrack->order_id }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="latitude">Latitude</label>
                        <input type="number" name="latitude" class="form-control" value="{{ $deliveryTrack->latitude }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="longitude">Longitude</label>
                        <input type="number" name="longitude" class="form-control" value="{{ $deliveryTrack->longitude }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_updated_at">Last Updated At</label>
                        <input type="datetime-local" name="last_updated_at" class="form-control" value="{{ \Carbon\Carbon::parse($deliveryTrack->last_updated_at)->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Delivery Tracking</button>
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
