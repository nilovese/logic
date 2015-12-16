@extends('layout.layout')
@section('home')
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        Name
        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input class="form-control" type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input class="form-control" type="password" name="password_confirmation">
    </div>

    <div>
        <button class="btn btn-success" type="submit">Register</button>
    </div>
</form>
@stop