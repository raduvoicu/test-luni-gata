@extends('adminlte::page')
@section('title','Json Load')
@section('content')
    <div class="container-fluid">
        <div class="bg-light p-4 rounded">
            <h1>Json</h1>
            <div class="lead">
                View Json Data
            </div>
        </div>

        <table class="table table-bordered table-responsive table-striped"
               id="jsonTable"
               style="margin-top:10px; width:100%">
            <thead>
            <tr>
                <th scope="col" data-priority="1">#</th>
                <th scope="col" data-priority="1">User</th>
                <th scope="col" data-priority="1">Title</th>
                <th scope="col" data-priority="1">Body</th>
            </tr>
            </thead>
            <tbody>

                <?php $json = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'),true);?>
                @foreach($json as $onejson)
                <tr>
                    <td>{{$onejson['id']}}</td>
                    <td>{{$onejson['userId']}}</td>
                    <td>{{$onejson['title']}}</td>
                    <td>{{$onejson['body']}}</td>
                </tr>
                @endforeach
            </tbody>
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
@endsection

