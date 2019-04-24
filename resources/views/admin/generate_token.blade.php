@extends('layouts.main')
@section('content')
    <form action="login" method="post" class="form-inline justify-content-center">
        <div class="form-group">
            <label class="sr-only">Username</label>
            <input type="text" class="form-control" placeholder="username" name="username">
        </div>
        <div class="form-group">
            <label class="sr-only">Password</label>
            <input type="password" class="form-control" placeholder="password" name="password">
        </div>
        <button type="submit" class="btn btn-success ">Login</button>
    </form>

@endsection