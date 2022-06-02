@extends('adminlte::page')
@section('title','Posts')

@section('content')
    <div class="container-fluid">
        <div class="bg-light p-4 rounded">
            <h1>Posts</h1>
            <div class="lead">
                See your json data here.
            </div>

            <table class="table table-bordered table-responsive table-striped"
                   id="pageTable"
                   style="margin-top:10px; width:100%">
                <thead>
                <tr>
                    <th scope="col" data-priority="1">#</th>
                    <th scope="col" data-priority="1">User</th>
                    <th scope="col" data-priority="1">Title</th>
                    <th scope="col" data-priority="1">Body</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th scope="col" data-priority="1">#</th>
                    <th scope="col" data-priority="1">User</th>
                    <th scope="col" data-priority="1">Title</th>
                    <th scope="col" data-priority="1">Body</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>console.log('Hi!');
        $(document).ready(function () {
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
                    "url": "{{ url('allPosts') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}";
                    }
                },

                "columns": [
                    {"data": "id"},
                    {"data": "userId"},
                    {"data": "title"},
                    {"data": "body"},
                ],
            });
        })
    </script>
@stop
