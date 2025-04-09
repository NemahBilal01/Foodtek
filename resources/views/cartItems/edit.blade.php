@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Cart Item</h5>
                <form action="{{ route('cartItems.update', $cartItem->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="user_id">User ID</label>
                        <input type="number" name="user_id" class="form-control" value="{{ $cartItem->user_id }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="food_item_id">Food Item ID</label>
                        <input type="number" name="food_item_id" class="form-control" value="{{ $cartItem->food_item_id }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $cartItem->quantity }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Cart Item</button>
                    <a href="{{ route('cartItems.index') }}" class="btn btn-secondary">Cancel</a>
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
