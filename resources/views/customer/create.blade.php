@extends('template.admin')
@section('content-header')
   <h1>
   	Add Customer
   </h1>
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add Customer</h3>
        </div>
        {!! Form::open(array('route' => 'customer_store','method'=>'POST' ,'role'=>'form')) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('name', 'Customer:', ['class' => 'control-label']) !!}
                {!! Form::text('customer_name', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Customer Name',
                    'id'                            => 'customer_name',
                ]) !!}
            </div>
             <div class="form-group">
                {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
                {!! Form::text('customer_address', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Address',
                    'id'                            => 'address',
                ]) !!}
            </div>
             <div class="form-group">
                {!! Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
                {!! Form::text('customer_phone', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Phone',
                    'id'                            => 'phone',
                ]) !!}
            </div>

        </div>

            <!-- /.box-body -->
        <div class="box-footer clearfix">
          <button class="btn btn-sm btn-info btn-flat pull-left" type="submit">Save</button>
        </div>
        {!! Form::close() !!}
            <!-- /.box-footer -->
  </div>
@endsection