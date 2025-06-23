@extends('template.admin')
@section('content-header')
   <h1>Inventory Suppliers</h1>
   @include('_partial.flash_message')
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Supplier List</h3>
            <div class="box-tools">
                <a href="{{ route('inventory_suppliers.create') }}" class="btn btn-primary btn-sm">Add New Supplier</a>
            </div>
        </div>
        <div class="box-body">
            @if(count($suppliers) > 0)
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->code }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>
                                        <a href="{{ route('inventory_suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('inventory_suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline;">
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
                <p>No suppliers found</p>
            @endif
        </div>
    </div>
@endsection