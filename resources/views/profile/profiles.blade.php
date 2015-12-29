@extends('layout.layout')
@section('home')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>DOB</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($profiles as $profile)
                <tr>
                    <td>{{ $profile->id }}</td>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->phone }}</td>
                    <td>{{ $profile->country }}</td>
                    <td>{{ $profile->city }}</td>
                    <td>{{ $profile->dob }}</td>
                    <td><a href="{{ route("editview",[$profile->id]) }}">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <a href="{{ url('profile/create') }}" class="btn btn-success">Add new profile</a>

@stop