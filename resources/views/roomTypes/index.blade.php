@extends('layouts.head')

@section('title')
<h3>Room Types</h3>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roomTypes as $roomType)
        <tr>
            <td>{{ $roomType->name }}</td>
            <td>{{ $roomType->description }}</td>
            <td><img width="50px" 
            src="@php 
                echo \Illuminate\Support\Facades\Storage::url($roomType->picture)
                @endphp" />
            </td>
            <td class="actions">
                    <a
                        href="{{ action('RoomTypeController@edit', ['roomType' => $roomType->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Edit
                    </a>
                    <form action="{{ action('RoomTypeController@destroy', ['roomType' => $roomType->id]) }}" method="POST" >
                    @method('DELETE')
                    @csrf 
                        <button type="submit" class="btn btn-link" title="Delete" value="DELETE">Delete
                        </button>
                    </form>

                </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection