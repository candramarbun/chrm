@extends('template.admin')
@section('content-header')
   <h1>Add New Purchase Order</h1>
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Order Details</h3>
        </div>
        {!! Form::open(['route' => 'purchase_orders.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('order_number', 'Order Number:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('order_number', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('supplier_id', 'Supplier:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('supplier_id', $suppliers->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Supplier', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('order_date', 'Order Date:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::date('order_date', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('expected_delivery_date', 'Expected Delivery Date:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::date('expected_delivery_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('notes', 'Notes:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Items:</label>
                    <div class="col-sm-10">
                        <table class="table table-bordered" id="items-table">
                            <thead>
                                <tr>
                                    <th>Inventory</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {!! Form::select('items[0][inventory_id]', $inventories->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Inventory', 'required']) !!}
                                    </td>
                                    <td>
                                        {!! Form::number('items[0][quantity]', 1, ['class' => 'form-control', 'required', 'min' => 1]) !!}
                                    </td>
                                    <td>
                                        {!! Form::number('items[0][unit_price]', 0, ['class' => 'form-control', 'required', 'min' => 0, 'step' => '0.01']) !!}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" id="add-item">Add Item</button>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-info pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        let itemIndex = 1; // Initialize itemIndex here
        $('#add-item').click(function() {
            $('#items-table tbody').append(`<tr>
                <td>
                    <select name="items[${itemIndex}][inventory_id]" class="form-control" required>
                        <option value="" disabled selected>Select Inventory</option>
                        @foreach($inventories as $inventory)
                            <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="items[${itemIndex}][quantity]" class="form-control" required min="1" value="1">
                </td>
                <td>
                    <input type="number" name="items[${itemIndex}][unit_price]" class="form-control" required min="0" step="0.01" value="0">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                </td>
            </tr>`);
            itemIndex++; // Increment itemIndex after adding a new item
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush