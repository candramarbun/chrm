@extends('template.admin')
@section('content')
     <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
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
                      		<th class="hidden-xs">Customer</th>
                			<th class="hidden-xs">Project Category</th>
                      		<th>Status</th>
               
              			</tr>
              		</thead>
              		<tbody>
              		@foreach($project_list as $project)
              			<tr>
                      <td><a href="{{ route('project_show',$project->id) }}">{{$project->project_name}}</a></td>
                      <td class="hidden-xs">{{$project->customer->customer_name}}</td>
                      <td class="hidden-xs">{{$project->category->child_category_name}}</td>
                      <td>{{$project->status}}</td>
                			
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


        </section>
        <section class="col-lg-5 connectedSortable">
	        <div class="box box-info">
		        <div class="box-header with-border">
		          <h3 class="box-title">Our Service</h3>
		        </div>
		            <!-- /.box-header -->
		        <div class="box-body">
		        @if(count($service_list) > 0)
		      		@foreach($service_list as $service)
		      		<ul class="treeview-menu">
		 				<li><a href="{{ route('category_show',$service->id) }}"><font color="red">{{$service->category_name}}</font></a></li>
		 				@if(count($service->child) > 0)
		 					<ul class="treeview-menu">
		 					@foreach($service->child as $child)
		 				 	<li>{{$child->child_category_name}}</li>
		 				 	@endforeach
		 				 	</ul>
		 				@endif
		 			</ul>
		            @endforeach
		    
		           	@else
		          	<p>Data  Kosong</p>
		         @endif
		        </div>
	        </div>

	        <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Customer Lists</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
         @if(count($customer_list) > 0)
          	<div class="table-responsive">
            	<table class="table no-margin">
              		<thead>
              			<tr>
                			<th>Customer Name</th>
                			<th>Phone Number</th>
              			</tr>
              		</thead>
              		<tbody>
              		@foreach($customer_list as $cust)
              			<tr>
                			<td><a href="{{ route('customer_show',$cust->id) }}">{{$cust->customer_name}}</a></td>
                			<td>{{$cust->customer_phone}}</td>
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
            <a href="{{route('customer_create')}}" class="btn btn-sm btn-info btn-flat pull-left">Add New Customer</a>
        </div>
            <!-- /.box-footer -->
    </div>
        </section>
        <!-- right col -->
      </div>
@endsection