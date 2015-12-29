@extends('layout.layout')
@section('home')
    <form method="POST" action="{{ url('profile/edit') }}">
        {!! csrf_field() !!}

        <inpu type="hidden" name="client_id" value="{{ env("clitnt_id") }}"/>

        <input type="hidden" name="id" value="{{ $profile->id }}">
        <div>
            Name
            <input class="form-control" type="text" name="name" value="{{ $profile->name }}">
        </div>

        <div>
            Phone
            <input class="form-control" type="text" name="phone" value="{{ $profile->phone }}">
        </div>

        <div>
            Country
            <input class="form-control" type="text" name="country" value="{{ $profile->country }}">
        </div>

        <div>
            City
            <input class="form-control" type="text" name="city" value="{{ $profile->city }}">
        </div>

        <div>
            DOB
            <input class="form-control" type="date" name="dob">
        </div>


        <div>
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
@stop