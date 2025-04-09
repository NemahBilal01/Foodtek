@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Order</h5>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="user_id">User ID</label>
                        <input type="number" class="form-control" name="user_id" id="user_id" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="restaurant_id">Restaurant ID</label>
                        <input type="number" class="form-control" name="restaurant_id" id="restaurant_id" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="total_price">Total Price</label>
                        <input type="number" step="0.01" class="form-control" name="total_price" id="total_price" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-control" name="payment_status" id="payment_status" required>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Order</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

                @if ($errors->any())
                    <div class="mt-3 text-danger">
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
