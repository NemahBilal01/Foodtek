@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Delivery Statuses</h5>
        <a  href="{{ route('deliveryStatuses.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>
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
                <th scope="col">status</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">action</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                @foreach ($deliveryStatuses as $deliveryStatus )
                <th scope="row"> {{ $deliveryStatus->id  }}</th>
                <td> {{ $deliveryStatus->order_id }}</td>
                <td>  {{ $deliveryStatus->status }}</td>
                <td> {{  $deliveryStatus->created_at }}</td>
                <td> {{  $deliveryStatus->updated_at }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('deliveryStatuses.edit', $deliveryStatus->id) }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>
                  <form action="{{ route('deliveryStatuses.destroy', $deliveryStatus->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Delete</button>
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
