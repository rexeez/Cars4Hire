@extends('layout.layout')

@section('content')
{{-- {{dd($car)}} --}}
    <div class="container pt-4">
        <div>
            <img src="/storage/car/{{ $car->image }}" alt="">
        </div>
        <div class="row">
            <div class="col-2">
                <p><b>Car Type:</b></p>
                <p><b>Price/day:</b></p>
                <p><b>Owner:</b></p>
                <p><b>Address:</b></p>
                <p><b>Status:</b></p>
                @if ($car->is_rented)
                    <p><b>Renter:</b></p>
                @endif
            </div>
            <div class="col-10">
                <p>{{ $car->type }}</p>
                <p>{{ $car->price }}</p>
                <p>{{ $car->owner_name }}</p>
                <div class="d-flex">
                    <p>{{ $car->address }}</p>
                    <a class="ms-2" href="{{ url("https://www.google.com/maps/search/?api=1&query=".$car->latitude."%2C".$car->longitude)}} ">
                        See in Google Maps
                    </a>
                </div>
                @if($car->is_rented)
                    <p>Rented</p>
                    <p>{{ $car->user_name }}</p>
                @else
                    <p>Not Rented</p>
                @endif
            </div>
        </div>
        @if ($car->owner_id!=auth()->user()->id && !$car->is_rented)
            <form action="/hire" method="POST">
                @csrf
                <input name="car_id" type="hidden" value="{{ $car->id }}">
                <div class="mb-3">
                    <label for="start">Start Date</label>
                    <input name="start" id="start" type="date" class="form-control @error('start') is-invalid @enderror">
                    @error('start')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="end" class="mb-2">End Date</label>
                    <input name="end" id="end" type="date" class="form-control mb-3 @error('end') is-invalid @enderror">
                    @error('end')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endif
        @if ($car->owner_id==auth()->user()->id)
            <form action="/remove" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $car->id }}">
                <button type="submit">
                    Remove Car Listing
                </button>
            </form>
        @endif
    </div>

@endsection
