@extends('layouts.app')
@section('title','Posts')
<?php
$client = new GuzzleHttp\Client();
$url = 'https://jsonplaceholder.typicode.com/posts';
$res = $client->request('GET', $url)->getBody();
$data = json_decode($res, true);
?>
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
                @for($i=0;$i<count(array_keys($data[0]));$i++)
                    <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[$i])}}</th>
                @endfor
                <th scope="col" data-priority="1">Username</th>
                </thead>
                <tfoot>
                @for($i=0;$i<count(array_keys($data[0]));$i++)
                    <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[$i])}}</th>
                @endfor
                <th scope="col" data-priority="1">Username</th>
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
                    {"data": "userId"},
                    {"data": "id"},
                    {"data": "title"},
                    {"data": "body"},
                    {"data": "userName"},
                ],
            });
        })
    </script>
@stop
