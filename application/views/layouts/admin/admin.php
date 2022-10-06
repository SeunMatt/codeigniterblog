<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LaraBlog | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css', env('USE_SSL'))}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/iCheck/square/blue.css', env('USE_SSL'))}}">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css', env('USE_SSL'))}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/_all-skins.min.css', env('USE_SSL'))}}">
  
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datepicker/datepicker3.css', env('USE_SSL'))}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css', env('USE_SSL'))}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', env('USE_SSL'))}}">

   <!-- blockUI -->
  <link rel="stylesheet" href="{{asset('assets/admin/css/blockui.min.css', env('USE_SSL'))}}">
  
  @yield("page:styles")

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">
     var token = "{{csrf_token()}}";
     var baseUrl = "{{url('/')}}";
  </script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('front.index')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>La</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Lara</b>Blog</span>
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
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">@if(!is_null(Auth::user())) {{Auth::user()->name}} @endif</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  @if(!is_null(Auth::user())) {{Auth::user()->name}} - Admin @endif
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">

                  <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
                   </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets/admin/dist/img/user2-160x160.jpg', env('USE_SSL'))}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{route('admin.posts.index')}}">
            <i class="fa fa-dashboard"></i> <span>Posts</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  @yield("content")

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Seun Matt</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js', env('USE_SSL'))}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js', env('USE_SSL'))}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('assets/admin/plugins/morris/morris.min.js', env('USE_SSL'))}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/admin/plugins/sparkline/jquery.sparkline.min.js', env('USE_SSL'))}}"></script>
<!-- jvectormap -->
<script src="{{asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', env('USE_SSL'))}}"></script>
<script src="{{asset('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', env('USE_SSL'))}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/admin/plugins/knob/jquery.knob.js', env('USE_SSL'))}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.js', env('USE_SSL'))}}"></script>
<!-- datepicker -->
<script src="{{asset('assets/admin/plugins/datepicker/bootstrap-datepicker.js', env('USE_SSL'))}}"></script>
<!-- Slimscroll -->
<script src="{{asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('assets/admin/plugins/fastclick/fastclick.js', env('USE_SSL'))}}"></script>
<script src="{{asset('assets/admin/plugins/iCheck/icheck.min.js', env('USE_SSL'))}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- blockUI -->
<script src="{{asset('assets/admin/js/jquery.blockUI.js', env('USE_SSL'))}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/app.min.js', env('USE_SSL'))}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/admin/dist/js/demo.js', env('USE_SSL'))}}"></script>

@yield("page:scripts")
</body>
</html>
