@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Cart Item</h5>
                <form action="{{ route('cartItems.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="user_id">User ID</label>
                        <input type="number" name="user_id" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="food_item_id">Food Item ID</label>
                        <input type="number" name="food_item_id" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Cart Item</button>
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
