@extends('template.admin')
@section('content-header')
   <h1>
   	Project
   </h1>
    @include('_partial.flash_message')
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Project Lists</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
         @if(count($project_list) > 0)
          	<div class="table-responsive">
            	<table class="table no-margin">
              		<thead>
              			<tr>
                			<th>Project Name</th>
                			<th>Project Number</th>
                      <th>Customer</th>
                			<th>Project Category</th>
                      <th>Contract Date</th>
                      <th>Contract Number</th>
                      <th>Status</th>
                			<th>Action</th>
              			</tr>
              		</thead>
              		<tbody>
              		@foreach($project_list as $project)
              			<tr>
                      <td><a href="{{ route('project_show',$project->id) }}">{{$project->project_name}}</a></td>
                      <td>{{$project->project_number}}</a></td>
                      <td>{{$project->customer->customer_name}}</td>
                      <td>{{$project->category->child_category_name}}</td>
                      <td>{{$project->contract_date}}</td>
                			<td>{{$project->contract_number}}</td>
                      <td>{{$project->status}}</td>
                			<td><a class="btn btn-warning btn-sm" href="{{ route('project_edit',$project->id) }}">Edit</a> <a class="btn btn-danger btn-sm"onclick="fun_delete('{{$project->id}}')">Delete</a></td>
              			</tr>
              		@endforeach
              		</tbody>
            	</table>
          	</div>
          	@else
          		<p>Data  Kosong</p>
         @endif
              <!-- /.table-responsive -->
        </div>
            <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('project_create')}}" class="btn btn-sm btn-info btn-flat pull-left">Add New Project</a>
        </div>
            <!-- /.box-footer -->
    </div>
     @push('js')
    <script type="text/javascript">
    function fun_delete(id)
      {
        var conf = confirm("Are you sure want to delete??");
        if(conf){
          var delete_url = "{{ route('project_delete') }}";
          $.ajax({
            url: delete_url,
            type:"POST", 
            data: {"id":id,_token: "{{ csrf_token() }}"}, 
            success: function(){
              // alert(response);
              location.reload(); 
            }
          });
        }
        else{
          return false;
        }
      }
    </script>
    @endpush
@endsection