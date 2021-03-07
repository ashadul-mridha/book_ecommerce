<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Express Admin Template</title>
    <meta name="description" content="Book Express Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets/css/cs-skin-elastic.css')}}">
    @yield('styles')
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
    @yield('styles_custom')
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->



</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @if(auth()->user()->can('manage-admin-area') )
                    <li class=" {{request()->is('admin') ? 'active' : '' }}">
                        <a href="{{route('admin')}}"><i class="menu-icon fa fa-dashboard (alias)"></i>Dashboard </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('manage-order'))
                    <li class=" {{request()->is('admin/orders') ||request()->is('admin/orders/*') ? 'active' : '' }}">
                        <a href="{{route('admin.orders.index')}}"><i class="menu-icon fa fa-plus-square-o"></i>Orders
                        </a>
                    </li>
                    <li
                        class=" {{request()->is('admin/cancels/orders') || request()->is('admin/cancels/orders/*') ? 'active' : '' }}">
                        <a href="{{url('admin/cancels/orders')}}"><i class="menu-icon fa fa-minus-square-o"></i>Cancels
                            Orders </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('manage-users') || auth()->user()->can('manage-roles'))
                    <li
                        class="menu-item-has-children dropdown {{(request()->is('admin/roles') || request()->is('admin/roles/*')) || (request()->is('admin/users') || request()->is('admin/users/*')) ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-users"></i>User management</a>
                        <ul
                            class="sub-menu children dropdown-menu {{(request()->is('admin/roles') || request()->is('admin/roles/*')) || (request()->is('admin/users') || request()->is('admin/users/*')) ? 'active' : '' }}">
                            @can('manage-users')
                            <li><i class="fa fa-briefcase "></i><a href="{{route('admin.roles.index')}}">Roles</a></li>
                            @endcan
                            @can('manage-roles')
                            <li><i class="fa fa-user"></i><a href="{{route('admin.users.index')}}">Users</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endif

                    @can('manage-books')
                    <li
                        class="{{request()->is('admin/books/books') ||request()->is('admin/books/books/*')? 'active' : '' }}">
                        <a href="{{route('admin.books.index')}}"><i class="menu-icon fa fa-book "></i>Books</a></li>
                    @endcan
                    @can('manage-categories')
                    <li
                        class="{{request()->is('admin/books/categories') ||request()->is('admin/books/categories/*') ? 'active' : '' }}">
                        <a href="{{route('admin.categories.index')}}"><i
                                class="menu-icon fa fa-tags "></i>Categories</a>
                    </li>
                    @endcan

                    @if(auth()->user()->can('manage-categories') || auth()->user()->can('manage-subcategories'))
                  
                    <li
                        class=" {{request()->is('admin/books/subcategories') ||request()->is('admin/books/subcategories/*') ? 'active' : '' }}">
                        <a href="{{route('admin.subcategories.index')}}"><i class="menu-icon fa fa-tags "></i>Sub
                            Category</a></li>
                     @endif
                    @can('manage-authors')
                    <li
                        class=" {{request()->is('admin/books/authors') ||request()->is('admin/books/authors/*') ? 'active' : '' }}">
                        <a href="{{route('admin.authors.index')}}"><i class="menu-icon fa fa-user"></i>Authors</a></li>
                    @endcan
                    @can('manage-publishers')
                    <li
                        class=" {{request()->is('admin/books/publishers') ||request()->is('admin/books/publishers/*') ? 'active' : '' }}">
                        <a href="{{route('admin.publishers.index')}}"><i
                                class="menu-icon fa fa-chain (alias)"></i>Publishers</a>
                    </li>
                    @endcan
                    @can('manage-coupons')
                    <li
                        class=" {{request()->is('admin/books/coupons') ||request()->is('admin/books/coupons/*') ? 'active' : '' }}">
                        <a href="{{route('admin.coupons.index')}}"><i class="menu-icon fa fa-rocket"></i>Coupons</a>
                    </li>
                    @endcan
                    @if(auth()->user()->can('manage-home-page') || auth()->user()->can('manage-all-page'))
                    <li
                        class=" {{request()->is('admin/homepagecategory') ||request()->is('admin/homepagecategory/*') ? 'active' : '' }}">
                        <a href="{{route('admin.homepagecategory.index')}}"><i class="menu-icon fa fa-list-alt"></i>Home
                            Page Category</a>
                    </li>
                    @endif

                    @can('manage-all-page')
                    <li class=" {{request()->is('admin/pages') ||request()->is('admin/pages/*') ? 'active' : '' }}">
                        <a href="{{route('admin.pages.index')}}"><i class="menu-icon fa fa-list-alt"></i>All Pages</a>
                    </li>
                    @endcan
                    @can('manage-boimela')
                    <li
                        class=" {{request()->is('admin/categoryboimela') ||request()->is('admin/categoryboimela/*') ? 'active' : '' }}">
                        <a href="{{route('admin.categoryboimela.index')}}"><i
                                class="menu-icon fa fa-list-alt"></i>Boimela Category</a>
                    </li>
                    @endcan

                    @can('manage-headers')
                    <li
                        class="menu-item-has-children dropdown  {{(request()->is('admin/headers') || request()->is('admin/headers/*')) || (request()->is('admin/menus') || request()->is('admin/menus/*')) || (request()->is('admin/searchs') || request()->is('admin/searchs/*'))  ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Header</a>
                        <ul
                            class="sub-menu children dropdown-menu {{(request()->is('admin/headers') || request()->is('admin/headers/*')) || (request()->is('admin/menus') || request()->is('admin/menus/*')) || (request()->is('admin/searchs') || request()->is('admin/searchs/*'))  ? 'active' : '' }}">
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.headers.index')}}">Header Utility</a>
                            </li>
                            <li><i class="fa fa-bars"></i><a href="{{route('admin.menus.index')}}">Menu Items</a></li>
                            <li><i class="fa fa-search"></i><a href="{{route('admin.searchs.index')}}">Header Search
                                    Section

                                </a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('manage-banners')
                    <li class=" {{request()->is('admin/banners') ||request()->is('admin/banners/*') ? 'active' : '' }}">
                        <a href="{{route('admin.banners.index')}}"><i class="menu-icon fa fa-list-alt"></i>Banner
                            Slider</a>
                    </li>
                    @endcan
                    @can('manage-company-slider')
                    <li
                        class=" {{request()->is('admin/companys') ||request()->is('admin/companys/*') ? 'active' : '' }}">
                        <a href="{{route('admin.companys.index')}}"><i class="menu-icon fa fa-archive"></i>Company
                            Slider</a>
                    </li>
                    @endcan

                    @can('manage-footers')
                    <li
                        class="menu-item-has-children dropdown  {{(request()->is('admin/footer') || request()->is('admin/footer/*'))  ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Footer</a>
                        <ul
                            class="sub-menu children dropdown-menu {{(request()->is('admin/footer') || request()->is('admin/footer/*'))  ? 'active' : '' }}">
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.first.index')}}">Footer 1st
                                    Cloumn</a>
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.second.index')}}">Footer 2nd
                                    Cloumn</a>
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.third.index')}}">Footer 3rd
                                    Cloumn</a>
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.fourth.index')}}">Footer 4th
                                    Cloumn</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('manage-ads')
                    <li
                        class="menu-item-has-children dropdown  {{(request()->is('admin/adsheader') || request()->is('admin/adsheader/*')) || (request()->is('admin/adsbanner') || request()->is('admin/adsbanner/*')) || (request()->is('admin/adsbottom') || request()->is('admin/adsbottom/*'))  ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Ads</a>
                        <ul
                            class="sub-menu children dropdown-menu {{(request()->is('admin/adsheader') || request()->is('admin/adsheader/*')) || (request()->is('admin/adsbanner') || request()->is('admin/adsbanner/*')) || (request()->is('admin/adsbottom') || request()->is('admin/adsbottom/*')) ? 'active' : '' }}">
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.adsheader.index')}}">Header</a>
                            </li>
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.adsbanner.index')}}">Banner</a>
                            </li>
                            <li><i class="fa fa-tasks"></i><a href="{{route('admin.adsbottom.index')}}">Bottom</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @if(auth()->user()->can('manage-admin-area') )
                    <li class=" {{request()->is('admin/login-pages') ||request()->is('admin/login-pages/*') ? 'active' : '' }}">
                        <a href="{{route('admin.login-pages.index')}}"><i class="menu-icon fa fa-dashboard (alias)"></i>Login Page </a>
                    </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="{{asset('images/logo.png')}}" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{asset('images/logo2.png')}}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        {{-- <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div> --}}

                        {{-- <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="{{asset('images/avatar/1.jpg')}}"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="{{asset('images/avatar/2.jpg')}}"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="{{asset('images/avatar/3.jpg')}}"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="{{asset('images/avatar/4.jpg')}}"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{asset('images/admin.jpg')}}"
                                alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            {{-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span
                                    class="count">13</span></a> --}}

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="#"></a>
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="fa fa-power -off"></i>Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        @yield('content')
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    {{-- <script src="https://kit.fontawesome.com/ebaa69ce6c.js" crossorigin="anonymous"></script> --}}
    <script src="{{asset('backend/assets/js/main.js')}}"></script>


    @yield('scripts')

    @yield('scripts_custom')
</body>

</html>
