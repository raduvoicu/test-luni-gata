{{--@extends('layouts.app')--}}
@extends('adminlte::page')
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
{{--            <div>--}}
{{--                Username: {{ $user->username }}--}}
{{--            </div>--}}
            <div>
                Password hash: {{ $user->password }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
