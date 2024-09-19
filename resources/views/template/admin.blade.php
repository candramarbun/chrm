<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/skin-red.min.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">

</head>

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('project_index')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CKS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CKS</b>Project</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
         @if (Auth::guest())
          <li><a class="nav-link" href="{{ route('signIn') }}">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi! {{ Auth::user()->first_name}} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i><font color="#000000">Sign out</font></a></li> 
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      @if (Auth::guest())
      @else
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
       @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('author'))
        <li class="header">MAIN NAVIGATION</li>
         @if (!empty($halaman) && $halaman == 'dashboard')
            <li class="active"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @else
            <li><a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        @endif
        
        @if (!empty($halaman) && $halaman == 'customer' || (!empty($halaman) && $halaman == 'category')|| (!empty($halaman) && $halaman == 'project')) 
          <li class="active treeview">
          @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-gear"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if (!empty($halaman) && $halaman == 'project')
              <li class="active"><a href="{{route('project_index')}}"><i class="fa fa-circle-o"></i> <span>Project</span></a></li>
              @else
              <li><a href="{{ route('project_index')}}"><i class="fa fa-circle-o"></i> <span>Project</span></a></li>
            @endif

            @if (!empty($halaman) && $halaman == 'customer')
                <li class="active"><a href="{{route('customer_index')}}"><i class="fa fa-circle-o"></i>Customer</a></li>
              @else
                <li><a href="{{ route('customer_index')}}"><i class="fa fa-circle-o"></i>Customer</a></li>
            @endif

            @if (!empty($halaman) && $halaman == 'category')
                <li class="active"><a href="{{route('category_index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
              @else
                <li><a href="{{ route('category_index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
            @endif
          </ul>
        </li>
        @endif
        @if (Auth::user()->hasRole('admin'))
        <li>
          <a href="{{route('listUser')}}">
            <i class="fa fa-group"></i> <span>User Management</span></a>
        </li>
        @endif
      </ul>
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
  </div>

   <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <a href="https://www.fb.com/candra.marbun">Can</a>
    </div>
    <strong>Copyright &copy; 2017 PT.Citra Karya Semesta.</strong> 
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/AdminLTE/plugins/knob/jquery.knob.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/AdminLTE/dist/js/app.min.js') }}"></script>
{{-- Custom --}}
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/form-validation.js') }}"></script>

@stack('js')
</body>
</html>
