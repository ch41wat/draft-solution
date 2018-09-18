<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
            <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
            <p>{{Auth::user()->name}}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('admin') }}"><i class="fa fa-home"></i> <span>{{ trans('message.home') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('customer.customer.create') }}">Create Customer</a></li>
                    <li><a href="{{ route('customer.customer.index') }}">Show Customer</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cog"></i> <span>Service</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('service.service.create') }}">Create Service</a></li>
                    <li><a href="{{ route('service.service.index') }}">Show Service</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Technology</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('technology.technology.create') }}">Create Technology</a></li>
                    <li><a href="{{ route('technology.technology.index') }}">Show Technology</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Equipment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('equipment.equipment.create') }}">Create Equipment</a></li>
                    <li><a href="{{ route('equipment.equipment.index') }}">Show Equipment</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Equipment Assignment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('equipment-assignment.equipment-assignment.create') }}">
                        Create Equipment Assignment
                    </a></li>
                    <li><a href="{{ route('equipment-assignment.equipment-assignment.index') }}">
                        Show Equipment Assignment
                    </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Picture</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('picture.picture.create') }}">Create Picture</a></li>
                    <li><a href="{{ route('picture.picture.index') }}">Show Picture</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-video-camera"></i> <span>Video</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('video.video.create') }}">Create Video</a></li>
                    <li><a href="{{ route('video.video.index') }}">Show Video</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-video-camera"></i> <span>Reservoir</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('reservoir.reservoir.create') }}">Create Reservoir</a></li>
                    <li><a href="{{ route('reservoir.reservoir.index') }}">Show Reservoir</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>