@extends('layout.layout')

@section('content')

    <div class="container pt-4">
        <form action="/rent" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="type">Car Type</label>
                <input name="type" id="type" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="price" class="mb-2">Price</label>
                <input name="price" id="price" type="text" class="form-control mb-3">
            </div>
            <div class="mb-3">
                <label for="location" class="mb-2">Location</label>
                <input name="location" id="location" type="text" class="form-control mb-3">
            </div>
            <div class="mb-3">
                <label for="image">Sample Image</label>
                <input name="image" type="file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
