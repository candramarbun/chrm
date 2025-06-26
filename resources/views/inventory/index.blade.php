@extends('template.admin')
@section('content-header')
   <h1>Inventory Management</h1>
   @include('_partial.flash_message')
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Inventory List</h3>
            <div class="box-tools">
                <a href="{{ route('inventory_create') }}" class="btn btn-primary btn-sm">Add New Item</a>
            </div>
        </div>
        <div class="box-body">
            @if(count($inventories) > 0)
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sell Price</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->code }}</td>
                                    <td>{{ $inventory->name }}</td>
                                    <td>{{ $inventory->quantity }}</td>
                                    <td>{{  number_format($inventory->unit_price, 2)}}</td>
                                    <td>{{ number_format($inventory->sell_price, 2) }}</td>
                                    <td>{{ $inventory->category ? $inventory->category->name : '' }}</td>
                                    <td>{{ $inventory->location ? $inventory->location->name : '' }}</td>
                                    <td>
                                        <a href="{{ route('inventory_edit', $inventory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('inventory_delete', $inventory->id) }}" method="POST" style="display: inline;">
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
                <p>No inventory items found</p>
            @endif
        </div>
    </div>
@endsection