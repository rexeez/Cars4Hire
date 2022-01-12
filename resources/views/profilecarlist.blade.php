@extends('layout.layout')

@section('content')

    <div class="container pt-3">
        <h2>
            Posted Cars
        </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        No.
                    </th>
                    <th scope="col">
                        Car Type
                    </th>
                    <th scope="col">
                        Date Posted
                    </th>
                    <th scope="col">
                        Price/day
                    </th>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">

                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($cars)==0)
                    <tr>
                        <td colspan="5">
                            No data...
                        </td>
                    </tr>
                @else
                    @foreach ($cars as $c)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $c->type }}
                        </td>
                        <td>
                            {{ $c->created_at }}
                        </td>
                        <td>
                            {{ $c->price }}
                        </td>
                        <td>
                            @if ($c->is_rented)
                                Rented
                            @else
                                Not Rented
                            @endif
                        </td>
                        <td>
                            <a class="text-decoration-none text-dark" href="/car/{{ $c->id }}">
                                <button class="btn btn-primary">
                                    Details
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
