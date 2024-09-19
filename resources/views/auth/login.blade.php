@extends('template.login')
@section('loginpage')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>CKS</b>Project</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   @include('_partial.flash_message')
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('signIn') }}" method="post">
    {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          {{-- <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div> --}}
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection