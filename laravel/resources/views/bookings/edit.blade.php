@extends('layouts.app')

@section('content')
<div class="col">
<form action="{{ route('bookings.update', ['booking' => $booking]) }}" method="POST">
     @method('PUT')  <!-- using the laravel directive to tell our form to use the put method since form methods can only be post or get -->
     @include('bookings.fields')
    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Update Reservation</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
</div>
@endsection