@extends('template.admin')
@section('content-header')
   <h1>Purchase Orders</h1>
   @include('_partial.flash_message')
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Purchase Order List</h3>
            <div class="box-tools">
                <a href="{{ route('purchase_orders.create') }}" class="btn btn-primary btn-sm">Add New Purchase Order</a>
            </div>
        </div>
        <div class="box-body">
            @if(count($purchaseOrders) > 0)
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Supplier</th>
                                <th>Order Date</th>
                                <th>Expected Delivery</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchaseOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->supplier->name }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->expected_delivery_date }}</td>
                                    <td>
                                        <a href="{{ route('purchase_orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('purchase_orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('purchase_orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No purchase orders found</p>
            @endif
        </div>
    </div>
@endsection