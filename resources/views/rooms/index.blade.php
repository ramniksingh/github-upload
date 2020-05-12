@extends('layouts.head')

@section('title')
<h3>Rooms</h3>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Room No.</th>
            <th>Room Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td>{{ $room->number }}</td>
            <td>{{ $room->roomType->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


