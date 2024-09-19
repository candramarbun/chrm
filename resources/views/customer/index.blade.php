@extends('template.admin')
@section('content-header')
   <h1>
   	Customer
   </h1>
    @include('_partial.flash_message')
@endsection
@section('content')
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
                			<th>Address</th>
                			<th>Phone Number</th>
                			<th>Action</th>
              			</tr>
              		</thead>
              		<tbody>
              		@foreach($customer_list as $cust)
              			<tr>
                			<td><a href="{{ route('customer_show',$cust->id) }}">{{$cust->customer_name}}</a></td>
                			<td>{{$cust->customer_address}}</td>
                			<td>{{$cust->customer_phone}}</td>
                			<td><a class="btn btn-warning btn-sm" href="{{ route('customer_edit',$cust->id) }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="fun_delete('{{$cust->id}}')"> Delete</a></td>
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
    @push('js')
    <script type="text/javascript">
    function fun_delete(id)
      {
        var conf = confirm("Are you sure want to delete??");
        if(conf){
          var delete_url = "{{ route('customer_delete') }}";
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