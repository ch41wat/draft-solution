<div class="bg-header"></div>
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>D</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Draft</b>Solution</span>
    </a>

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
                    <button class="historyButton">History</button>
                    <button class="draftButton">Draft Solution</button>
                </li>
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                            {{Auth::user()->name}} - {{Auth::user()->email}}
                            <small>Member since {{Auth::user()->created_at}}</small>
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