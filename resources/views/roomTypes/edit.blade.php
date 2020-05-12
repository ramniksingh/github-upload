@extends('layouts.head')

@section('title')
<h3>Edit Room Type</h3>
@endsection

@section('content')
<div class="col">
<form action="{{ route('roomTypes.update', ['roomType'=>$roomType]) }}" method="POST" enctype="multipart/form-data">
@method('PUT')
  @include('roomTypes.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Update Room Type</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('roomTypes.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
</div>
@endsection