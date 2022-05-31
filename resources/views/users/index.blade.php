{{--@extends('layouts.app')--}}
@extends('adminlte::page')
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

                <table class="table table-bordered table-responsive table-striped"
                       id="pageTable"
                       style="margin-top:10px; width:100%">
                    <thead>
                    <tr>
                        <th scope="col" data-priority="1">#</th>
                        <th scope="col" data-priority="1">Name</th>
                        <th scope="col" data-priority="1">Email</th>
                        <th scope="col" data-priority="1">Username</th>
                        <th scope="col">Password Hash</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th scope="col" data-priority="1">#</th>
                        <th scope="col" data-priority="1">Name</th>
                        <th scope="col" data-priority="1">Email</th>
                        <th scope="col" data-priority="1">Username</th>
                        <th scope="col">Password Hash</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script> console.log('Hi!');
        $(document).ready(function () {
            console.log("mesaj");
            $('#pageTable').DataTable({
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
                    {"data": "actions"},
                ],
            });

        });
    </script>
@stop
