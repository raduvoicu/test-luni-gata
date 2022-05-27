@extends('layouts.app')
{{--@extends('adminlte::page')--}}
@section('title', 'Users')

@section('content')
    <div class="container-fluid">
        <div class="bg-light p-4 rounded">
            <h1>Users</h1>
            <div class="lead">
                Manage your users here.

                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new
                    user</a>
            </div>

            <div class="mt-2">
                @include('layouts.partials.messages')
            </div>
            <table class="table table-bordered table-responsive table-striped" width="100%"
                   id="pageTable"
                   style="margin-top:10px;">
                <thead>
                <tr>
                    <th scope="col" data-priority="1" width="5%">#</th>
                    <th scope="col" data-priority="1" width="15%">Name</th>
                    <th scope="col" data-priority="1">Email</th>
                    <th scope="col" data-priority="1" width="5%">Username</th>
                    <th scope="col">Password Hash</th>
                    <th scope="col" width="1%" colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->password }}</td>
                        <td><a href="{{ route('users.show', $user->id) }}"
                               class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['users.destroy', $user->id],
                                'onsubmit'=>'return confirm("Are you sure you want to do that?")',
                                'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', [
                                    'class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th scope="col" data-priority="1" width="5%">#</th>
                    <th scope="col" data-priority="1" width="15%">Name</th>
                    <th scope="col" data-priority="1">Email</th>
                    <th scope="col" data-priority="1" width="5%">Username</th>
                    <th scope="col">Password Hash</th>
                    <th scope="col" width="1%" colspan="3">Actions</th>
                </tr>
                </tfoot>
            </table>

            <div class="d-flex">
                {!! $users->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script> console.log('Hi!');
        $(document).ready(function () {
            $('#table1').DataTable({
                "columnDefs": [
                    // { "visible": false, "className": "dt-right", "targets": [0]},
                    // {"className": "dt-center", "targets": [3,4,11]},
                    // {"className": "dt-right", "targets": [5]},
                    // {"orderable": false, "targets": [1]},
                ],
                "order": [[0, "desc"]],
                "responsive": true,
                "fixedHeader": true,
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "pageLength": 50,
                "ajax": {
                    "url": "{{ url('allUsers') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}";
                    }
                },

                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "username"},
                    {"data": "password"},

                ],

            });
        });</script>
@endsection
