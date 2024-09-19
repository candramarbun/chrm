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
          <h3 class="box-title">{{$category->category_name}}</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
          <p><h3>{{$category->category_name}}</h3></p>
          <p>{{$category->category_description}}</p>
          <p></p>
          <hr>
          <p> <h3>List {{$category->category_name}} </h3> </p>
          @if(count($category->child) > 0)
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
                  @foreach($category->child as $child)
                    <tr>
                      <td>{{$child->child_category_name}}</td>
                      <td>{{$child->child_category_desc}}</td>
                      <td>
                    {{--   <a class="btn btn-warning btn-sm" href="{{ route('category_edit',$cat->id) }}">Edit</a> <a class="btn btn-danger btn-sm" href="{{ route('category_delete',$cat->id) }}"> Delete</a> --}}
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$child->id}}')">Edit</button>
                    <button class="btn btn-danger" onclick="fun_delete('{{$child->id}}')">Delete</button>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
            @else
              <p>Data  Kosong</p>
         @endif
        </div>
            <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('child_add')}}" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addModal">Add New {{$category->category_name}}</a>
            {{-- <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addModal">Add</button> --}}
        </div>
            <!-- /.box-footer -->
    </div>

    <input type="hidden" name="hidden_view" id="hidden_view" value="{{route('child_view')}}">
    <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{route('child_delete')}}">
    <!-- Add Modal start -->
    <div class="modal fade" id="addModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New {{$category->category_name}}</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('child_add') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-group">
                  <input type="hidden" id="id_category" name="id_category" value="{{$category->id}}">
                  <label for="child_category_name">{{$category->category_name}} Name:</label>
                  <input type="text" class="form-control" id="child_category_name" name="child_category_name">
                </div>
                <div class="form-group">
                  <label for="child_category_desc">Description:</label>
                  <textarea class="form-control" id="child_category_desc" name="child_category_desc"></textarea>
                </div>
              </div>
              
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    <!-- add code ends -->
 
 
    <!-- Edit Modal start -->
    <div class="modal fade" id="editModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('child_update') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-group">
                  <input type="hidden" id="id_category" name="id_category" value="{{$category->id}}">
                  <label for="edit_child_category_name">{{$category->category_name}} Name:</label>
                  <input type="text" class="form-control" id="edit_child_category_name" name="child_category_name">
                </div>
                <div class="form-group">
                  <label for="edit_child_category_desc">Description:</label>
                  <textarea class="form-control" id="edit_child_category_desc" name="child_category_desc"></textarea>
                </div>
              </div>
              
              <button type="submit" class="btn btn-default">Update</button>
              <input type="hidden" id="edit_id" name="edit_id">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          
        </div>
        
      </div>
    </div>

    @push('js')
    <script type="text/javascript">
      function fun_view(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#view_child_category_name").text(result.child_category_name);
          $("#view_child_category_desc").text(result.child_category_desc);
        }
      });
    }
 
    function fun_edit(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#edit_id").val(result.id);
          $("#edit_child_category_name").val(result.child_category_name);
          $("#edit_child_category_desc").val(result.child_category_desc);
        }
      });
    }
 
    function fun_delete(id)
    {
      var conf = confirm("Are you sure want to delete??");
      if(conf){
        var delete_url = $("#hidden_delete").val();
        $.ajax({
          url: delete_url,
          type:"POST", 
          data: {"id":id,_token: "{{ csrf_token() }}"}, 
          success: function(response){
            alert(response);
            location.reload(); 
          }
        });
      }
      else{
        return false;
      }
    }
    </script>
    <!-- Edit code ends -->
    @endpush('js')
@endsection