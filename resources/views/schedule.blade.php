@extends('layout.layout')

@section('content')

    <div class="container pt-3">
        <h2>
           Currently Ongoing Schedules
        </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        No.
                    </th>
                    <th scope="col">
                        Start Date
                    </th>
                    <th scope="col">
                        End Date
                    </th>
                    <th scope="col">
                        Car Type
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($ongoing)==0)
                    <tr>
                        <td colspan=4>
                            No data...
                        </td>
                    </tr>
                @else
                    @foreach ($ongoing as $og)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $og->start_date }}
                            </td>
                            <td>
                                {{ $og->end_date }}
                            </td>
                            <td>
                                {{ $og->type }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <br>
        <h2>
            Upcoming Schedules
        </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        No.
                    </th>
                    <th scope="col">
                        Start Date
                    </th>
                    <th scope="col">
                        End Date
                    </th>
                    <th scope="col">
                        Car Type
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($upcoming)==0)
                    <tr>
                        <td colspan=4>
                            No data...
                        </td>
                    </tr>
                @else
                    @foreach ($upcoming as $uc)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $uc->start_date }}
                            </td>
                            <td>
                                {{ $uc->end_date }}
                            </td>
                            <td>
                                {{ $uc->type }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
