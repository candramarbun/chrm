@extends('template.admin')
@section('content-header')
   <h1>Add New Inventory Item</h1>
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">New Item Details</h3>
        </div>
        {!! Form::open(['route' => 'inventory_store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('code', 'Code:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('code', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('quantity', 'Quantity:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('quantity', 0, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('unit_price', 'Unit Price:', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('unit_price', null, ['class' => 'form-control', 'step' => '0.01', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
    {!! Form::label('category_id', 'Category:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('category_id', App\InventoryCategory::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('supplier_id', 'Supplier:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('supplier_id', App\Supplier::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Supplier']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('location_id', 'Location:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('location_id', App\InventoryLocation::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Location']) !!}
    </div>
</div>
            </div>
            <div class="box-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-info pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection