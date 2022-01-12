@extends('layout.layout')

@section('content')
    <div class="container pt-3">
        <h2>
            Transaction History
        </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        No.
                    </th>
                    <th scope="col">
                        Transaction Time
                    </th>
                    <th scope="col">
                        Car Type
                    </th>
                    <th scope="col">
                        Start Date
                    </th>
                    <th scope="col">
                        End Date
                    </th>
                    <th scope="col">
                        Price
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($transactions)==0)
                    <tr>
                        <td colspan="5">
                            No data...
                        </td>
                    </tr>
                @else
                    @foreach ($transactions as $t)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $t->created_at }}
                        </td>
                        <td>
                            {{ $t->type }}
                        </td>
                        <td>
                            {{ $t->start_date }}
                        </td>
                        <td>
                            {{ $t->end_date }}
                        </td>
                        @php
                            $end = strtotime($t->end_date);
                            $start = strtotime($t->start_date);
                        @endphp
                        <td>
                            {{ (($end-$start)/(60*60*24)+1)*($t->price) }}
                        </td>
                    </tr>
                    @endforeach
                @endif

            </tbody>
        </table>

    </div>

@endsection
