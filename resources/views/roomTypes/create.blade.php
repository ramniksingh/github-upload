@extends('layouts.head')

@section('title')
<h3>Add Room Types</h3>
@endsection

@section('content')
<div class="col">
<form action="{{ route('roomTypes.store') }}" method="POST" enctype="multipart/form-data">
  @include('roomTypes.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Add Room Type</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('roomTypes.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
</div>
@endsection