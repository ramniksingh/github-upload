

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $roomType->name ?? '' }}"/>
            <small class="form-text text-muted">Room Type name.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="description">Description</label>
        <div class="col-sm-10">
            <input name="description" type="text" class="form-control" placeholder="Description" value="{{ $roomType->description ?? '' }}"/>
            <small class="form-text text-muted">Description for Room Type.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="picture">Picture</label>
        <div class="col-sm-10">
            <input name="picture" type="file" class="form-control" placeholder="Picture" value="{{ $roomType->picture ?? '' }}"/>
            <small class="form-text text-muted">Photograph for Room Type.</small>

        </div>
    </div>


    @csrf