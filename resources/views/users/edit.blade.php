@extends('layouts.app')
@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $user->name }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $user->email }}"
                           type="email"
                           class="form-control"
                           name="email"
                           placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                @if(Auth::user()['userRole'] == 1)
                    <div class="mb-5">
                        <label for="userRole" class="form-label">Choose a user's role</label>
                        <select name="userRole" class="form-control">
                            <option value="" selected disabled>Select Role</option>
                            <?php $roles = \App\Models\Role::all();?>
                            @foreach($roles as $role)
                                <option value="{{$role['id']}}">
                                    {{$role['role']}}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('userRole'))
                            <span class="text-danger text-left">{{ $errors->first('userRole') }}</span>
                        @endif
                    </div>
                @endif


                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password"
                           placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation"
                           placeholder="Confirm Password"
                           required="required">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>

    </div>
@endsection
