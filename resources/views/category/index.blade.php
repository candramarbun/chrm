@extends('template.admin')
@section('content-header')
   <h1>
   	Category
   </h1>
    @include('_partial.flash_message')
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Category Lists</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
         @if(count($category_list) > 0)
          	<div class="table-responsive">
            	<table class="table no-margin">
              		<thead>
              			<tr>
                			<th>Category Name</th>
                			<th>Description</th>
                			<th>Action</th>
              			</tr>
              		</thead>
              		<tbody>
              		@foreach($category_list as $cat)
              			<tr>
                			<td><a href="{{ route('category_show',$cat->id) }}">{{$cat->category_name}}</a></td>
                			<td>{{$cat->category_description}}</td>
                			<td><a class="btn btn-warning btn-sm" href="{{ route('category_edit',$cat->id) }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="fun_delete('{{$cat->id}}')"> Delete</a></td>
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
            <a href="{{route('category_create')}}" class="btn btn-sm btn-info btn-flat pull-left">Add New Category</a>
        </div>
            <!-- /.box-footer -->
    </div>
    @push('js')
    <script type="text/javascript">
    function fun_delete(id)
      {
        var conf = confirm("Are you sure want to delete??");
        if(conf){
          var delete_url = "{{ route('category_delete') }}";
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