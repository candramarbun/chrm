@extends('template.admin')

@section('content-header')
    <h1>Purchase Order Details</h1>
    @include('_partial.flash_message')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Order #{{ $purchaseOrder->order_number }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>Supplier:</dt>
                <dd>{{ $purchaseOrder->supplier->name }}</dd>
                <dt>Order Date:</dt>
                <dd>{{ $purchaseOrder->order_date }}</dd>
                <dt>Expected Delivery Date:</dt>
                <dd>{{ $purchaseOrder->expected_delivery_date }}</dd>
                <dt>Notes:</dt>
                <dd>{{ $purchaseOrder->notes }}</dd>
            </dl>
            <h4>Order Items</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Inventory</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrder->items as $item)
                        <tr>
                            <td>{{ $item->inventory->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection