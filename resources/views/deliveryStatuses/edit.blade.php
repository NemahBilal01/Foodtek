@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Delivery Status</h5>
                <form action="{{ route('deliveryStatuses.update', $deliveryStatus->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="order_id">Order ID</label>
                        <input type="number" name="order_id" class="form-control" value="{{ $deliveryStatus->order_id }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <input type="text" name="status" class="form-control" value="{{ $deliveryStatus->status }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Delivery Status</button>
                    <a href="{{ route('deliveryStatuses.index') }}" class="btn btn-secondary">Cancel</a>
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