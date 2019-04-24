@extends('layouts.main')
@section('headerExtras')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection



@section('content')
    <h1>Dashboard</h1>
    <table id="expressionsTable" class="display">
        <thead>
        <tr>
            <th>Name</th>
            <th>Group Name</th>

        </tr>
        </thead>
        <tbody>

        @foreach($expressions as $expression)
            <tr>
                <td>{{$expression->value}}</td>
                <td>{{$expression->group->group_name}}</td>

            </tr>
        @endforeach

        </tbody>
    </table>@endsection


@section('footerExtras')
    <script>
        $(document).ready(function () {
            $('#expressionsTable').DataTable();
        });
    </script>
@endsection
