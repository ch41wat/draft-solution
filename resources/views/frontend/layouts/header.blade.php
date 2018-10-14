<div class="bg-header"></div>
<header class="main-header">

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
        <img src="{{ asset('img/logo-draft.png') }}" alt="" class="navbar-logo img-responsive">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            
            
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li>
                    <a href="{{ route('sale' . '-history') }}" class="historyButton">@lang('message.history')</a>
                </li>
                <li>
                    <a href="{{ route('sale' . '-create-form', ['form' => 'customer']) }}" class="draftButton">
                        @lang('message.draft-solution')
                    </a>
                </li>
                <!-- language bar -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-flag-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li class="{{ (Request::segment(1) == 'th') ? 'active' : '' }}"><!-- Task item -->
                                    <a href="{{ route('auth.lang', ['locale' => 'th', 'url' => str_replace('/', '_', $_SERVER['PATH_INFO'])]) }}">
                                        TH
                                    </a>
                                </li>
                                <li class="{{ (Request::segment(1) == 'en') ? 'active' : '' }}">
                                    <a href="{{ route('auth.lang', ['locale' => 'en', 'url' => str_replace('/', '_', $_SERVER['PATH_INFO'])]) }}">
                                        EN
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{(session()->pull('sessionUser'))}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                            {{(session()->pull('sessionUser'))}} - {{(session()->pull('sessionEmail'))}}
                            <small>Member since {{(session()->pull('sessionCreated_at'))}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>