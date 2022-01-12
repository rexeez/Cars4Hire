@extends('layout.layout')

@section('content')
<div class="container pt-3">
    <h3>
        LOGIN
    </h3>
    <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="row mx-gutters-2 mb-4">
        <div class="col-sm-4">
            <a href="{{ route('login.google') }}">
                <button type="button" class="btn btn-block btn-google">
                    <i class="fa fa-google mr-2"></i>Google
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
