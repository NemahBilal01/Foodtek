<!-- resources/views/payments/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Payment</h5>

                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="order_id">Order ID</label>
                        <input type="number" class="form-control" name="order_id" id="order_id" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="payment_method">Payment Method</label>
                        <input type="text" class="form-control" name="payment_method" id="payment_method" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="transaction_id">Transaction ID</label>
                        <input type="text" class="form-control" name="transaction_id" id="transaction_id">
                    </div>

                    <button type="submit" class="btn btn-primary">Create </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
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
