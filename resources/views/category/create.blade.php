@extends('template.admin')
@section('content-header')
   <h1>
   	Add Category
   </h1>
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add Category</h3>
        </div>
        {!! Form::open(array('route' => 'category_store','method'=>'POST' ,'role'=>'form')) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('category_name', 'Category Name:', ['class' => 'control-label']) !!}
                {!! Form::text('category_name', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Category Name',
                    'id'                            => 'category_name',
                ]) !!}
            </div>
             <div class="form-group">
                {!! Form::label('category_description', 'Description:', ['class' => 'control-label']) !!}
                {!! Form::textarea('category_description', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Description',
                    'id'                            => 'description',
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