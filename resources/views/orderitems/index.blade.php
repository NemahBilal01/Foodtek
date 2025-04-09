@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Order Items</h5>
          <a href="{{ route('orderItems.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>
          @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">order_id</th>
                <th scope="col">food_item_id</th>
                <th scope="col">quantity</th>
                <th scope="col">price</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">action</th>

              </tr>
            </thead>

            <tbody>
              <tr>
              @foreach ($orderItems as $orderItem )
                <th scope="row"> {{ $orderItem->id  }}</th>
                <td> {{ $orderItem->order_id }}</td>
                <td> {{ $orderItem->food_item_id }}</td>
                <td> {{ $orderItem->quantity }}</td>
                <td> {{ $orderItem->price }}</td>
                <td> {{ $orderItem->created_at }}</td>
                <td> {{ $orderItem->updated_at }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('orderItems.edit', $orderItem->id) }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>
                    <form action="{{ route('orderItems.destroy', $orderItem->id) }}" method="POST" style="display:inline;">
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
