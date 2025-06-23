@extends('template.admin')
@section('content-header')
   <h1>Edit Location</h1>
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Location Details</h3>
        </div>
        {!! Form::model($location, ['route' => ['inventory_locations.update', $location->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
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
            </div>
            <div class="box-footer">
                {!! Form::submit('Update', ['class' => 'btn btn-info pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection