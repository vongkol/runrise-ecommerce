<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sunrise E-Commerce">
    <meta name="author" content="Runrise">
    <meta name="keyword" content="ecommerce, sunrise, cambodia ecommerce">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <title>Admin Template</title>
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
                  <span class="navbar-toggler-icon"></span>
            </button>
            
            <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item px-3">
                <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item px-3">
                <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item px-3">
                <a class="nav-link" href="#">Settings</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                  
                <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
                </li>
                <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="margin-right: 32px">
                    <img src="{{asset('img/avatars/6.jpg')}}" class="img-avatar" alt="admin@bootstrapmaster.com">
                    {{Auth::user()->name}}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    
                    <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    
                    <a class="dropdown-item" href="{{url('/user/logout')}}"><i class="fa fa-lock"></i> Logout</a>
                </div>
                </li>
            </ul>
               
        </header>
        <div class="app-body">
            <div class="sidebar">
                <nav class="sidebar-nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin')}}"><i class="fa fa-home"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin/page')}}"><i class="fa fa-file"></i> Page</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="{{url('/admin/filemanager')}}"><i class="fa fa-file"></i> File Manager</a>
                            </li>
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-cog"></i> Settings</a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('/admin/category')}}"><i class="fa fa-book"></i> Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages-register.html" target="_top"><i class="fa fa-key"></i> User Role</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="{{url('/admin/user')}}"><i class="fa fa-user"></i> User</a>
                                    </li>
                                   
                                </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <main class="main">
                <div class="container-fluid">
                    <div class="animated fadein">
                        <div class="row">
                            <div class="col-sm-12">
                                @yield('content')
                               
                            </div>
                        </div>
                    </div>
                </div>
            </main>
           
        </div>

    <footer class="app-footer">
        <span><a href="http://coreui.io">CoreUI</a> © 2018 creativeLabs.</span>
        <span class="ml-auto">Powered by <a href="http://coreui.io">CoreUI</a></span>
    </footer>
    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper/umd/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pace-progress/pace.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('js')
</body>
</html>