
@extends('app');
{{ $myNameTitle = $myName."'s Orders" }}
@section('title', $myNameTitle)

@section('content')
    <h1>$myNameTitle</h1>

    <br>
    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order</th>
                <th scope="col">Customer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($myVars as $myVar)
                <tr>
                    <th scope="col">{{ $loop->iteration }}</th>
                    @foreach ($myVar as $item)
                        <td>{{ $item }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        
    </table>
@endsection

