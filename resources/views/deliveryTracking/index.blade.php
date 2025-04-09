@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Delivery Tracking</h5>
                <a href="{{ route('deliveryTracking.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Last Updated</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveryTracking as $deliveryTrack)
                            <tr>
                                <th scope="row">{{ $deliveryTrack->id }}</th>
                                <td>{{ $deliveryTrack->order_id }}</td>
                                <td>{{ $deliveryTrack->latitude }}</td>
                                <td>{{ $deliveryTrack->longitude }}</td>
                                <td>{{ $deliveryTrack->last_updated_at }}</td>
                                <td>{{ $deliveryTrack->created_at }}</td>
                                <td>{{ $deliveryTrack->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('deliveryTracking.edit', $deliveryTrack->id) }}">Edit</a>
                                    <form action="{{ route('deliveryTracking.destroy', $deliveryTrack->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
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
