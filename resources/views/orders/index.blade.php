@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Orders</h5>
          <a href="{{ route('orders.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>
          @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">user_id</th>
                <th scope="col">status</th>
                <th scope="col">total_price</th>
                <th scope="col">payment_status</th>
                <th scope="col">restaurant_id</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">action</th>
              </tr>
            </thead>

            <tbody>
              <tr>
              @foreach ($orders as $order )
                <th scope="row"> {{ $order->id  }}</th>
                <td> {{ $order->user_id }}</td>
                <td>  {{ $order->status }}</td>
                <td> {{  $order->total_price }}</td>
                <td> {{  $order->payment_status }}</td>
                <td> {{  $order->restaurant_id }}</td>
                <td> {{  $order->created_at }}</td>
                <td> {{  $order->updated_at }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('orders.edit', $order->id) }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>
                  <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
