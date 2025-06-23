@extends('template.admin')

@section('content-header')
    <h1>Sales</h1>
    @include('_partial.flash_message')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Sales List</h3>
            <div class="box-tools">
                <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm">Add New Sale</a>
            </div>
        </div>
        <div class="box-body">
            @if(count($sales) > 0)
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Customer</th>
                                <th>Sale Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->invoice_number }}</td>
                                    <td>{{ $sale->customer->customer_name }}</td>
                                    <td>{{ $sale->sale_date }}</td>
                                    <td>
                                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display: inline;">
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
                <p>No sales found</p>
            @endif
        </div>
    </div>
@endsection