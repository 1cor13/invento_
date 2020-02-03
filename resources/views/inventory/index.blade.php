@extends('app')

@section('title', $title)

@section('content')
    I have passed <br/>
    {{-- <h1>{{ $title }}'s Orders</h1> --}}

    <br>
    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Size</th>
                <th scope="col">Quantity</th>
                <th scope="col">Min Quantity</th>
                <th scope="col">Unit price</th>
                <th scope="col">Saleable</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $item)
                <tr>
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->minimum_quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->saleable }}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
@endsection

