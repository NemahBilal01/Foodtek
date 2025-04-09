@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Payments</h5>
          <a href="{{ route('payments.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>
          @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Order ID</th>
                <th scope="col">Amount</th>
                <th scope="col">Payment method</th>
                <th scope="col">Status</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Created AT</th>
                <th scope="col">Updated AT</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
              <tr>
              @foreach ($payments as $payment )
                <th scope="row"> {{ $payment->id  }}</th>
                <td> {{ $payment->order_id }}</td>
                <td>  {{ $payment->amount }}</td>
                <td> {{  $payment->payment_method }}</td>
                <td> {{  $payment->status }}</td>
                <td> {{  $payment->transaction_id }}</td>
                <td> {{  $payment->created_at }}</td>
                <td> {{  $payment->updated_at }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('payments.edit', $payment->id) }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>
                  <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button  class="btn btn-danger" type="submit"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Delete</button>
                    </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
