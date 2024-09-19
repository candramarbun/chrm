@extends('template.admin')
@section('content-header')
   <h1>
   	Edit Category
   </h1>
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Category</h3>
        </div>
       {!! Form::model($category, ['method' => 'PATCH','route' => ['category_update', $category->id],'role'=>'form' ]) !!}
        <div class="box-body">
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
          <button class="btn btn-sm btn-info btn-flat pull-left" type="submit">Update</button>
        </div>
        {!! Form::close() !!}
            <!-- /.box-footer -->
  </div>
@endsection