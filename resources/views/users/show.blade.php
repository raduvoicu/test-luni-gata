@extends('layouts.app')
@section('content')
    <div class="bg-light p-4 rounded">

        <h1>{{ $user->name }}</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <div>
                Name: {{ $user->name }}
            </div>
            <div>
                Email: {{ $user->email }}
            </div>
            <div>
                User Status: {{ $user->userStatus }}
            </div>
            <div>
                Created at: {{ $user->created_at }}
            </div>
            <div>
                Updated at: {{ $user->updated_at }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning">Edit</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
