@extends('layouts.app')
@section('title','Json Load')
@section('content')
    <?php
    $client = new GuzzleHttp\Client();
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $res = $client->request('GET', $url)->getBody();
    $data = json_decode($res, true);
    ?>
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

                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[0])}}</th>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[1])}}</th>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[2])}}</th>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[3])}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $dataRow)
                <tr>
                    <td>{{$dataRow[array_keys($data[0])[0]]}}</td>
                    <td>{{$dataRow[array_keys($data[0])[1]]}}</td>
                    <td>{{$dataRow[array_keys($data[0])[2]]}}</td>
                    <td>{{$dataRow[array_keys($data[0])[3]]}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[0])}}</th>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[1])}}</th>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[2])}}</th>
                <th scope="col" data-priority="1">{{ucwords(array_keys($data[0])[3])}}</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

