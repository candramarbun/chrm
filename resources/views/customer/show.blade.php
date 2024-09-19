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
          <h3 class="box-title">{{$customer->customer_name}}</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
          <p>{{$customer->customer_address}}</p>
          <p></p>
          <hr>
          <p> <h3>List Contact {{$customer->customer_name}} </h3> </p>
          @if(count($customer->contact) > 0)
            <div class="table-responsive">
              <table class="table no-margin">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Other Info</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($customer->contact as $contact)
                    <tr>
                      <td>{{$contact->contact_name}}</td>
                      <td>{{$contact->contact_address}}</td>
                      <td>{{$contact->contact_phone}}</td>
                      <td>{{$contact->contact_email}}</td>
                      <td>{{$contact->contact_others}}</td>
                      <td>
                    {{--   <a class="btn btn-warning btn-sm" href="{{ route('category_edit',$cat->id) }}">Edit</a> <a class="btn btn-danger btn-sm" href="{{ route('category_delete',$cat->id) }}"> Delete</a> --}}
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$contact->id}}')">Edit</button>
                    <button class="btn btn-danger" onclick="fun_delete('{{$contact->id}}')">Delete</button>
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
            <a href="{{route('contact_add')}}" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addModal">Add New Contact </a>
            {{-- <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addModal">Add</button> --}}
        </div>
            <!-- /.box-footer -->
    </div>

    <input type="hidden" name="hidden_view" id="hidden_view" value="{{route('contact_view')}}">
    <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{route('contact_delete')}}">
    <!-- Add Modal start -->
    <div class="modal fade" id="addModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Contact  </h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('contact_add') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-group">
                  <input type="hidden" id="id_customer" name="id_customer" value="{{$customer->id}}">
                    {!! Form::label('contact_name', 'Contact Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_name', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Contact Name',
                        'id'                            => 'contact_name',
                    ]) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('contact_address', 'Contact Address:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_address', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Contact Address',
                        'id'                            => 'contact_address',
                    ]) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_phone', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Phone',
                        'id'                            => 'phone',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contact_email', 'Contact Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_email', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Email',
                        'id'                            => 'contact_email',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contact_others', 'Other Info:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_others', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Other Info',
                        'id'                            => 'others',
                    ]) !!}
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
            <form action="{{ route('contact_update') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-group">
                    {!! Form::label('contact_name', 'Contact Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_name', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Contact Name',
                        'id'                            => 'edit_contact_name',
                    ]) !!}
                </div>
                 <div class="form-group">
                  <input type="hidden" id="id_customer" name="id_customer" value="{{$customer->id}}">
                    {!! Form::label('contact_address', 'Contact Address:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_address', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Contact Address',
                        'id'                            => 'edit_contact_address',
                    ]) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_phone', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Phone',
                        'id'                            => 'edit_contact_phone',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contact_email', 'Contact Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_email', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Email',
                        'id'                            => 'edit_contact_email',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contact_others', 'Other Info:', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_others', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Other Info',
                        'id'                            => 'edit_contact_others',
                    ]) !!}
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
          $("#view_contact_name").text(result.contact_name);
          $("#view_contact_address").text(result.contact_address);
          $("#view_contact_phone").text(result.contact_phone);
          $("#view_contact_email").text(result.contact_email);
          $("#view_contact_others").text(result.contact_others);
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
          $("#edit_contact_name").val(result.contact_name);
          $("#edit_contact_address").val(result.contact_address);
           $("#edit_contact_phone").val(result.contact_phone);
          $("#edit_contact_email").val(result.contact_email);
          $("#edit_contact_others").val(result.contact_others);
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