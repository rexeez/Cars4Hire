@extends('layout.layout')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-3 d-flex flex-column ps-5 pe-5">
                <a class="mb-2" href="/rent">
                    <button style="width: 100%;">
                        Put car for rent
                    </button>
                </a>
                <a class="mb-2" href="/schedule">
                    <button style="width: 100%;">
                        Hired car schedules
                    </button>
                </a>
                <a class="mb-2" href="/list">
                    <button style="width: 100%;">
                        My posted cars
                    </button>
                </a>
            </div>
            <div class="col-9">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($cars as $car)
                        <div class="col">
                            <div class="card">
                                <img src="/storage/car/{{ $car->image }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->type }}</h5>
                                    <p class="card-text">Price: {{ $car->price }}<br>Owner: {{ $car->name }}</p>
                                </div>
                                <a href="/car/{{ $car->id }}">
                                    <button style="width: 100%;">
                                        Hire
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
