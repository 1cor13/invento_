@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order Overview</div>
                @include('partials.flash')
                <a href="{{ route('orders.create') }}">
                    <button type="button" class="btn btn-warning float-left ml-1">Add item</button>
                </a>
                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Items</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Total</th>
                                <th class="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->brand }}</td>
                                    <td>{{ $order->size }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->minimum_quantity }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->saleable }}</td>
                                    <td>
                                        <a href="{{ route('orders.edit', $order->id) }}">
                                            <button type="button" class="btn btn-primary float-left ml-1">Edit</button>
                                        </a>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger float-left ml-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <div class="row">
                                <div class="col-10 text-center">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center pt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
