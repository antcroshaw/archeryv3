<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="location" value="{{ old('location') ?? $Profile->location }}" class="form-control">
    <div>{{ $errors->first('location') }}</div>
</div>

<div class="form-group">
    <label for="bow">Bow Type</label>
    <input type="text" name="bow" value="{{ old('email') ?? $Profile->bow }}" class="form-control">
    <div>{{ $errors->first('bow') }}</div>
</div>

<div class="form-group d-flex flex-column">
    <label for="image">Profile Image</label>
    <input type="file" name="image" class="py-2">
    <div>{{ $errors->first('image') }}</div>
</div>

@csrf
