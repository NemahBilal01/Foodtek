@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Order</h5>

                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="total_price">Total Price</label>
                        <input type="number" step="0.01" class="form-control" name="total_price" id="total_price" value="{{ $order->total_price }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-control" name="payment_status" id="payment_status" required>
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Order</button>
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
