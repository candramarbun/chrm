@extends('template.admin')

@section('content-header')
    <h1>Create Sale</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">New Sale</h3>
        </div>
        {!! Form::open(['route' => 'sales.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('invoice_number', 'Invoice Number:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('invoice_number', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('customer_id', 'Customer:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('customer_id', $customers->pluck('customer_name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Customer', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('sale_date', 'Sale Date:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::date('sale_date', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) !!}
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
        let itemIndex = 1;
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
            itemIndex++;
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush