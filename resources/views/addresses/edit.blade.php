@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Address</h5>

                <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="user_id">User ID</label>
                        <input type="number" name="user_id" class="form-control" value="{{ $address->user_id }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="street">Street</label>
                        <input type="text" name="street" class="form-control" value="{{ $address->street }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" value="{{ $address->city }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" value="{{ $address->state }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" value="{{ $address->postal_code }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" value="{{ $address->country }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Address</button>
                    <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
