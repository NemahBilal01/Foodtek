@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Order Item</h5>

                <form action="{{ route('orderItems.update', $orderItem->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $orderItem->quantity }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ $orderItem->price }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Item</button>
                    <a href="{{ route('orderItems.index') }}" class="btn btn-secondary">Cancel</a>
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
