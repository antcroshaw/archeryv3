<div class="form-group">
    <label for="name">Location</label>
    <p><select name="location" id="location">
            <option value="">Select Location</option>
            <option value="outdoor" @if($Profile->location == 'outdoor') selected @endif >Outdoor</option>
            <option value="indoor" @if($Profile->location == 'indoor') selected @endif >Indoor</option>

        </select></p>
    <div>{{ $errors->first('location') }}</div>
</div>

<div class="form-group">
    <label for="bow">Bow Type</label>
    <p><select name="bow" id="bow">
            <option  value="">Select Bow Type</option>
            <option value="recurve" @if($Profile->bow == 'recurve') selected @endif >Recurve</option>
            <option value="barebow" @if($Profile->bow == 'barebow') selected @endif >Barebow</option>
            <option value="compound" @if($Profile->bow == 'compound') selected @endif >Compound</option>
        </select></p>
    <div>{{ $errors->first('bow') }}</div>
</div>

<div class="form-group d-flex flex-column">
    <label for="image">Profile Image</label>
    <input type="file" name="image" class="py-2">
    <div>{{ $errors->first('image') }}</div>
</div>

@csrf
