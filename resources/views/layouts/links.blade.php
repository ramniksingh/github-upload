@auth
    @section('buttons')
    <a class="btn btn-primary" href="{{ route('roomTypes.index') }}" role="button">View Room Types</a>
    <a class="btn btn-primary" href="{{ route('roomTypes.create') }}" role="button">Add Room Types</a>
    <a class="btn btn-primary" href="{{ route('bookings.index') }}" role="button">View Booking</a>
    <a class="btn btn-primary" href="{{ route('bookings.create') }}" role="button">Add New Booking</a>
    @endsection   
@endauth
