@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Address</h5>
                <form action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="street">Street</label>
                        <input type="text" name="street" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Address</button>
                    <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Cancel</a>

                </form>

                @if ($errors->any())
                    <div class="text-danger mt-3">
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
