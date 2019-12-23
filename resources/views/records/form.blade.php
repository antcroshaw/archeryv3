<div class="form-group">
    <label for="season_id">Season Id</label>
    <p><select name="season_id" id="season_id">
            <option value="">Season Id</option>
            @foreach($Season as $seasons)
                @if($seasons->active == 1)
                <option value="{{ $seasons->id }}" @if($Record->season_id == $seasons->id) selected @endif>Name: {{ $seasons->name }} | Id: {{$seasons->id}}</option>@endif
            @endforeach
        </select></p>
    <div class="alert-warning">{{ $errors->first('season_id') }}</div>
</div>

<div class="form-group">
    <label for="user_id">User Id</label>
    <p><select name="user_id" id="user_id">
            <option value="">User Id</option>
            @foreach($User as $users)
                <option value="{{ $users->id }}" @if($Record->user_id == $users->id) selected @endif>Name: {{ $users->name }} | Id: {{$users->id}}</option>
            @endforeach
        </select></p>
    <div class="alert-warning">{{ $errors->first('user_id') }}</div>
</div>

<div class="form-group">
    <label for="bow">Bow Type</label>
    <p><select name="bow" id="bow">
            <option value="">Select Bow Type</option>
            <option value="Recurve"  @if($Record->bow == 'Recurve') selected @endif >Recurve</option>
            <option value="Barebow"  @if($Record->bow == 'Barebow') selected @endif>Barebow</option>
            <option value="Compound" @if($Record->bow == 'Compound') selected @endif>Compound</option>
            <option value="Longbow" @if($Record->bow == 'Longbow') selected @endif>Longbow</option>
        </select></p>
    <div class="alert-warning">{{ $errors->first('bow') }}</div>
</div>

<div class="form-group">
    <label for="round">Round</label>
    <p><select name="imperial_round">
        <option value="">Imperial Rounds</option>
        @foreach($rounds['imperial'] as $round) <option value="{{ $round }}" @if($Record->round == $round ) selected @endif>{{ $round }}</option>

            @endforeach
        </select>

        <select name="metric_round">
            <option value="">Metric Rounds</option>
            @foreach($rounds['metric'] as $round) <option value="{{ $round }}" @if($Record->round == $round ) selected @endif>{{ $round }}</option>

            @endforeach
        </select>
        <select name="indoor_round">
            <option value="">Indoor Rounds</option>
            @foreach($rounds['indoor'] as $round) <option value="{{ $round }}" @if($Record->round == $round ) selected @endif>{{ $round }}</option>

            @endforeach
        </select></p>
    <div class="alert-warning">{{ $errors->first('round') }}</div>
</div>

<div class="form-group">
    <label for="bow">Score</label>
    <p><input type="text" name="score" id="score" value="{{ $Record->score }}"></p>
    <div class="alert-warning">@if($errors->first('score')) score out of range  @endif</div>
</div>

<div class="form-group">
    <label for="date">Date of Round</label>
    <p><input type="date" name="date" id="date" placeholder="yyyy-mm-dd" value="{{ $Record->date }}"></p>
    <div class="alert-warning">{{ $errors->first('date') }}</div>
</div>

