@extends('template.admin')
@section('content-header')
   <h1>
   	Add Project
   </h1>
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add Project</h3>
        </div>
        {!! Form::open(array('route' => 'project_store','method'=>'POST' ,'role'=>'form')) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('name', 'Project Name:', ['class' => 'control-label']) !!}
                {!! Form::text('project_name', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Project Name',
                    'id'                            => 'project_name',
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('project_number', 'Project Number:', ['class' => 'control-label']) !!}
                {!! Form::text('project_number', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Project Number',
                    'id'                            => 'project_number',
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('project_customer', 'Customer:', ['class' => 'control-label']) !!}
                 @if(count($list_customer) > 0)
                 {!! Form::select('project_customer', $list_customer, null, [
                    'class' => 'form-control', 
                    'id' => 'project_customer', 
                    'placeholder' => 'Project Customer']) !!}
                @else
                    <p>empty!</p>
                @endif
            </div>

            <div class="form-group">
                @if(count($list_category) > 0)
                    {!! Form::label('l_category', 'Project Category:', ['class' => 'control-label']) !!}
                    {!! Form::select('category', $list_category, null, [
                        'class' => 'form-control', 
                        'id' => 'category', 
                        'placeholder' => 'Project Category']) !!}
                    @else
                        <p>empty!</p>
                    @endif

                     {!! Form::select('project_category', $list_child, null, [
                        'class' => 'form-control', 
                        'id' => 'project_category', 
                        'placeholder' => 'Project Category']) !!}
                    {{-- <select class="form-control"  id="project_category" name="project_category" required> </select> --}}
            </div>

            <div class="form-group">
                {!! Form::label('contract_date', 'Contract Date:', ['class' => 'control-label']) !!}
                {!! Form::text('contract_date', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Contract Date',
                    'id'                            => 'datepicker',
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('contract_number', 'Contract Number:', ['class' => 'control-label']) !!}
                {!! Form::text('contract_number', null, [
                    'class'                         => 'form-control',
                    'placeholder'                   => 'Contract Number',
                    'id'                            => 'contract_number',
                ]) !!}
            </div>

             {!! Form::label('level', 'Status:', ['class' => 'control-label']) !!}
                <div class="radio">
                    <label>{!! Form::radio('status', 'ongoing') !!} Ongoing</label>
                </div>
                <div class="radio">
                    <label>{!! Form::radio('status', 'closed') !!} Closed</label>
                </div>
                </div>
        </div>
            <!-- /.box-body -->
        <div class="box-footer clearfix">
          <button class="btn btn-sm btn-info btn-flat pull-left" type="submit">Save</button>
        </div>
        {!! Form::close() !!}
            <!-- /.box-footer -->
  </div>
@push('js')
  <script type="text/javascript">
    jQuery(document).ready(function($){
        $('#category').change(function(){
            $.get("{{ route('getchild')}}", 
            { option: $(this).val() }, 
            function(data) {
                var item = $('#project_category');
                item.empty();
                $.each(data, function(key, value) {
                    item.append("<option value='"+ key +"'>" + value + "</option>");
                });

            });
        });
    });

     //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
  </script>
  @endpush
@endsection