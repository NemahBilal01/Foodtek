@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Notifications</h5>
         <!--<a  href="#" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>-->
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
                <th scope="col">title</th>
                <th scope="col">message</th>
                <th scope="col">is_read</th>
                <th scope="col">read_at	</th>
                <th scope="col">deleted_at</th>
                <th scope="col">action</th>
              </tr>
            </thead>

            <tbody>
              <tr>
              @foreach ($notifications as $notification )
                <th scope="row"> {{ $notification->id  }}</th>
                <td>{{ $notification->notifiable_id }}</td>
                <td>Order Rated</td>
                <td>{{ $notification->data['message'] ?? 'No message' }}</td>
                <td>{{ $notification->read_at ? 'Yes' : 'No' }}</td>
                <td>{{ $notification->read_at }}</td>
                <td>{{ $notification->deleted_at }}</td>
                <td>
                    <!--<a class="btn btn-primary" href="#" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>-->
                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
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
