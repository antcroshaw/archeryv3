<h1>Profile Page for {{ auth()->user()->name }}</h1>
<p>Here is the profile link </p>

@foreach ($profiles as $profile)


    <p><a href="/Profile/{{ $profile->id }}">Location : {{ $profile->location }}</a></p>

    @endforeach




