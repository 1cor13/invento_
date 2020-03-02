@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Inventory Overview</div>
                @include('partials.flash')
                <a href="{{ route('inventory.create') }}">
                    <button type="button" class="btn btn-warning float-left ml-1">Add Inventory</button>
                </a>
                
                <div class="card-body">
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
                                <th class="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->minimum_quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->saleable }}</td>
                                    <td>
                                        <a href="{{ route('inventory.edit', $item->id) }}">
                                            <button type="button" class="btn btn-primary float-left ml-1">Edit</button>
                                        </a>
                                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger float-left ml-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
