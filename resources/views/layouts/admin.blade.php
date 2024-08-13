<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | {{config('app.name')}}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

   <!-- Bootstrap Core Css -->
   <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

   <!-- Animation Css -->
   <link href="{{ asset('assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />

   <!-- Custom Css -->
   <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

   <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />


   <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
   <link href="{{ asset('assets/css/themes/all-themes.css') }}" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">TECNOVICE</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name}}</div>
                    <div class="email">{{ auth()->user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('user.logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    @can('user-list')
                    <li class="active">
                        <a href="{{ route('dashboard')}}">
                            <i class="material-icons">people</i>
                            <span>Users</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{ route('theses.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>Thesis</span>
                        </a>
                    </li>
                    @can('role-list')
                    <li>
                        <a href="{{ route('roles.index')}}">
                            <i class="material-icons">lock</i>
                            <span>Roles</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2024 <a href="javascript:void(0);">Tecnovice</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">

            @yield('content')

        </div>
    </section>

   <!-- Jquery Core Js -->
   <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

   <!-- Bootstrap Core Js -->
   <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

   <!-- Select Plugin Js -->
   <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

   <!-- Slimscroll Plugin Js -->
   <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

   <!-- Waves Effect Plugin Js -->
   <script src="{{ asset('assets/plugins/node-waves/waves.js') }}"></script>

   <!-- Jquery CountTo Plugin Js -->
   <script src="{{ 'assets/plugins/jquery-countto/jquery.countTo.js' }}"></script>


   <!-- Validation Plugin Js -->
   <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>

   <!-- Sparkline Chart Plugin Js -->
   <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

   <!-- Custom Js -->
   <script src="{{ asset('assets/js/admin.js') }}"></script>
   <script src="{{ asset('assets/js/pages/index.js') }}"></script>

   <!-- Demo Js -->
   <script src="{{ asset('assets/js/demo.js') }}"></script>
</body>

</html>
