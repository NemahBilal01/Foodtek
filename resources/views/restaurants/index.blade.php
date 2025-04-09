@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Restaurants</h5>
          <a href="{{ route('restaurants.create') }}" class="btn btn-outline-dark mb-4 text-center mx-5 mt-3">Create New</a>
          @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Owner ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">logo URL</th>
                <th scope="col">Opening time</th>
                <th scope="col">Closing time</th>
                <th scope="col">Is Active</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
              <tr>
              @foreach ($restaurants as $restaurant )
                <th scope="row"> {{ $restaurant->id  }}</th>
                <td> {{ $restaurant->owner_id }}</td>
                <td>  {{ $restaurant->name }}</td>
                <td> {{  $restaurant->description }}</td>
                <td> {{  $restaurant->logo_url }}</td>
                <td> {{  $restaurant->opening_time }}</td>
                <td> {{  $restaurant->closing_time }}</td>
                <td> {{  $restaurant->is_active }}</td>
                <td> {{  $restaurant->created_at }}</td>
                <td> {{  $restaurant->updated_at }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('restaurants.edit', $restaurant->id) }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Edit
                </a>
                <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                      Delete
                  </button>
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
