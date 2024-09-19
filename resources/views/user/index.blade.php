@extends('template.admin')
@section('content-header')
   <h1>
   	Users
   </h1>
    @include('_partial.flash_message')
@endsection
@section('content')
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">User Lists</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
         @if(count($users) > 0)
          	<div class="table-responsive">
            	<table class="table no-margin">
              		<thead>
              			<tr>
                			<th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                    {{--   <th>User</th> --}}
                      <th>Author</th>
                      <th>Admin</th>
                      <th>Action</th>
              			</tr>
              		</thead>
              		<tbody>
              		@foreach ($users as $user)
                    <tr>
                    {!! Form::open(array('route' => 'assignRole','method'=>'POST' ,'class'=>'form-horizontal' ,'files'=>true)) !!}
                      <td>{{$user->first_name}}</td>
                      <td>{{$user->last_name}}</td>
                      <td>{{$user->email}}<input type="hidden" name="email" value="{{$user->email}}"></td>
 {{--                      <td><input type="checkbox" {{$user->hasRole('user') ? 'checked' :''}} name="role_user"></td> --}}
                      <td><input type="checkbox" {{$user->hasRole('author') ? 'checked' :''}} name="role_author"></td>
                      <td><input type="checkbox" {{$user->hasRole('admin') ? 'checked' :''}} name="role_admin"></td>
                      <td><button class="btn btn-success btn-sm" type="submit">AssignRole</button> <a class="btn btn-danger btn-sm" href="{{ route('user_delete',$user->id) }}"> Delete</a></td></td>
                     {!! Form::close()!!}
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
            <a href="{{route('user_create')}}" class="btn btn-sm btn-info btn-flat pull-left">Add New User</a>
        </div>
            <!-- /.box-footer -->
    </div>
@endsection